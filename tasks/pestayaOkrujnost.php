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
//    (new Position())->setXY(2,2),
//    (new Position())->setXY(4,4),
//    (new Position())->setXY(7,6),
//    (new Position())->setXY(3,4),
//    (new Position())->setXY(5,4),
//    (new Position())->setXY(8,1),
    (new Position())->setXY(9,3),
    (new Position())->setXY(9,9),
    (new Position())->setXY(5,5),
    (new Position())->setXY(2,4),
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
$radiusExtremum = 10;


//цикл для уменьшения радиуса
for ($radius = $radiusExtremum; $radius > 0; $radius -= $radiusStep) {

    //окружности
    $circles = $geomHelper->createCircleByPoints($points, $radius);
    //цикл дробления прямоугольника
    /**
     * очередь
     * @var Rectangle[] $rectangles
     */
    $rectangles = [ $rectangle];
    //пробегаем по всем прямоугольникам очереди
    while( !empty($rectangles) ){
        //берём первый элемент
        reset($rectangles);
        $rec = current($rectangles);
        $recKey = key($rectangles);
        //удаляем по ключу
        unset($rectangles[$recKey]);

        $hasRectangle = false;
        //проверяем лежит ли прямоугольник в какой-нибудь окружности
        foreach ($circles as $circle){
            if(  $circle->hasRectangle($rec)){
                $hasRectangle = true;
                break;
            }
        }
        //если нашелся прямоугольник, который не лежит в окружности
        if(! $hasRectangle){
            var_dump($geomHelper->rectangleCentre($rec));
            echo 'найден (' . $radius . ')'  ;
            break(2);
        }
        //Дробление
        if($geomHelper->rectangleSideLength($rec) > 1){
//        if($rec->getArea() > 1){
            $rectangles = array_merge($rectangles, $geomHelper->recCut($rec));
        }
    }
}