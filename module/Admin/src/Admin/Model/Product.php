<?php

namespace Admin\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;


/**
 * Class Product
 *
 * @author Petr Marochkin <petun911@gmail.com>
 */
class Product implements InputFilterAwareInterface
{

    public $id;

    public $name;

    public $category_id;

    public $description;

    public $category;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        echo "Exhange array: " . print_r($data, true);
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->description = (!empty($data['description'])) ? $data['description'] : null;
        $this->category_id = (!empty($data['category_id'])) ? $data['category_id'] : null;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     *
     * @return InputFilterAwareInterface
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {

    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        $this->inputFilter = new InputFilter();

        $this->inputFilter->add(array(
            'name' => 'id',
            'required' => true,
            'filters' => array(
                array('name' => 'Int'),
            ),
        ));

        $this->inputFilter->add(array(
            'name' => 'name',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
        ));


        return $this->inputFilter;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id
        ];
    }
}