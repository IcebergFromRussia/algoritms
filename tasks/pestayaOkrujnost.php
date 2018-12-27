<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 29.11.2018
 * Time: 17:18
 */

use Classes\Position;
use Classes\Rectangle;
use Helpers\GeomHelper;


//список точек в прямоугольнике
$points = [
    (new Position())->setXY(2,2),
    (new Position())->setXY(4,4),
    (new Position())->setXY(7,6),
    (new Position())->setXY(3,4),
    (new Position())->setXY(5,4),
    (new Position())->setXY(8,1),
    (new Position())->setXY(9,3),
];

//исходный прямоугольник
$rectangle = new Rectangle([
    (new Position())->setXY(0,0),
    (new Position())->setXY(10,0),
    (new Position())->setXY(10,10),
    (new Position())->setXY(0,10)
]);
//helper
$geomHelper = new GeomHelper();

//погрешность
$deviation = 1;
//шаг увеличения радиуса


$radiusStep = 1;
//максимальный радиус
$radiusExtremum = 20;


//цикл для увеличения радиуса
for ($radius = $radiusExtremum; $radius > 0; $radius -= $radiusStep) {

    //окружности
    $circles = $geomHelper->createCircleByPoints($points, $radius);
    //цикл дробления прямоугольника
    /**
     * @var Rectangle[]
     */
    $rectangles = [$rectangle];

    while( !empty($rectangles) ){

        $rec = current($rectangles);
        $recKey = key($rectangles);
        unset($rectangles[$recKey]);

        foreach ($circles as $circle)
            if( ! $circle->hasRectangle($rec)){
                echo 'найден (' . $radius  ;
                break;
            }
        if($geomHelper->rectangleSideLength($rec) > $deviation){
            $rectangles = array_merge($rectangles, $geomHelper->recCut($rec));
        }
    }
}