<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book", uniqueConstraints={@ORM\UniqueConstraint(name="book_isbn_key", columns={"isbn"})}, indexes={@ORM\Index(name="book_author_id", columns={"author_id"})})
 * @ORM\Entity
 */
class Book
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="book_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="isbn", type="bigint", nullable=true)
     */
    private $isbn;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=127, nullable=false)
     */
    private $title;

    /**
     * @var \Application\Entity\Author
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Author")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     * })
     */
    private $author;



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
     * Set isbn.
     *
     * @param int|null $isbn
     *
     * @return Book
     */
    public function setIsbn($isbn = null)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn.
     *
     * @return int|null
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author.
     *
     * @param \Application\Entity\Author|null $author
     *
     * @return Book
     */
    public function setAuthor(\Application\Entity\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return \Application\Entity\Author|null
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
