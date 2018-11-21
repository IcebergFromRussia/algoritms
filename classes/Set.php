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
     */
    public function addElement(&$element): void
    {
        $end = new SetElement($element, $this);
        $this->addSetElement($end);
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