<?php

namespace App\Repository;


use App\Model\TripMeasure;
use Prophecy\Exception\InvalidArgumentException;

class TripMeasureRepository extends Repository
{
    /**
     * @var string
     */
    protected $tableName = 'trip_measures';

    /**
     * @param int $tripId
     * @throws InvalidArgumentException
     * @return TripMeasure []
     */
    public function findAllByTripId(int $tripId): array
    {
        $ret = [];
        $arrayData = $this->persistence->retrieve(
            $this->tableName,
            ['trip_id' => $tripId]
        );
        if (is_null($arrayData)) {
            throw new \InvalidArgumentException(sprintf('Trip with ID %d does not exist', $id));
        }
        foreach ($arrayData as $data) {
            $ret[] = TripMeasure::fromState($data);
        }
        return $ret;
    }

    /**
     * @param int $tripId
     * @throws InvalidArgumentException
     * @return TripMeasure
     */
    public function findLastByTripId(int $tripId): TripMeasure
    {
        $arrayData = $this->persistence->retrieve(
            $this->tableName,
            ['trip_id' => $tripId],
            ['id' => 'desc'],
            1
        );
        if (is_null($arrayData)) {
            throw new \InvalidArgumentException(sprintf('Trip with ID %d does not exist', $tripId));
        }

        return TripMeasure::fromState($arrayData[0]);
    }
}