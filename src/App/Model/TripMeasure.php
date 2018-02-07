<?php

namespace App\Model;


class TripMeasure extends Model
{

    /**
     * TripMeasure constructor.
     * @param $id int|null
     * @param $distance float
     * @param $tripId int
     */
    public function __construct($id, float $distance, int $tripId)
    {
        $this->id = $id;
        $this->distance = $distance;
        $this->tripId = $tripId;
    }

    /**
     * @var int
     */
    protected $tripId;

    /**
     * @var float
     */
    protected $distance;

    /**
     * @return int
     */
    public function getTripId(): int
    {
        return $this->tripId;
    }

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }


    /**
     * @param array $state
     * @return TripMeasure
     */
    public static function fromState(array $state): TripMeasure
    {
        return new self(
            $state['id'],
            $state['distance'],
            $state['trip_id']
        );
    }
}