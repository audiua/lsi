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
 * Class ShopCondition
 *
 * @ORM\Entity()
 * @ORM\Table(name="shop_condition")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ShopConditionRepository")
 */
class ShopCondition
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
     * @ORM\ManyToOne(targetEntity="Shop", inversedBy="conditions")
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id", nullable=false)
     */
    private $shop;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $leftValue;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $operator;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $rigthValue;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $endOperator;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank()
     * @Gedmo\Sortable()
     */
    private $sort;

    /**
     * @var \DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     *
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
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
     * Set description
     *
     * @param string $description
     *
     * @return ShopCondition
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
     * Set leftValue
     *
     * @param string $leftValue
     *
     * @return ShopCondition
     */
    public function setLeftValue($leftValue)
    {
        $this->leftValue = $leftValue;

        return $this;
    }

    /**
     * Get leftValue
     *
     * @return string
     */
    public function getLeftValue()
    {
        return $this->leftValue;
    }

    /**
     * Set operator
     *
     * @param string $operator
     *
     * @return ShopCondition
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set rigthValue
     *
     * @param string $rigthValue
     *
     * @return ShopCondition
     */
    public function setRigthValue($rigthValue)
    {
        $this->rigthValue = $rigthValue;

        return $this;
    }

    /**
     * Get rigthValue
     *
     * @return string
     */
    public function getRigthValue()
    {
        return $this->rigthValue;
    }

    /**
     * Set endOperator
     *
     * @param string $endOperator
     *
     * @return ShopCondition
     */
    public function setEndOperator($endOperator)
    {
        $this->endOperator = $endOperator;

        return $this;
    }

    /**
     * Get endOperator
     *
     * @return string
     */
    public function getEndOperator()
    {
        return $this->endOperator;
    }

    /**
     * Set sort
     *
     * @param \integer $sort
     *
     * @return ShopCondition
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ShopCondition
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
     * @return ShopCondition
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
     * @return ShopCondition
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
