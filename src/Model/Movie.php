<?php
namespace Darsyn\MovieFetcher\Model;

class Movie implements MovieInterface, \JsonSerializable
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var integer
     */
    private $yearOfRelease;

    /**
     * @var float
     */
    private $rating;

    /**
     * @var array
     */
    private $genres;

    /**
     * @var string
     */
    private $summary;

    /**
     * Movie constructor.
     *
     * @param string $title
     * @param integer $yearOfRelease
     * @param float $rating
     * @param array $genres
     * @param string $summary
     */
    public function __construct($title, $yearOfRelease, $rating, array $genres, $summary)
    {
        $this->title = $title;
        $this->yearOfRelease = $yearOfRelease;
        $this->rating = $rating;
        $this->genre = $genres;
        $this->summary = $summary;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return integer
     */
    public function getYearOfRelease()
    {
        return $this->yearOfRelease;
    }

    /**
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * {@inheritDoc}
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return json_encode([
            'title'         => $this->getTitle(),
            'yearOfRelease' => $this->getYearOfRelease(),
            'rating'        => $this->getRating(),
            'genre'         => $this->getGenres(),
            'summary'       => $this->getSummary(),
        ]);
    }
}