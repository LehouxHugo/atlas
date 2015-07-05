<?php

namespace ADM\ReportsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organization
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ADM\ReportsBundle\Entity\OrganizationRepository")
 */
class Organization
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
     * @ORM\Column(name="legalName", type="string", length=255)
     */
    private $legalName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="foundingDate", type="datetime")
     */
    private $foundingDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dissolutionDate", type="datetime")
     */
    private $dissolutionDate;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255)
     */
    private $logo;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberOfEmployees", type="integer")
     */
    private $numberOfEmployees;


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
     * @return Organization
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
     * Set legalName
     *
     * @param string $legalName
     * @return Organization
     */
    public function setLegalName($legalName)
    {
        $this->legalName = $legalName;

        return $this;
    }

    /**
     * Get legalName
     *
     * @return string 
     */
    public function getLegalName()
    {
        return $this->legalName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Organization
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Organization
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Organization
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set foundingDate
     *
     * @param \DateTime $foundingDate
     * @return Organization
     */
    public function setFoundingDate($foundingDate)
    {
        $this->foundingDate = $foundingDate;

        return $this;
    }

    /**
     * Get foundingDate
     *
     * @return \DateTime 
     */
    public function getFoundingDate()
    {
        return $this->foundingDate;
    }

    /**
     * Set dissolutionDate
     *
     * @param \DateTime $dissolutionDate
     * @return Organization
     */
    public function setDissolutionDate($dissolutionDate)
    {
        $this->dissolutionDate = $dissolutionDate;

        return $this;
    }

    /**
     * Get dissolutionDate
     *
     * @return \DateTime 
     */
    public function getDissolutionDate()
    {
        return $this->dissolutionDate;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Organization
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set numberOfEmployees
     *
     * @param integer $numberOfEmployees
     * @return Organization
     */
    public function setNumberOfEmployees($numberOfEmployees)
    {
        $this->numberOfEmployees = $numberOfEmployees;

        return $this;
    }

    /**
     * Get numberOfEmployees
     *
     * @return integer 
     */
    public function getNumberOfEmployees()
    {
        return $this->numberOfEmployees;
    }
}
