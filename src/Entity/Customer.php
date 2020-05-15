<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer extends User
{
    /**
     * @ORM\ManyToOne(targetEntity=DressMaker::class, inversedBy="customers")
     */
    private $dressMaker;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CustomerMeasure", mappedBy="customer")
     */
    private $customerMeasures;

    public function __construct()
    {
        $this->customerMeasures = new ArrayCollection();
    }

    public function getDressMaker(): ?DressMaker
    {
        return $this->dressMaker;
    }

    public function setDressMaker(?DressMaker $dressMaker): self
    {
        $this->dressMaker = $dressMaker;

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
            $customerMeasure->setCustomer($this);
        }

        return $this;
    }

    public function removeCustomerMeasure(CustomerMeasure $customerMeasure): self
    {
        if ($this->customerMeasures->contains($customerMeasure)) {
            $this->customerMeasures->removeElement($customerMeasure);
            // set the owning side to null (unless already changed)
            if ($customerMeasure->getCustomer() === $this) {
                $customerMeasure->setCustomer(null);
            }
        }

        return $this;
    }
}
