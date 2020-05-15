<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MeasureRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MeasureRepository::class)
 */
class Measure
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $datas = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CustomerMeasure", mappedBy="measure")
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

    public function getDatas(): ?array
    {
        return $this->datas;
    }

    public function setDatas(array $datas): self
    {
        $this->datas = $datas;

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
            $customerMeasure->setMeasure($this);
        }

        return $this;
    }

    public function removeCustomerMeasure(CustomerMeasure $customerMeasure): self
    {
        if ($this->customerMeasures->contains($customerMeasure)) {
            $this->customerMeasures->removeElement($customerMeasure);
            // set the owning side to null (unless already changed)
            if ($customerMeasure->getMeasure() === $this) {
                $customerMeasure->setMeasure(null);
            }
        }

        return $this;
    }
}
