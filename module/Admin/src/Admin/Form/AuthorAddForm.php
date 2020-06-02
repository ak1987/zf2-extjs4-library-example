<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Application\Entity\Author;
use Admin\Filter\AuthorAddInputFilter;

class AuthorAddForm extends Form implements ObjectManagerAwareInterface {

    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('authorAddForm');
        $this->setObjectManager($objectManager);
        $this->createElements();
    }

    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function getObjectManager()
    {
        return $this->objectManager;
    }

    public function createElements() {
        // form generation
        $this->setAttribute('method', 'post');

        $this->setInputFilter(new AuthorAddInputFilter($this->objectManager));

        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name'
            ),
        ));

        // submit
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Save'
            )
        ));
    }
}