<?php

namespace ADM\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="ADM\UserBundle\Entity\Repository\UserRepository")
 */
class User extends BaseUser
{
  public function __construct()
  {
    parent::__construct();
    $this->groups = new  ArrayCollection();
    $this->reports = new  ArrayCollection();
}

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     *
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
     * @ORM\JoinTable(name="users_groups")
     */
    protected $groups;

    /**
     * @ORM\ManyToMany(targetEntity="ADM\ReportsBundle\Entity\Report", mappedBy="authors", cascade={"persist"})
     **/
    private $reports;

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
     * Add groups
     *
     * @param \ADM\UserBundle\Entity\Group $groups
     * @return User
     */
    public function addGroup(\FOS\UserBundle\Model\GroupInterface $group)
    {
        $this->groups[] = $group;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \ADM\UserBundle\Entity\Group $groups
     */
    public function removeGroup(\FOS\UserBundle\Model\GroupInterface $group)
    {
        $this->groups->removeElement($group);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups()
    {
        return $this->groups;
    }



    /**
     * Add reports
     *
     * @param \ADM\ReportsBundle\Entity\Report $reports
     * @return User
     */
    public function addReport(\ADM\ReportsBundle\Entity\Report $reports)
    {
        $this->reports[] = $reports;

        return $this;
    }

    /**
     * Remove reports
     *
     * @param \ADM\ReportsBundle\Entity\Report $reports
     */
    public function removeReport(\ADM\ReportsBundle\Entity\Report $reports)
    {
        $this->reports->removeElement($reports);
    }

    /**
     * Get reports
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReports()
    {
        return $this->reports;
    }

    public function getLabel()
    {
        if($this->getFirstname()== null && $this->getLastname() == null ){
            return $this->getUsername();
        }
        return $this->getFirstname() .' '. $this->getLastname() .'';
    }
}
