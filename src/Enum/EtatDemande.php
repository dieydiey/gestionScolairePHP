<?php
namespace src\Enum;

enum EtatDemande: string {
    case EN_ATTENTE = 'en attente';
    case ACCEPTEE = 'acceptée';
    case REFUSEE = 'refusée';
}
