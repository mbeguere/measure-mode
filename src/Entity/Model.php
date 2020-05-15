<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ModelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ModelRepository::class)
 */
class Model
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CustomerMeasure", mappedBy="model")
     */
    private $customerMeasures;

    public function __construct()
    {
        $this->customerMeasures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|CustomerMeasure[]
     */
    public function getCustomerMeasures(): Collection
    {
        return $this->customerMeasures;
    }

    public function addCustomerMeasure(CustomerMeasure $customerMeasure): self
    {
        if (!$this->customerMeasures->contains($customerMeasure)) {
            $this->customerMeasures[] = $customerMeasure;
            $customerMeasure->setModel($this);
        }

        return $this;
    }

    public function removeCustomerMeasure(CustomerMeasure $customerMeasure): self
    {
        if ($this->customerMeasures->contains($customerMeasure)) {
            $this->customerMeasures->removeElement($customerMeasure);
            // set the owning side to null (unless already changed)
            if ($customerMeasure->getModel() === $this) {
                $customerMeasure->setModel(null);
            }
        }

        return $this;
    }
}
