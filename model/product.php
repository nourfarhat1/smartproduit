<?php

class Product
{
    private ?int $idprod;
    private ?string $nomprod;
    private ?string $nomcategorie; 
    private ?float $priceprod;
    private ?string $descriptionprod;
    private ?string $imageprod;  // New property for image

    // Constructor
    public function __construct(
        ?int $idprod = null,
        ?string $nomprod = null,
        ?string $nomcategorie = null, 
        ?float $priceprod = null,
        ?string $descriptionprod = null,
        ?string $imageprod = null  // Include image in constructor
    ) {
        $this->idprod = $idprod;
        $this->nomprod = $nomprod;
        $this->nomcategorie = $nomcategorie; 
        $this->priceprod = $priceprod;
        $this->descriptionprod = $descriptionprod;
        $this->imageprod = $imageprod;  // Initialize image
    }

    // Getters and Setters

    public function getIdProd(): ?int
    {
        return $this->idprod;
    }

    public function setIdProd(?int $idprod): void
    {
        $this->idprod = $idprod;
    }

    public function getNomProd(): ?string
    {
        return $this->nomprod;
    }

    public function setNomProd(?string $nomprod): void
    {
        $this->nomprod = $nomprod;
    }

    public function getNomCategorie(): ?string 
    {
        return $this->nomcategorie;
    }

    public function setNomCategorie(?string $nomcategorie): void 
    {
        $this->nomcategorie = $nomcategorie;
    }

    public function getPriceProd(): ?float
    {
        return $this->priceprod;
    }

    public function setPriceProd(?float $priceprod): void
    {
        $this->priceprod = $priceprod;
    }

    public function getDescriptionProd(): ?string
    {
        return $this->descriptionprod;
    }

    public function setDescriptionProd(?string $descriptionprod): void
    {
        $this->descriptionprod = $descriptionprod;
    }

    public function getImageProd(): ?string  // New getter for image
    {
        return $this->imageprod;
    }

    public function setImageProd(?string $imageprod): void  // New setter for image
    {
        $this->imageprod = $imageprod;
    }
}
?>