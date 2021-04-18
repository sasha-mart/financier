<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PlanRepository")
 */
class Plan
{
    /**
     * @ORM\Column(type="date")
     */
    private $dateFrom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateTo;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlanCategory", mappedBy="plan", orphanRemoval=true)
     */
    private $planCategories;

    public function __construct()
    {
        $this->planCategories = new ArrayCollection();
    }

    public function addPlanCategory(PlanCategory $planCategory): self
    {
        if (!$this->planCategories->contains($planCategory)) {
            $this->planCategories[] = $planCategory;
            $planCategory->setPlan($this);
        }

        return $this;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->dateFrom;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->dateTo;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|PlanCategory[]
     */
    public function getPlanCategories(): Collection
    {
        return $this->planCategories;
    }

    public function removePlanCategory(PlanCategory $planCategory): self
    {
        if ($this->planCategories->contains($planCategory)) {
            $this->planCategories->removeElement($planCategory);
            // set the owning side to null (unless already changed)
            if ($planCategory->getPlan() === $this) {
                $planCategory->setPlan(null);
            }
        }

        return $this;
    }

    public function setDateFrom(\DateTimeInterface $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function setDateTo(\DateTimeInterface $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }
}
