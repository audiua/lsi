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
 * Class Shop
 *
 * @ORM\Entity()
 * @ORM\Table(name="shop")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ShopRepository")
 */
class Shop
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
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="api_url",type="string", length=1000, nullable=false)
     * @Assert\NotBlank()
     */
    private $apiUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="responce_type",type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $responceType;

    /**
     * @var string
     *
     * @ORM\Column(name="responce_raw",type="text", nullable=true)
     */
    private $responceRaw;

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
     * @ORM\OneToMany(targetEntity="FieldMap", mappedBy="shop")
     */
    private $fields;

    /**
     * @ORM\OneToMany(targetEntity="ShopCondition", mappedBy="shop")
     */
    private $conditions;


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
     *
     * @return Shop
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
     * Set description
     *
     * @param string $description
     *
     * @return Shop
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
     * Set apiUrl
     *
     * @param string $apiUrl
     *
     * @return Shop
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;

        return $this;
    }

    /**
     * Get apiUrl
     *
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * Set responceType
     *
     * @param string $responceType
     *
     * @return Shop
     */
    public function setResponceType($responceType)
    {
        $this->responceType = $responceType;

        return $this;
    }

    /**
     * Get responceType
     *
     * @return string
     */
    public function getResponceType()
    {
        return $this->responceType;
    }

    /**
     * Set responceRaw
     *
     * @param string $responceRaw
     *
     * @return Shop
     */
    public function setResponceRaw($responceRaw)
    {
        $this->responceRaw = $responceRaw;

        return $this;
    }

    /**
     * Get responceRaw
     *
     * @return string
     */
    public function getResponceRaw()
    {
        return $this->responceRaw;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Shop
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
     * @return Shop
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
     * Constructor
     */
    public function __construct()
    {
        $this->fields = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add field
     *
     * @param \AppBundle\Entity\FieldMap $field
     *
     * @return Shop
     */
    public function addField(\AppBundle\Entity\FieldMap $field)
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * Remove field
     *
     * @param \AppBundle\Entity\FieldMap $field
     */
    public function removeField(\AppBundle\Entity\FieldMap $field)
    {
        $this->fields->removeElement($field);
    }

    /**
     * Get fields
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Add condition
     *
     * @param \AppBundle\Entity\ShopCondition $condition
     *
     * @return Shop
     */
    public function addCondition(\AppBundle\Entity\ShopCondition $condition)
    {
        $this->conditions[] = $condition;

        return $this;
    }

    /**
     * Remove condition
     *
     * @param \AppBundle\Entity\ShopCondition $condition
     */
    public function removeCondition(\AppBundle\Entity\ShopCondition $condition)
    {
        $this->conditions->removeElement($condition);
    }

    /**
     * Get conditions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConditions()
    {
        return $this->conditions;
    }
}
