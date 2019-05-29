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

    /**
     * лежит ли прямоугольник в окружности
     *
     * @param Rectangle $rectangle
     * @return bool
     */
    public function hasRectangle(Rectangle $rectangle){
        foreach ($rectangle->getTangles() as $tangle){
            if(floor(sqrt(($tangle->getX() - $this->x)**2 + ($tangle->getY() - $this->y)**2)) <= $this->radius){
                return true;
            };
        }
        return false;
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