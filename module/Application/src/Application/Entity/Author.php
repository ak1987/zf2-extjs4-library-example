<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 * Author
 *
 * @ORM\Table(name="author", uniqueConstraints={@ORM\UniqueConstraint(name="author_name_key", columns={"name"})})
 * @ORM\Entity
 */
class Author
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="author_id_seq", allocationSize=1, initialValue=1)
     * @Annotation\Type("Zend\Form\Element\Hidden")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Required({"required" : "true"})
     * @Annotation\Filter({"name" : "StripTags"})
     * @Annotation\Attributes({"id" : "name", "class" : "form-control", "required" : "required"})
     * @Annotation\Options({"label" : "Author"})
     * @Annotation\Validator({"name" : "StringLength", "options" : {"min" : 11, "max" : "64"}})
     */
    private $name;

    /**
     * @Annotation\Type("Zend\Form\Element\Submit")
     * @Annotation\Attributes({"id" : "btn_submit", "class" : "btn btn-primary", "value" : "save"})
     * @Annotation\AllowEmpty({"allowempty" : "true"})
     */
    public $submit;



    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Author
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
