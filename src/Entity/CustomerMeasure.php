<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CustomerMeasureRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CustomerMeasureRepository::class)
 */
class CustomerMeasure
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Model", inversedBy="customerMeasures")
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="customerMeasures")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Measure", inversedBy="customerMeasures")
     */
    private $measure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getMeasure(): ?Measure
    {
        return $this->measure;
    }

    public function setMeasure(?Measure $measure): self
    {
        $this->measure = $measure;

        return $this;
    }
}
