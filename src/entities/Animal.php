<?php

class Animal
{
    public function __construct(string $firstname, string $state, Breed $breed, Habitat $habitat, VeterinarianReport $veterinarian_report, AnimalImage $animal_image)
    {
        $this->firstname = $firstname;
        $this->state = $state;
        $this->breed = $breed;
        $this->habitat = $habitat;
        $this->veterinarian_report = $veterinarian_report;
    }
}