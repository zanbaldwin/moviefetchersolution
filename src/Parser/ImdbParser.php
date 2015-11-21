<?php
namespace Darsyn\MovieFetcher\Parser;

use Darsyn\MovieFetcher\Model\Movie;
use Psr\Http\Message\UriInterface;
use Symfony\Component\DomCrawler\Crawler;

class ImdbParser implements ParserInterface
{
    /**
     * {@inheritDoc}
     */
    public function supports(UriInterface $url)
    {
        return (bool) preg_match('/imdb\.com$/', (string) $url->getHost());
    }

    /**
     * {@inheritDoc}
     */
    public function parse(Crawler $document)
    {
        return new Movie(
            $document->filter('#overview-top h1.header .itemprop')->first()->text(),
            (int) $document->filter('#overview-top h1.header span a')->first()->text(),
            (float) $document->filter('#overview-top .star-box-giga-star')->text() * 10,
            $document->filterXPath('//[@id="overview-top"]//a[@itemprop="genre"]')->each(function (Crawler $node, $i) {
                return $node->text();
            }),
            $document->filterXPath('//[@id="overview-top]//p[@itemprop="description"]')->text()
        );
    }
}