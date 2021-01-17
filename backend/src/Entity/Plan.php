<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PlanRepository")
 */
class Plan
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFrom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateTo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlanCategory", mappedBy="plan", orphanRemoval=true)
     */
    private $planCategories;

    public function __construct()
    {
        $this->planCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->dateFrom;
    }

    public function setDateFrom(\DateTimeInterface $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->dateTo;
    }

    public function setDateTo(\DateTimeInterface $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * @return Collection|PlanCategory[]
     */
    public function getPlanCategories(): Collection
    {
        return $this->planCategories;
    }

    public function addPlanCategory(PlanCategory $planCategory): self
    {
        if (!$this->planCategories->contains($planCategory)) {
            $this->planCategories[] = $planCategory;
            $planCategory->setPlan($this);
        }

        return $this;
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
}
