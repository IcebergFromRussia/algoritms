<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 19.11.2018
 * Time: 4:35
 */

namespace Classes;


class Set
{
    /**
     * представитель множества
     * @var SetElement
     */
    private $representative;

    /**
     * конец множества
     * @var SetElement
     */
    private $endOfSet;

    /**
     * Создаётся SetElement по входному объекту и добавляется в множество
     * @param $element
     * @var object
     * @return SetElement
     */
    public function &addElement(&$element)
    {
        $end = new SetElement($element, $this);
        $this->addSetElement($end);
        return $end;
    }

    /**
     * Добавляет SetElement в множество
     * @var SetElement
     */
    public function addSetElement(SetElement &$end)
    {
        if(! $this->checkForEmpty($end)){
            $end->setLeftNeighbour($this->getEndOfSet());
            $this->getEndOfSet()->setRightNeighbour($end);
        }
        $this->setEndOfSet($end);
    }

    /**
     * @param Set $set
     * @return Set
     */
    public function addSet(Set $set)
    {
        if (empty($this->getRepresentative())) {
            $this->setRepresentative($set->getRepresentative());
            $this->setEndOfSet($set->getEndOfSet());
            return $this;
        }
        $set->setRepresentative($this->getRepresentative());
        $this->setEndOfSet($set->getEndOfSet());
        return $this;
    }

    /**
     * @param SetElement $end
     */
    public function setEndOfSet(SetElement &$end)
    {
        $this->checkForEmpty($end);
        $this->endOfSet = $end;
    }

    /**
     * @return SetElement
     */
    public function &getEndOfSet()
    {
        return $this->endOfSet;
    }

    /**
     * @return SetElement
     */
    public function &getRepresentative()
    {
        return $this->representative;
    }

    /**
     * @param SetElement $representative
     */
    public function setRepresentative(SetElement $representative)
    {
        $this->checkForEmpty($representative);
        //TODO если указывается представитель должен ли он быть уже участником множества?
        $this->representative = $representative;
    }

    private function checkForEmpty($setElement)
    {
        $empty = false;
        if (empty($this->getEndOfSet())) {
            $this->endOfSet = $setElement;
            $empty = true;
        }
        if (empty($this->getRepresentative())) {
            $this->representative = $setElement;
            $empty = true;
        }
        return $empty;
    }
}