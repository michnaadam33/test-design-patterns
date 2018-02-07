<?php

namespace App\Model;

/**
 * Class Result
 * Result of action
 * @package App\Model
 */
class Result
{

    /**
     * @var Trip
     */
    protected $trip;

    /**
     * @var float
     */
    protected $distance;

    /**
     * @var int
     */
    protected $measureInterval;

    /**
     * @var int
     */
    protected $avgSpeed;

    /**
     * Result constructor.
     * @param Trip $trip
     */
    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
    }

    /**
     * @param Trip $trip
     * @return Result
     */
    public static function create(Trip $trip)
    {
        return new self($trip);
    }

    /**
     * @return Trip
     */
    public function getTrip(): Trip
    {
        return $this->trip;
    }

    /**
     * @param float $distance
     */
    public function setDistance(float $distance)
    {
        $this->distance = $distance;
    }

    /**
     * @param integer $measureInterval
     */
    public function setMeasureInterval(int $measureInterval)
    {
        $this->measureInterval = $measureInterval;
    }

    /**
     * @param integer $avgSpeed
     */
    public function setAvgSpeed(int $avgSpeed)
    {
        $this->avgSpeed = $avgSpeed;
    }


    /**
     * Write result to the default output
     */
    public function toString()
    {
        $ret = "| ";
        $ret .= $this->trip->getName();
        $ret .= " | ";
        $ret .= $this->distance;
        $ret .= " | ";
        $ret .= $this->measureInterval;
        $ret .= " | ";
        $ret .= $this->avgSpeed;
        $ret .= " |";
        echo $ret, PHP_EOL;
    }

}