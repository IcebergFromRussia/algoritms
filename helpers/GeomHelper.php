<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 27.12.2018
 * Time: 13:16
 */

namespace Helpers;


use Classes\Circle;
use Classes\Position;
use Classes\Rectangle;

class GeomHelper
{

    public function areaByThreePoints( Position $p1, Position $p2, Position $p3){
        $area = (($p2->getX() - $p1->getX())*($p3->getY() - $p1->getY()) -
                ($p2->getY() - $p1->getY())*($p3->getX() - $p1->getX()))/2;
        return $area;
    }

    public function lineCentre(Position $p1, Position $p2){
        $x = ($p1->getX() + $p2->getX()) /2;
        $y = ($p1->getY() + $p2->getY()) /2;

        return (new Position())->setXY($x,$y);
    }

    /**
     * дробление прямоугольника на 4
     * @param Rectangle $rectangle
     * @return Rectangle[]
     */
    public function recCut(Rectangle $rectangle){
        $tangles = $rectangle->getTangles();

        $tangle1 = current($tangles);
        $tangle2 = next($tangles);
        $tangle3 = next($tangles);
        $tangle4 = next($tangles);

        return [
            new Rectangle([
                $tangle1,
                $this->lineCentre($tangle1, $tangle2),
                $this->lineCentre($tangle1, $tangle3),
                $this->lineCentre($tangle1, $tangle4),
            ]),
            new Rectangle([
                $tangle2,
                $this->lineCentre($tangle2, $tangle3),
                $this->lineCentre($tangle2, $tangle4),
                $this->lineCentre($tangle2, $tangle1),
            ]),
            new Rectangle([
                $tangle3,
                $this->lineCentre($tangle3, $tangle4),
                $this->lineCentre($tangle3, $tangle1),
                $this->lineCentre($tangle3, $tangle2),
            ]),
            new Rectangle([
                $tangle4,
                $this->lineCentre($tangle4, $tangle1),
                $this->lineCentre($tangle4, $tangle2),
                $this->lineCentre($tangle4, $tangle3),
            ])
        ];
    }

    /**
     * @param $points
     * @param $radius
     * @return Circle[]
     */
    public function createCircleByPoints($points, $radius){
        /**
         * @var Position[] $points
         */
        $result = [];
        foreach ($points as $point){
            $result[] = (new Circle())->setPosition($point)->setRadius($radius);
        }

        return $result;
    }

    public function rectangleSideLength(Rectangle $rectangle){

        $tangles = $rectangle->getTangles();
        $p1 = current($tangles);
        $p2 = next($tangles);

        return sqrt(abs(($p1->getX() - $p2->getX()) * ($p1->getY() - $p2->getY())));
    }
}