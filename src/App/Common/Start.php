<?php

namespace App\Common;

use App\Helper\Factory\MysqlFactory;
use App\Model\Result;
use App\Model\Trip;
use App\Repository\TripMeasureRepository;
use App\Repository\TripRepository;
use App\ResultBuilder;

class Start implements CommonInterface
{
    /**
     * @var TripRepository
     */
    protected $tripRepository;

    /**
     * @var TripMeasureRepository
     */
    protected $tripMeasureRepository;

    public function __construct()
    {
        $mysqlFactory = new MysqlFactory();
        $this->tripRepository = new TripRepository($mysqlFactory->createConnection());
        $this->tripMeasureRepository = new TripMeasureRepository($mysqlFactory->createConnection());
    }

    /**
     * Main method
     */
    public function run()
    {
        $this->renderHead();
        $trips = $this->tripRepository->findAll();
        foreach ($trips as $trip) {
            $result = $this->build($trip);
            $result->toString();
        }
    }

    /**
     * Render head of table result
     */
    protected function renderHead()
    {
        $ret = "| ";
        $ret .= 'TRIP';
        $ret .= " | ";
        $ret .= 'Distance';
        $ret .= " | ";
        $ret .= 'Measure interval';
        $ret .= " | ";
        $ret .= 'Avg speed';
        $ret .= " |";
        echo $ret, PHP_EOL;
    }

    /**
     * Build result
     * @param Trip $trip
     * @return Result
     */
    protected function build(Trip $trip): Result
    {
        $resultBuilder = new ResultBuilder($this->tripRepository, $this->tripMeasureRepository);
        $resultBuilder->createResult($trip);
        $resultBuilder->addDistance();
        $resultBuilder->addAvgSpeed();
        return $resultBuilder->getResult();
    }

}