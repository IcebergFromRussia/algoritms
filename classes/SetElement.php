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
     * дополнительные данные
     * @var array
     */
    private $elemData = array();

    /**
     * SetElement constructor.
     * @param Object $entity
     * @param Set $set
     */
    public function __construct( &$entity, &$set = null)
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
    public function setEntity(&$entity)
    {
        $this->entity = &$entity;
    }
    /**
     * @return Set
     */
    public function getSet()
    {
        return $this->setParent;
    }

    /**
     * @return SetElement
     */
    public function &getRightNeighbour()
    {
        return $this->rightNeighbour;
    }

    /**
     * @param SetElement $rightNeighbour
     */
    public function setRightNeighbour( &$rightNeighbour)
    {
        $this->rightNeighbour = &$rightNeighbour;
    }


    /**
     * @return array
     */
    public function &getElemData(): array
    {
        return $this->elemData;
    }

    /**
     * @param array $elemData
     */
    public function setElemData(array $elemData)
    {
        $this->elemData = $elemData;
    }

    /**
     * @return SetElement
     */
    public function &getLeftNeighbour()
    {
        return $this->leftNeighbour;
    }

    /**
     * @param SetElement $leftNeighbour
     */
    public function setLeftNeighbour( &$leftNeighbour)
    {
        $this->leftNeighbour = &$leftNeighbour;
    }





}