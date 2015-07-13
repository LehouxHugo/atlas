<?php

namespace ADM\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Country
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ADM\CoreBundle\Entity\CountryRepository")
 */
class Country
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="nameEN", type="string", length=255)
     */
    private $nameEN;

    /**
     * @var string
     *
     * @ORM\Column(name="countryCode2", type="string", length=2)
     */
    private $countryCode2;

    /**
     * @var string
     *
     * @ORM\Column(name="countryCode3", type="string", length=3)
     */
    private $countryCode3;

    /**
     * @var string
     *
     * @ORM\Column(name="numericCountryCode", type="string", length=3)
     */
    private $numericCountryCode;


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
     * @var integer
     *
     * @ORM\Column(name="zoomLevel", type="smallint")
     */
    private $zoomLevel;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


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
     * @return Country
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
     * Set latitude
     *
     * @param float $latitude
     * @return Country
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
     * @return Country
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
     * Set zoomLevel
     *
     * @param integer $zoomLevel
     * @return Country
     */
    public function setZoomLevel($zoomLevel)
    {
        $this->zoomLevel = $zoomLevel;

        return $this;
    }

    /**
     * Get zoomLevel
     *
     * @return integer 
     */
    public function getZoomLevel()
    {
        return $this->zoomLevel;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Country
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set countryCode2
     *
     * @param string $countryCode2
     * @return Country
     */
    public function setCountryCode2($countryCode2)
    {
        $this->countryCode2 = $countryCode2;

        return $this;
    }

    /**
     * Get countryCode2
     *
     * @return string 
     */
    public function getCountryCode2()
    {
        return $this->countryCode2;
    }

    /**
     * Set countryCode3
     *
     * @param string $countryCode3
     * @return Country
     */
    public function setCountryCode3($countryCode3)
    {
        $this->countryCode3 = $countryCode3;

        return $this;
    }

    /**
     * Get countryCode3
     *
     * @return string 
     */
    public function getCountryCode3()
    {
        return $this->countryCode3;
    }

    /**
     * Set numericCountryCode
     *
     * @param string $numericCountryCode
     * @return Country
     */
    public function setNumericCountryCode($numericCountryCode)
    {
        $this->numericCountryCode = $numericCountryCode;

        return $this;
    }

    /**
     * Get numericCountryCode
     *
     * @return string 
     */
    public function getNumericCountryCode()
    {
        return $this->numericCountryCode;
    }


    /**
     * Set nameEN
     *
     * @param string $nameEN
     * @return Country
     */
    public function setNameEN($nameEN)
    {
        $this->nameEN = $nameEN;

        return $this;
    }

    /**
     * Get nameEN
     *
     * @return string 
     */
    public function getNameEN()
    {
        return $this->nameEN;
    }
}
