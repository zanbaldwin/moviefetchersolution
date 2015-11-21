<?php
namespace Darsyn\MovieFetcher\Model;

/**
 * @author Zander Baldwin <hello@zanderbaldwin.com>
 */
interface MovieInterface
{
    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return integer
     */
    public function getYearOfRelease();

    /**
     * @return float
     */
    public function getRating();

    /**
     * @return array
     */
    public function getGenres();

    /**
     * @return string
     */
    public function getSummary();
}