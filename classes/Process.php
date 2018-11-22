<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 19.11.2018
 * Time: 4:19
 */

namespace Classes;


class Process
{
    /**
     * штраф
     * @var int
     */
    private $endTime;
    /**
     * штраф
     * @var int
     */
    private $fine;

    /**
     * Process constructor.
     * @param $endTime
     * @param $fine
     */
    public function __construct($endTime, $fine)
    {
        $this->endTime = $endTime;
        $this->fine = $fine;
    }

    /**
     * @return int
     */
    public function getEndTime(): int
    {
        return $this->endTime;
    }

    /**
     * @param int $endTime
     */
    public function setEndTime(int $endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     * @return int
     */
    public function getFine(): int
    {
        return $this->fine;
    }

    /**
     * @param int $fine
     */
    public function setFine(int $fine): void
    {
        $this->fine = $fine;
    }
}