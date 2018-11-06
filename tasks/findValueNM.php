<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 01.11.2018
 * Time: 16:47
 */

$matrix = array();
$rowSize = 100;
$columSize = 100;
$needleNumber = 100;

fillMatrixSecondMethod($matrix, $rowSize, $columSize, 10000);
//showMatrix($matrix);
$y = 0;
$direction = 1;
$count = 0;
for ($x = 0; $x <= $rowSize; $x += $direction) {

    if($x == $rowSize){
        $y += 1;
        $direction *= -1;
        $x -= 1;
    } elseif ($x == -1) {
        $y += 1;
        $x += 1;
        $direction *= -1;
    }
    print_r($matrix[$y][$x] );
    print_r(PHP_EOL);
    $count++;
    if ($direction > 0) {
        if ($matrix[$y][$x] < $needleNumber) {
            $y += 1;
            $direction *= -1;
            $x -= 1;
        } elseif ($matrix[$y][$x] == $needleNumber) {
            print($x . ' ' . $y);
            break;
        }
    } else {
        if ($matrix[$y][$x] > $needleNumber) {
            if($x < $rowSize-1) {
                $direction *= -1;
            }
            $y += 1;
            continue;

        } elseif ($matrix[$y][$x] == $needleNumber) {
            print($x . ' ' . $y);
            break;
        }
    }
}
print_r(' ' . $count);


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
        for ($i = 0; $i < $n; $i++) {
            if ($j + $i >= $m) {
                break;
            }
            $matrix[$n - 1 - $i][$j + $i] = $startNumber - $t;
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
