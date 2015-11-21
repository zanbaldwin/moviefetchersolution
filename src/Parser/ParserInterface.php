<?php
namespace Darsyn\MovieFetcher\Parser;

use Psr\Http\Message\UriInterface;
use Symfony\Component\DomCrawler\Crawler;

interface ParserInterface
{
    /**
     * @param \Psr\Http\Message\UriInterface $url
     * @return boolean
     */
    public function supports(UriInterface $url);

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $document
     * @return \Darsyn\MovieFetcher\Model\MovieInterface
     */
    public function parse(Crawler $document);
}