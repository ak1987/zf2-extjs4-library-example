<?php

namespace Admin\Filter;

use Zend\InputFilter\InputFilter;

class AuthorAddInputFilter extends InputFilter {
    protected $objectManager;

    public function __construct($objectManager)
    {
        $this->objectManager = $objectManager;

        $this->add(array(
            'name' => 'name',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 5,
                        'max' => 64
                    )
                ),
                array(
                    'name' => 'DoctrineModule\Validator\NoObjectExists',
                    'options' => array(
                        'object_repository' => $this->objectManager->getRepository('Application\Entity\Author'),
                        'fields' => 'name',
                        'messages' => array(
                            'objectFound' => 'This record already exists.'
                        )
                    )
                )
            ),
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            )
        ));
    }
}