<?php

namespace App\Model;


class Trip extends Model
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $measureInterval;

    /**
     * @var TripMeasure []
     */
    protected $tripMeasures;

    /**
     * @param int|null $id
     * @param string $name
     * @param int $measureInterval
     */
    public function __construct($id, string $name, int $measureInterval)
    {
        $this->id = $id;
        $this->name = $name;
        $this->measureInterval = $measureInterval;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return int
     */
    public function getMeasureInterval(): int
    {
        return $this->measureInterval;
    }


    /**
     * @return TripMeasure[]
     */
    public function getTripMeasures(): array
    {
        return $this->tripMeasures;
    }

    /**
     * @param TripMeasure $tripMeasure
     */
    public function addTripMeasures(TripMeasure $tripMeasure)
    {
        $this->tripMeasures[] = $tripMeasure;
    }

    /**
     * @param TripMeasure[] $tripMeasures
     */
    public function setTripMeasures(array $tripMeasures)
    {
        $this->tripMeasures = $tripMeasures;
    }

    /**
     * @param array $state
     * @return Trip
     */
    public static function fromState(array $state): Trip
    {
        return new self(
            $state['id'],
            $state['name'],
            $state['measure_interval']
        );
    }

}