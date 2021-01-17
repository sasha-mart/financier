<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"transaction:read"}, "swagger_definition_name"="Read"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @Groups({"transaction:read"})
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"transaction:read"})
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @Groups({"transaction:read"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @Groups({"transaction:read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $initiator;

    /**
     * @Groups({"transaction:read"})
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @Groups({"transaction:read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @Groups({"transaction:read"})
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $additionalInfo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getInitiator(): ?string
    {
        return $this->initiator;
    }

    public function setInitiator(string $initiator): self
    {
        $this->initiator = $initiator;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    public function setAdditionalInfo($additionalInfo): void
    {
        $this->additionalInfo = $additionalInfo;
    }
}
