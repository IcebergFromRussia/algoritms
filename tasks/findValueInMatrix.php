<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 29.10.2018
 * Time: 18:29
 */

// Есть матрица, в ней:
//          - чем элемент правее, тем он меньше
//          - Чем элемент ниже,   тем он меньше
// определить есть ли в матрице заданное число


//задать матрицу
//выбрать случайный элемент
//произвести поиск

$matrix = array();
$rowSize = 100;
$columSize = 100;
$map = array();

fillMatrixSecondMethod($matrix, $rowSize, $columSize, 10000);
//fillMatrix($matrix, $rowSize, $columSize);

//var_dump($matrix);
//showMatrix($matrix);

$endFlag = true;
//ячейка в которой хранится искомое значение
$foundPoint = null;
//$needleNumber = $matrix[$rowSize - 1][$columSize / 2];
$needleNumber = 55;
//print_r($needleNumber);
//точка для обрезания матрицы
$pointForFind = new Point();
$borderPoint1 = new Point();
$borderPoint2 = new Point();

$borderPoint1->setPoint(0, 0);
$borderPoint2->setPoint($rowSize, $columSize);

for ($i = 0; $i < 100; $i++) {
    //найти центральную ячейку

    $pointForFind = getPointByBorders($borderPoint1, $borderPoint2);

//    var_dump($pointForFind);
    $value = getValueByPoint($matrix, $pointForFind, $map);
//    var_dump($value);
    if ($value == $needleNumber) {
        $foundPoint = $pointForFind;
        break;
    }

    //если полученное значение больше, значит оно северо-западней
    // в противном случае юго-восточней
    if ($value < $needleNumber) {
        $borderPoint2 = $pointForFind;
    } else {
        $borderPoint1 = $pointForFind;
    }
//    var_dump($borderPoint1);
    var_dump($borderPoint2);
    print_r($i);

    //проверка получился ли прямоугольник 1 ширины
    if (pointMinusPoint($borderPoint1, $borderPoint2, 'x') == 1) {
        //поиск значения в одномерном массиве
        $rightBorder = new Point();
        $rightBorder->setPoint($borderPoint2->x, $columSize);

        if ($pointFromSearch = binarySearchForMatrix($matrix, $needleNumber, $borderPoint1, $rightBorder, $map)) {
            $foundPoint = $pointFromSearch;
            echo 'test1';
            break;
        }
        $borderPoint1->x = $borderPoint2->x;
        $borderPoint2->x = $rowSize;
    }
    var_dump($borderPoint2);
    if (pointMinusPoint($borderPoint1, $borderPoint2, 'y') == 1) {
        //поиск значения в одномерном массиве
        $rightBorder = new Point();
        $rightBorder->setPoint($rowSize, $borderPoint2->y);

        if ($pointFromSearch = binarySearchForMatrix($matrix, $needleNumber, $borderPoint1, $rightBorder, $map)) {
            $foundPoint = $pointFromSearch;
            echo 'test2';
            break;

        }
        $borderPoint1->y = $borderPoint2->y;
        $borderPoint2->y = $columSize;
    }
    var_dump($borderPoint2);

    if (distanceBetweenPoints($borderPoint1, $borderPoint2) == 2) {
        $value = getValueByPoint($matrix, $borderPoint1, $map);
        if ($value == $needleNumber) {
            $foundPoint = $borderPoint1;
        }
        echo 'test3';
        break;
    }
}
var_dump($foundPoint);


class Point
{
    public $x;
    public $y;

    public function setPoint($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        return $this;
    }
}


function pointMinusPoint(Point $p1, Point $p2, $field = null)
{
    if (!empty($field)) {
        return $p2->$field - $p1->$field;
    }
    $returnPoint = new Point();
    return $returnPoint->setPoint($p2->x - $p1->x, $p2->y - $p1->y);
}

/**
 * @param Point $p1
 * @param Point $p2
 * @return Point
 */
function getPointByBorders(Point $p1, Point $p2)
{
    $resultPoint = pointMinusPoint($p1, $p2);
    $resultPoint->x = $p1->x + intdiv($resultPoint->x, 2);
    $resultPoint->y = $p1->y + intdiv($resultPoint->y, 2);
    return $resultPoint;
}


function getValueByPoint($matrix, Point $point, &$map)
{
    if(! isset($map[$point->x][$point->y])){
//        print_r(1 );
//        print_r(PHP_EOL);
        $map[$point->x][$point->y] = $matrix[$point->x][$point->y];
    }
    return $matrix[$point->x][$point->y];
}

/**
 * @param array $matrix
 * @param $needleValue
 * @param Point $border1
 * @param Point $border2
 * @param $map
 * @return bool|Point
 */
function binarySearchForMatrix(array $matrix, $needleValue, Point $border1, Point $border2, &$map)
{
    $leftBorder = $border1;
    $rightBorder = $border2;
    $distance = distanceBetweenPoints($leftBorder, $rightBorder);

    //растояние будет уменьшатся, пока не достигнет 1
    //из цикла выйдет в любом случае раньше чем $i достигнет $distance
    for ($i = 0; $i < $distance; $i++) {
        //если квадрат растояния между границами равен 2
        // значит между ними всего 1 ячейка
        if (distanceBetweenPoints($leftBorder, $rightBorder) == 2) {
            $value = getValueByPoint($matrix, $leftBorder, $map);
            if ($value == $needleValue) {
                return $leftBorder;
            }
            return false;
        }

        $buffPoint = getPointByBorders($leftBorder, $rightBorder);
        $value = getValueByPoint($matrix, $buffPoint, $map);
        if ($value == $needleValue) {
            return $buffPoint;
        }

        if ($value > $needleValue) {
            $rightBorder = $buffPoint;
        } else {
            $leftBorder = $buffPoint;
        }
    }
    return false;
}

function binarySearch(array $massive, $needleValue)
{

}

/**
 * возвращает квадрат расстояния
 *
 * @param Point $p1
 * @param Point $p2
 *
 * @return float|int
 */
function distanceBetweenPoints(Point $p1, Point $p2)
{
    $x = $p2->x - $p1->x;
    $y = $p2->y - $p1->y;
    return $x * $x + $y * $y;
}


function fillMatrix(array &$matrix, $rowSize, $columSize)
{
    for ($row = 0; $row < $rowSize; $row++) {
        for ($colum = 0; $colum < $columSize; $colum++) {
            $matrix[$row][$colum] = 99 - $row - $colum;
        }
    }
}

/**
 * заполнение матрицы так, что :
 *  - чем правее тем меньше
 *  - чем ниже тем меньше
 * @param array $matrix
 * @param $rowSize
 * @param $columnSize
 */
function fillMatrixSecondMethod(array &$matrix, $rowSize, $columnSize, $startNumber = 100)
{
    $t = 0; //для вычета
    if ($rowSize < $columnSize) {
        $n = $rowSize;
        $m = $columnSize;
    } else {
        $m = $rowSize;
        $n = $columnSize;
    }
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j <= $i; $j++) {
            $matrix[$i - $j][$j] = $startNumber - $t;
            $t++;
        }
    }

    for ($j = 1; $j < $m; $j++) {
        for($i = 0; $i < $n; $i++){
            if( $j+$i >= $m){
                break;
            }
            $matrix[$n - 1 - $i][$j+$i] = $startNumber - $t;
            $t++;
        }
    }


}

function showMatrix(array $matrix)
{
    $rowSize = count($matrix);
    $columSize = count($matrix[0]);
    for ($row = 0; $row < $rowSize; $row++) {
        for ($colum = 0; $colum < $columSize; $colum++) {
            print_r($matrix[$row][$colum] . ' ');
        }
        print_r(PHP_EOL);
    }
}