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
     * @var string
     *
     * @ORM\Column(name="csv_separator", type="string", length=255, nullable=true)
     */
    private $csvSeparator;

    /**
     * @var integer
     * Default value 10m
     * @ORM\Column(name="repeat_time", type="integer", nullable=false)
     */
    private $repeatTime = 600;

    /**
     * @ORM\OneToMany(targetEntity="FieldMap", mappedBy="shop", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $fields;

    /**
     * @ORM\OneToMany(targetEntity="ShopCondition", mappedBy="shop", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $conditions;

    /**
     * @ORM\OneToMany(targetEntity="Cron", mappedBy="shop", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $crons;


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
     * Constructor
     */
    public function __construct()
    {
        $this->fields = new \Doctrine\Common\Collections\ArrayCollection();
        $this->conditions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->crons = new \Doctrine\Common\Collections\ArrayCollection();
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
        $field->setShop($this);

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
        $field->setShop(null);
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
        $condition->setShop($this);

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
        $condition->setShop(null);
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

    /**
     * Set repeatTime
     *
     * @param string $repeatTime
     *
     * @return Shop
     */
    public function setRepeatTime($repeatTime)
    {
        $this->repeatTime = $repeatTime;

        return $this;
    }

    /**
     * Get repeatTime
     *
     * @return integer
     */
    public function getRepeatTime()
    {
        return $this->repeatTime;
    }

    /**
     * Add cron
     *
     * @param \AppBundle\Entity\Cron $cron
     *
     * @return Shop
     */
    public function addCron(\AppBundle\Entity\Cron $cron)
    {
        $this->crons[] = $cron;
        $cron->setShop($this);

        return $this;
    }

    /**
     * Remove cron
     *
     * @param \AppBundle\Entity\Cron $cron
     */
    public function removeCron(\AppBundle\Entity\Cron $cron)
    {
        $this->crons->removeElement($cron);
        $cron->setShop(null);
    }

    /**
     * Get crons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCrons()
    {
        return $this->crons;
    }

    /**
     * Set csvSeparator
     *
     * @param string $csvSeparator
     *
     * @return Shop
     */
    public function setCsvSeparator($csvSeparator)
    {
        $this->csvSeparator = $csvSeparator;

        return $this;
    }

    /**
     * Get csvSeparator
     *
     * @return string
     */
    public function getCsvSeparator()
    {
        return $this->csvSeparator;
    }
}
