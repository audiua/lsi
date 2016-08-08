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
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $shop;

    /**
     * @var string
     *
     * @ORM\Column(name="shop_field", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $shopField;

    /**
     * @var string
     *
     * @ORM\Column(name="result_field", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $resultField;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $defaultValue;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
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
     * Set defaultValue
     *
     * @param string $defaultValue
     *
     * @return FieldMap
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * Get defaultValue
     *
     * @return string
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }
}
