<?php
/**
 * Created by PhpStorm.
 * User: Kostiantyn Tarnashynskyi
 * Email: kostia.tarnashynskyi@gmail.com
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Cron
 *
 * @ORM\Entity()
 * @ORM\Table(name="cron")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\CronRepository")
 */

class Cron
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Shop", inversedBy="crons")
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $shop;

    /**
     * @var $createdAt

     * @ORM\Column(name="created_at",type="integer", nullable=false)
     */
    private $createdAt;
    
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
     * Get createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set shop
     *
     * @param \AppBundle\Entity\Shop $shop
     *
     * @return FieldMap
     */
    public function setShop(\AppBundle\Entity\Shop $shop = null)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get shop
     *
     * @return \AppBundle\Entity\Shop
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Cron
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
