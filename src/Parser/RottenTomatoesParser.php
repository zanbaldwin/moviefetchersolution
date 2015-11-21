<?php
namespace Darsyn\MovieFetcher\Parser;

use Psr\Http\Message\UriInterface;
use Symfony\Component\DomCrawler\Crawler;

class RottenTomatoesParser implements ParserInterface
{
    /**
     * {@inheritDoc}
     */
    public function supports(UriInterface $url)
    {
        return (bool) preg_match('/(^|\.)rottentomatoes\.com$', (string) $url->getHost());
    }

    /**
     * {@inheritDoc}
     */
    public function parse(Crawler $document)
    {
    }
}