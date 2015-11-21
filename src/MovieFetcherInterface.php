<?php
namespace Darsyn\MovieFetcher;

use Darsyn\MovieFetcher\Parser\ParserInterface;

interface MovieFetcherInterface
{
    /**
     * @param \Darsyn\MovieFetcher\Parser\ParserInterface $parser
     * @return void
     */
    public function addParser(ParserInterface $parser);

    /**
     * @param string $url
     * @return \Darsyn\MovieFetcher\Model\MovieInterface
     */
    public function fetch($url);
}