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
}