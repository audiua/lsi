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
 * Class FieldMap
 *
 * @ORM\Entity()
 * @ORM\Table(name="field_map")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\FieldMapRepository")
 */

class FieldMap
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
     * @ORM\ManyToOne(targetEntity="Shop", inversedBy="fields")
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id", nullable=false)
     */
    private $shop;

    /**
     * @var string
     *
     * @ORM\Column(name="shop_field", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     */
    private $shopField;

    /**
     * @var string
     *
     * @ORM\Column(name="result_field", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     */
    private $resultField;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at",type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at",type="datetime")
     */
    private $updatedAt;

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
     * Set shopField
     *
     * @param string $shopField
     *
     * @return FieldMap
     */
    public function setShopField($shopField)
    {
        $this->shopField = $shopField;

        return $this;
    }

    /**
     * Get shopField
     *
     * @return string
     */
    public function getShopField()
    {
        return $this->shopField;
    }

    /**
     * Set resultField
     *
     * @param string $resultField
     *
     * @return FieldMap
     */
    public function setResultField($resultField)
    {
        $this->resultField = $resultField;

        return $this;
    }

    /**
     * Get resultField
     *
     * @return string
     */
    public function getResultField()
    {
        return $this->resultField;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return FieldMap
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return FieldMap
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return FieldMap
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set shop
     *
     * @param \AppBundle\Entity\Shop $shop
     *
     * @return FieldMap
     */
    public function setShop(\AppBundle\Entity\Shop $shop)
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
}
