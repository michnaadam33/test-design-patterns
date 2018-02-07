<?php

namespace App\Repository;


use App\Model\Trip;

class TripRepository extends Repository
{
    /**
     * @var string
     */
    protected $tableName = 'trips';

    /**
     * @return array
     */
    public function findAll()
    {
        $ret = [];
        $arrayData = $this->persistence->retrieve($this->tableName);
        if (is_null($arrayData)) {
            throw new \InvalidArgumentException(sprintf('Trip with ID %d does not exist', $id));
        }
        foreach ($arrayData as $data) {
            $ret[] = Trip::fromState($data);
        }
        return $ret;
    }

    /**
     * @param Trip $trip
     */
    public function save(Trip $trip)
    {
        $id = $this->persistence->persist([
            'name' => $trip->getName(),
            'measure_interval' => $trip->getMeasureInterval(),
        ]);
        $trip->setId($id);
    }

}