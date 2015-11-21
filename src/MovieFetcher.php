<?php
namespace Darsyn\MovieFetcher;

use Darsyn\MovieFetcher\Exception\MovieFetchException;
use Darsyn\MovieFetcher\Parser\ParserInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use League\Uri\Schemes\Http;
use Psr\Http\Message\UriInterface;
use Symfony\Component\DomCrawler\Crawler;

class MovieFetcher implements MovieFetcherInterface
{
    private $httpClient;
    private $crawler;
    private $parsers;

    /**
     * MovieFetcher constructor.
     *
     * @param \GuzzleHttp\ClientInterface $httpClient
     * @param \Symfony\Component\DomCrawler\Crawler $crawler
     */
    public function __construct(ClientInterface $httpClient, Crawler $crawler = null)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
        $this->parsers = new \SplObjectStorage;
    }

    /**
     * {@inheritDoc}
     */
    public function addParser(ParserInterface $parser)
    {
        $this->parsers->attach($parser);
    }

    /**
     * {@inheritDoc}
     */
    public function fetch($url)
    {
        $url = Http::createFromString($url);
        foreach ($this->parsers as $parser) {
            if ($parser->supports($url)) {
                $document = $this->getUrlDocument($url);
                return $parser->parse($document);
            }
        }
        throw new MovieFetchException(sprintf('No parser supports the URL "%s".', (string) $url));
    }

    /**
     * @param  \Psr\Http\Message\UriInterface $url
     * @throws \Darsyn\MovieFetcher\Exception\MovieFetchException
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    public function getUrlDocument(UriInterface $url)
    {
        $request = new Request('GET', (string) $url, []);
        $response = $this->httpClient->send($request);
        // If a Crawler object was specified in the constructor use it, otherwise create a new Crawler object.
        $crawler = $this->crawler ?: new Crawler;
        $crawler->clear();
        $crawler->addHtmlContent((string) $response->getBody());
        // Return the Crawler which now contains the HTML document fetched from the specified URL.
        return $crawler;
    }
}