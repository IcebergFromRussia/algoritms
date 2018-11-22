<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 15.11.2018
 * Time: 13:12
 */


use Classes\Process;
use Classes\Set;
use Classes\SetElement;

/**
 * @var $arrayOfProcess Process[]
 */
$arrayOfProcess = array(
    new Process(4, 70),
    new Process(2, 60),
    new Process(4, 50),
    new Process(3, 40),
    new Process(1, 30),
    new Process(4, 20),
    new Process(6, 10)
);
$startTime = 0;
$endTime = 8;

//timeLine
/**
 * @var $timeLine SetElement[]
 */
$timeLine = array();

$expiredProcess = array();

$arrayOfSet = array();
//for ($i = $startTime; $i <= $endTime; $i++){
//    $time[$i] = 0;
//}

//сортировка процессов по убыванию штрафа

usort($arrayOfProcess, function ($p1, $p2) {
//    /** @var $p1 SetElement */
//    /** @var $p2 SetElement */
//    $p1 = $p1->getEntity();
//    $p2 = $p2->getEntity();
    /** @var $p1 Process */
    /** @var $p2 Process */
    if ($p1->getFine() < $p2->getFine())
        return -1;
    if ($p1->getFine() > $p2->getFine())
        return 1;
    return 0;
});

//итерационно получать по одному элементу
foreach ($arrayOfProcess as $process) {
    if (isset( $timeLine[$process->getEndTime()])) {
        $setElement = $timeLine[$process->getEndTime()];
        $set = $setElement->getSet();
        if( ! addProcess($set, $process,$timeLine))
            $expiredProcess[] = &$process;
    } else {
        $set = (new Set());
        $elem = $set->addElement($process);
        $elemData = $elem->getElemData();
        $elemData['time'] = $process->getEndTime();
        $timeLine[$process->getEndTime()] = $elem;
    }
}

var_dump($timeLine);

//foreach ($timeLine as $element){
//    $element->getElemData()['time'];
//}


//__________________________________________________________________

function addProcess(Set $set, Process &$process, &$timeLine)
{
    $representative = $set->getRepresentative();
    if(! isset($timeLine[$representative->getElemData()['time'] - 1])){

        return false;
    }
    if (empty($timeLine[$representative->getElemData()['time'] - 1])) {
        $newSet = new Set();
        $elem = $newSet->addElement($process);
        $elemData = $elem->getElemData();
        $elemData['time'] = $representative->getElemData()['time'] - 1;
        $timeLine[$elemData['time']] = $elem;
        $newSet->addSet($set);
        return true;
    }

    /** @var $setElement SetElement */
    $setElement = $timeLine[$representative->getElemData()['time'] - 1];
    $newSet = $setElement->getSet();
    $newSet->addSet($set);
    return addProcess($newSet, $process, $timeLine);

}

function addExpiredProcess(){

}
