<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 27.12.2018
 * Time: 12:10
 */

namespace Classes;


use Helpers\GeomHelper;

class Rectangle
{
    /**
     * @var Position[]
     */
    private $tangles;
    /**
     * @var GeomHelper
     */
    private $geomHelper;

    private $area;

    public function __construct($tangles)
    {
        $this->tangles = $tangles;
        $this->geomHelper = new GeomHelper();

        reset($this->tangles);
        $recPoint1 = current($this->tangles);
        $recPoint2 = next($this->tangles);
        $recPoint3 = next($this->tangles);

        $this->area = $this->geomHelper->areaByThreePoints($recPoint1,$recPoint2,$recPoint3);
    }

    /**
     * находятся ли внутри точки
     *
     * @param $points
     */
    public function hasPoints($points){
        foreach ($points as $point){
            /**
             * @var Position $point
             */
            $area = 0;
            reset($this->tangles);
            $recPoint1 = current($this->tangles);
            for($i = 0; $i < 4; $i++){
                $recPoint2 = next($this->tangles);
                if( !$recPoint2 ){
                    reset($this->tangles);
                    $recPoint2 = current($this->tangles);
                }
                $area += $this->geomHelper->areaByThreePoints($recPoint1, $recPoint2, $point);
                $recPoint1 = $recPoint2;
            }
            if($area == $this->area){
                return true;
            }
        }
    }

    /**
     * @return Position[]
     */
    public function getTangles(): array
    {
        return $this->tangles;
    }

    /**
     * @param Position[] $tangles
     */
    public function setTangles(array $tangles): void
    {
        $this->tangles = $tangles;
    }
}