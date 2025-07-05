<?php
namespace src\Models;

class Module {
    private int $id;
    private string $libelle;
    private string $code;


    public function __construct(int $id, string $libelle,string $code) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->code= $code;
    }


    public function getId(): int {
        return $this->id;
    }
    
    public function getCode():string{
        return $this->code;
    }

    public function setCode(string $code): void {
        $this->code = $code;
    }


    public function getLibelle(): string {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): void {
        $this->libelle = $libelle;
    }
}
