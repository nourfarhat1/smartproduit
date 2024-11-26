<?php

class Category
{
    private ?string $nomcategorie;

    // Constructor
    public function __construct(?string $nomcategorie = null)
    {
        $this->nomcategorie = $nomcategorie;
    }

    // Getters and Setters
    public function getNomCategorie(): ?string
    {
        return $this->nomcategorie;
    }

    public function setNomCategorie(?string $nomcategorie): void
    {
        $this->nomcategorie = $nomcategorie;
    }
}

?>
