<?php

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;


/**
 * Class CategoryTable
 *
 * @author Petr Marochkin <petun911@gmail.com>
 */
class CategoryTable
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

}