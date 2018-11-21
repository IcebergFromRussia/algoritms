<?php
/**
 * Created by PhpStorm.
 * User: Альберт
 * Date: 19.11.2018
 * Time: 4:39
 */

namespace Classes;


class SetElement
{
    /**
     * сущность
     * @var object
     */
    private $entity;
    /**
     * правый сосед
     * @var SetElement
     */
    private $rightNeighbour;
    /**
     * левый сосед
     * @var SetElement
     */
    private $leftNeighbour;

    /**
     * Множество, в котором состоит элемент
     * @var Set
     */
    private $setParent;

    /**
     * SetElement constructor.
     * @param Object $entity
     * @param Set $set
     */
    public function __construct( &$entity, Set &$set)
    {
        $this->entity = &$entity;
        $this->setParent = &$set;
    }

    /**
     * @return object
     */
    public function &getEntity()
    {
        return $this->entity;
    }

    /**
     * @param object $entity
     */
    public function setEntity(&$entity): void
    {
        $this->entity = &$entity;
    }

    /**
     * @return SetElement
     */
    public function &getRightNeighbour(): SetElement
    {
        return $this->rightNeighbour;
    }

    /**
     * @param SetElement $rightNeighbour
     */
    public function setRightNeighbour(SetElement &$rightNeighbour): void
    {
        $this->rightNeighbour = &$rightNeighbour;
    }

    /**
     * @return SetElement
     */
    public function &getLeftNeighbour(): SetElement
    {
        return $this->leftNeighbour;
    }

    /**
     * @param SetElement $leftNeighbour
     */
    public function setLeftNeighbour(SetElement &$leftNeighbour): void
    {
        $this->leftNeighbour = &$leftNeighbour;
    }





}