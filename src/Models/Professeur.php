<?php
namespace src\Models;

class Professeur
{
    private ?int $id;
    private string $nom;
    private string $prenom;
    private string $grade;
    private array $modules = [];
    private array $classes = [];
    private int $nbModules = 0;
    private int $nbClasses = 0;

    public function __construct(int $id, string $nom, string $prenom, string $grade) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->grade = $grade;
    }

    // Getters et setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string { 
        return $this->nom; 
    }
    public function getPrenom(): string {
         return $this->prenom; 
        }

    

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setPreom(string $prenom): void
    {
        $this->prenom = $prenom;
    }


    public function getGrade(): string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): void
    {
        $this->grade = $grade;
    }

    public function getModules(): array { 
        return $this->modules; 
    }

    public function getClasses(): array {
         return $this->classes; 
    }

    public function getNbModules(): int {
         return $this->nbModules; 
    }
    public function getNbClasses(): int { 
        return $this->nbClasses;
     }

    public function setModules(array $modules): void {
        $this->modules = $modules;
        $this->nbModules = count($modules);
    }

    public function setClasses(array $classes): void {
        $this->classes = $classes;
        $this->nbClasses = count($classes);
    }

    
}
