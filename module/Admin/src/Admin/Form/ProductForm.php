<?php

namespace Admin\Form;

use Zend\Form\Form;


/**
 * Class ProductForm
 *
 * @author Petr Marochkin <petun911@gmail.com>
 */
class ProductForm extends Form
{
    public function __construct($name, array $options)
    {
        parent::__construct('product', []);

        $this->add([
            'name' => 'id',
            'type' => 'Hidden',
        ]);

        $this->add([
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Title',
            ),
        ]);

        $this->add([
            'name' => 'description',
            'type' => 'Text',
        ]);

        $this->add([
            'name' => 'category_id',
            'type' => 'Text',
        ]);

        $this->attributes = [
            'method' => 'post'
        ];


        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Save',
                'id' => 'testId'
            ]
        ]);
    }

}