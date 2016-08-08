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
 * Class Result
 *
 * @ORM\Entity()
 * @ORM\Table(name="result")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ResultRepository")
 */
class Result
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
     * @ORM\ManyToOne(targetEntity="Shop", inversedBy="results")
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $shop;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $orderId;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $currency;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $orderedAt;

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
     * Set orderId
     *
     * @param string $orderId
     *
     * @return Result
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Result
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return Result
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set total
     *
     * @param string $total
     *
     * @return Result
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set orderedAt
     *
     * @param string $orderedAt
     *
     * @return Result
     */
    public function setOrderedAt($orderedAt)
    {
        $this->orderedAt = $orderedAt;

        return $this;
    }

    /**
     * Get orderedAt
     *
     * @return string
     */
    public function getOrderedAt()
    {
        return $this->orderedAt;
    }

    /**
     * Set shop
     *
     * @param \AppBundle\Entity\Shop $shop
     *
     * @return Result
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
