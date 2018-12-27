<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 02.12.2018
 * Time: 1:17
 */

namespace Classes;


class Circle extends Position
{
    /**
     * @var float
     */
    protected $radius;

    public function hasRectangle(Rectangle $rectangle){
        foreach ($rectangle->getTangles() as $tangle){
            if(sqrt(($tangle->x - $this->x)**2 + ($tangle->y - $this->y)**2) > $this->radius){
                return false;
            };
        }
        return true;
    }

    public function setPosition(Position $position)
    {
        $this->setXY($position->getX(), $position->getY());

        return $this;
    }

    /**
     * @return float
     */
    public function getRadius(): float
    {
        return $this->radius;
    }

    /**
     * @param float $radius
     * @return Circle
     */
    public function setRadius(float $radius)
    {
        $this->radius = $radius;
        return $this;
    }


}