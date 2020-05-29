<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookExemplar
 *
 * @ORM\Table(name="book_exemplar", indexes={@ORM\Index(name="book_exemplar_user_id", columns={"user_id"}), @ORM\Index(name="book_exemplar_book_id", columns={"book_id"})})
 * @ORM\Entity
 */
class BookExemplar
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="book_exemplar_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Application\Entity\Book
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     * })
     */
    private $book;



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
     * Set book.
     *
     * @param \Application\Entity\Book|null $book
     *
     * @return BookExemplar
     */
    public function setBook(\Application\Entity\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book.
     *
     * @return \Application\Entity\Book|null
     */
    public function getBook()
    {
        return $this->book;
    }
}
