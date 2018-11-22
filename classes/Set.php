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
    public function addSetElement(SetElement &$end): void
    {
        $end->setLeftNeighbour($this->getEndOfSet());
        $this->getEndOfSet()->setRightNeighbour($end);
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
    public function setEndOfSet(SetElement &$end): void
    {
        if (empty($this->getEndOfSet()) & empty($this->getRepresentative())) {
            $this->endOfSet = $end;
            $this->representative = $end;
        }
        $this->endOfSet = $end;
    }

    /**
     * @return SetElement
     */
    public function &getEndOfSet(): SetElement
    {
        return $this->endOfSet;
    }

    /**
     * @return SetElement
     */
    public function &getRepresentative(): SetElement
    {
        return $this->representative;
    }

    /**
     * @param SetElement $representative
     */
    public function setRepresentative(SetElement $representative): void
    {
        if (empty($this->getEndOfSet()) & empty($this->getRepresentative())) {
            $this->endOfSet = $representative;
            $this->representative = $representative;
        }
        $this->representative = $representative;
    }
}