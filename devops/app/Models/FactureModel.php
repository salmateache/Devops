<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DatabaseException;

class FactureModel extends Model
{
    protected $table      = 'facture';  // Table factures
    protected $primaryKey = 'id';       // Clé primaire
    protected $allowedFields = ['DateFacture', 'client', 'total'];  // Champs autorisés
    protected $useTimestamps = false;   // Pas d'utilisation des timestamps

    // Méthode pour insérer une facture après validation du total
    public function insertFacture(array $data)
    {
        // Vérifier que le total est supérieur à zéro
        if (isset($data['total']) && $data['total'] <= 0) {
            // Lancer une exception si le total est zéro ou inférieur
            throw new DatabaseException('Le total de la facture ne peut pas être égal ou inférieur à zéro.');
        }

        // Si la validation passe, on insère la facture
        return $this->insert($data);
    }
}
