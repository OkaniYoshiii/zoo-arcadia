<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;
use Throwable;

class Animal implements EntityInterface
{
    use EntityTrait;
    
    private ?int $animal_id;
    private ?string $firstname;
    private ?string $state;
    private ?int $breed_id;
    private ?int $habitat_id;
    private ?int $views;

    private ?Breed $breed;
    private ?Habitat $habitat;
    private ?array $animal_images;
    private ?array $veterinarian_reports;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        if(isset($properties['animal_id'])) $this->animal_id = $properties['animal_id'];

        if(isset($properties['firstname'])) $this->firstname = $properties['firstname'];
        if(isset($properties['state'])) $this->state = $properties['state'];
        if(isset($properties['breed_id'])) $this->breed_id = $properties['breed_id'];
        if(isset($properties['habitat_id'])) $this->habitat_id = $properties['habitat_id'];
       
        if(isset($properties['views'])) $this->views = $properties['views'];

        if(isset($properties['breed'])) $this->breed = $properties['breed'];
        if(isset($properties['habitat'])) $this->habitat = $properties['habitat'];
        if(isset($properties['animal_images'])) $this->animal_images = $properties['animal_images'];

        if(isset($properties['veterinarian_reports'])) $this->veterinarian_reports = $properties['veterinarian_reports'];
    }

    /**
     * Get the value of animal_id
     */ 
    public function getAnimalId()
    {
        return $this->animal_id;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of breed_id
     */ 
    public function getBreedId()
    {
        return $this->breed_id;
    }

    /**
     * Set the value of breed_id
     *
     * @return  self
     */ 
    public function setBreedId($breed_id)
    {
        $this->breed_id = $breed_id;

        return $this;
    }

    /**
     * Get the value of habitat_id
     */ 
    public function getHabitatId()
    {
        return $this->habitat_id;
    }

    /**
     * Set the value of habitat_id
     *
     * @return  self
     */ 
    public function setHabitatId($habitat_id)
    {
        $this->habitat_id = $habitat_id;

        return $this;
    }

    /**
     * Get the value of views
     */ 
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set the value of views
     *
     * @return  self
     */ 
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get the value of breed
     */ 
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * Set the value of breed
     *
     * @return  self
     */ 
    public function setBreed($breed)
    {
        $this->breed = $breed;

        return $this;
    }

    /**
     * Get the value of habitat
     */ 
    public function getHabitat()
    {
        return $this->habitat;
    }

    /**
     * Set the value of habitat
     *
     * @return  self
     */ 
    public function setHabitat($habitat)
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * Get the value of animal_images
     */ 
    public function getAnimalImages()
    {
        return $this->animal_images;
    }

    /**
     * Set the value of animal_images
     *
     * @return  self
     */ 
    public function setAnimalImages($animal_images)
    {
        $this->animal_images = $animal_images;

        return $this;
    }

    /**
     * Get the value of veterinarian_reports
     */ 
    public function getVeterinarianReports()
    {
        try {
            return $this->veterinarian_reports;
        } catch(Throwable $e) {
            return null;
        }
    }

    /**
     * Set the value of veterinarian_reports
     *
     * @return  self
     */ 
    public function setVeterinarianReports($veterinarian_reports)
    {
        $this->veterinarian_reports = $veterinarian_reports;

        return $this;
    }
}