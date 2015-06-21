<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ad
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AdRepository")
 */
class Ad implements \JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="string", length=255)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publication_time", type="datetimetz")
     */
    private $publicationTime;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Ad
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Ad
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Set publicationTime
     *
     * @param \DateTime $publicationTime
     * @return Ad
     */
    public function setPublicationTime($publicationTime)
    {
        $this->publicationTime = $publicationTime;

        return $this;
    }

    /**
     * Get publicationTime
     *
     * @return \DateTime 
     */
    public function getPublicationTime()
    {
        return $this->publicationTime;
    }


    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        return array(
            "id" => $this->id,
            "title" => $this->title,
            "body" => $this->body,
            "author" => $this->author,
            "publishedTime" => $this->publicationTime
        );
    }
}
