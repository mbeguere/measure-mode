<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DressMakerRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *  attributes={"pagination_enabled"=false},
 *  normalizationContext={"groups"={"dressMaker:read"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"username": "exact"})
 * @ORM\Entity(repositoryClass=DressMakerRepository::class)
 */
class DressMaker extends User
{
    /**
     * @ORM\OneToMany(targetEntity=Customer::class, mappedBy="dressMaker")
     * @Groups({"dressMaker:read"})
     */
    private $customers;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
    }

    /**
     * @return Collection|Customer[]
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers[] = $customer;
            $customer->setDressMaker($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        if ($this->customers->contains($customer)) {
            $this->customers->removeElement($customer);
            // set the owning side to null (unless already changed)
            if ($customer->getDressMaker() === $this) {
                $customer->setDressMaker(null);
            }
        }

        return $this;
    }
}
