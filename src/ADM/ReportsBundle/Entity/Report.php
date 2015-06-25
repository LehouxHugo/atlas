<?php

namespace ADM\ReportsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Report
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ADM\ReportsBundle\Entity\ReportRepository")
 */
class Report
{
    public function __construct()
    {
        $this->dateCreated = new \Datetime();
        $this->datePublished = new \Datetime();
        $this->dateModified = new \Datetime();
        $this->authors = new  ArrayCollection();
        $this->keywords = new  ArrayCollection();
    }

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublished", type="datetime")
     */
    private $datePublished;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModified", type="datetime")
     */
    private $dateModified;

    /**
     * @ORM\ManyToMany(targetEntity="ADM\UserBundle\Entity\User", inversedBy="reports", cascade={"persist"})
     * @ORM\JoinTable(name="report_author")
     **/
    private $authors;

    /**
     * @var string
     *
     * @ORM\Column(name="articleBody", type="text")
     */
    private $articleBody;

    /**
     * @ORM\ManyToMany(targetEntity="ADM\ReportsBundle\Entity\Keyword", inversedBy="reports", cascade={"persist"})
     * @ORM\JoinTable(name="report_keyword")
     **/
    private $keywords;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published = true;


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
     * Set name
     *
     * @param string $name
     * @return Report
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Report
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set datePublished
     *
     * @param \DateTime $datePublished
     * @return Report
     */
    public function setDatePublished($datePublished)
    {
        $this->datePublished = $datePublished;

        return $this;
    }

    /**
     * Get datePublished
     *
     * @return \DateTime 
     */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    /**
     * Set dateModified
     *
     * @param \DateTime $dateModified
     * @return Report
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime 
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Set articleBody
     *
     * @param string $articleBody
     * @return Report
     */
    public function setArticleBody($articleBody)
    {
        $this->articleBody = $articleBody;

        return $this;
    }

    /**
     * Get articleBody
     *
     * @return string 
     */
    public function getArticleBody()
    {
        return $this->articleBody;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return Report
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return Report
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Report
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Report
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * Add author
     *
     * @param \ADM\UserBundle\Entity\User $author
     * @return Report
     */
    public function addAuthor(\ADM\UserBundle\Entity\User $author)
    {
        $author->addReport($this);
        $this->authors[] = $author;

        return $this;
    }

    /**
     * Remove author
     *
     * @param \ADM\UserBundle\Entity\User $author
     */
    public function removeAuthor(\ADM\UserBundle\Entity\User $author)
    {
        $this->authors->removeElement($author);
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }



    /**
     * Add keyword
     *
     * @param \ADM\ReportsBundle\Entity\Keyword $keyword
     * @return Report
     */
    public function addKeyword(\ADM\ReportsBundle\Entity\Keyword $keyword)
    {
        $keyword->addReport($this);
        $this->keywords[] = $keyword;

        return $this;
    }

    /**
     * Remove keywords
     *
     * @param \ADM\ReportsBundle\Entity\Keyword $keyword
     */
    public function removeKeyword(\ADM\ReportsBundle\Entity\Keyword $keyword)
    {
        $this->keywords->removeElement($keyword);
    }

    /**
     * Get keywords
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }


}
