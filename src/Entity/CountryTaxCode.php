<?php

namespace App\Entity;

use App\Repository\CountryTaxCodeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: CountryTaxCodeRepository::class)]
class CountryTaxCode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 16)]
    #[NotBlank]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    #[NotBlank]
    private ?string $country = null;

    #[ORM\Column]
    #[NotBlank]
    private ?int $tax = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getTax(): ?int
    {
        return $this->tax;
    }

    public function setTax(?int $tax): self
    {
        $this->tax = $tax;

        return $this;
    }
}
