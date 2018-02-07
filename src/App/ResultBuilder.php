<?php

namespace App;


use App\Model\Result;
use App\Model\Trip;
use App\Repository\TripMeasureRepository;
use App\Repository\TripRepository;

class ResultBuilder
{
    /**
     * @var Result
     */
    private $result;

    /**
     * @var TripRepository
     */
    protected $tripRepository;

    /**
     * @var TripMeasureRepository
     */
    protected $tripMeasureRepository;


    public function __construct(
        TripRepository $tripRepository,
        TripMeasureRepository $tripMeasureRepository
    )
    {
        $this->tripRepository = $tripRepository;
        $this->tripMeasureRepository = $tripMeasureRepository;
    }

    public function createResult(Trip $trip)
    {
        $this->result = Result::create($trip);
        $this->result->setMeasureInterval($trip->getMeasureInterval());
    }

    public function addDistance()
    {
        $tripMeasure = $this->tripMeasureRepository->findLastByTripId(
            $this->result->getTrip()->getId()
        );
        $this->result->setDistance($tripMeasure->getDistance());
    }

    public function addAvgSpeed()
    {
        $tripMeasures = $this->tripMeasureRepository->findAllByTripId(
            $this->result->getTrip()->getId()
        );
        $maxAvgSpeed = 0;
        $lastDistance = 0;
        $measureInterval = $this->result->getTrip()->getMeasureInterval();
        foreach ($tripMeasures as $tripMeasure) {
            $avgSpeed = $this->getAvrSpeed(
                $lastDistance,
                $tripMeasure->getDistance(),
                $measureInterval
            );
            if ($avgSpeed > $maxAvgSpeed) {
                $maxAvgSpeed = $avgSpeed;
            }
            $lastDistance = $tripMeasure->getDistance();
        }
        $this->result->setAvgSpeed($maxAvgSpeed);
    }

    /**
     * @param $lastDistance float
     * @param $distance float
     * @param $s int
     * @return float
     */
    private function getAvrSpeed(float $lastDistance, float $distance, int $s): float
    {
        $delta = -($lastDistance - $distance) * 3600;

        return $delta / $s;
    }

    /**
     * @return Result
     */
    public function getResult(): Result
    {

        return $this->result;
    }

}