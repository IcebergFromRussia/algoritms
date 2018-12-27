<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 02.12.2018
 * Time: 1:10
 */

namespace Classes;


class Position
{
    /**
     * @var float
     */
    protected $x;
    /**
     * @var float
     */
    protected $y;

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @param float $x
     */
    public function setX($x): void
    {
        $this->x = $x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * @param float $y
     */
    public function setY($y): void
    {
        $this->y = $y;
    }



    public function setXY($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        return $this;
    }
}