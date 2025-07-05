<?php
namespace src\Models;
use src\Enum\Role;

class Utilisateur
{
    

    protected ?int $id;
    protected string $login;
    protected string $motDePasse;
    protected Role $role;
    protected string $nom;
    protected string $prenom;
    protected string $email;

    public function __construct(
        ?int $id,
        string $login,
        string $motDePasse,
        Role $role,
        string $nom,
        string $prenom,
        string $email
    ) {

        $this->id = $id;
        $this->login = $login;
        $this->motDePasse = $motDePasse;
        $this->role = $role;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function setMotDePasse(string $motDePasse): void
    {
        $this->motDePasse = $motDePasse;
    }

    public function setRole(Role $role): void {
        $this->role = $role;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
