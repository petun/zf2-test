<?php

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;


/**
 * Class ProductTable
 *
 * @author Petr Marochkin <petun911@gmail.com>
 */
class ProductTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }


    public function getProducts()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /**
     * @param $id
     *
     * @return array|\ArrayObject|null
     * @throws \Exception
     */
    public function getProduct($id)
    {
        $id  = (int) $id;
        $resultSet = $this->tableGateway->select(array('id' => $id));
        $row = $resultSet->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function save(Product $product)
    {
        if ($product->id) {
            return $this->tableGateway->update($product->getArrayCopy(), ['id' => $product->id]);
        } else {
            return $this->tableGateway->insert($product->getArrayCopy());
        }

    }


}