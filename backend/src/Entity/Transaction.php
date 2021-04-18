<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"transaction:read"}, "swagger_definition_name"="Read"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @Groups({"transaction:read"})
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $additionalInfo;

    /**
     * @Groups({"transaction:read"})
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @Groups({"transaction:read"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @Groups({"transaction:read"})
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @Groups({"transaction:read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @Groups({"transaction:read"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"transaction:read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $initiator;

    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInitiator(): ?string
    {
        return $this->initiator;
    }

    public function isBetweenDates(\DateTimeInterface $dateFrom, \DateTimeInterface $dateTo): bool
    {
        return $this->datetime >= $dateFrom && $this->datetime <= $dateTo;
    }

    public function setAdditionalInfo($additionalInfo): void
    {
        $this->additionalInfo = $additionalInfo;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function setInitiator(string $initiator): self
    {
        $this->initiator = $initiator;

        return $this;
    }
}
