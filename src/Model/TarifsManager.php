<?php



namespace App\Model;

use App\Model\Connection;
use PDO;

/**
 * Abstract class handling default manager.
 */
abstract class TarifsManager extends AbstractManager
{
    public const TABLE = 'chambre';

    public function selectTarifs(): array
    {
        $query = 'SELECT prix FROM ' . self::TABLE;
        
        return $this->pdo->query($query)->fetchAll();
    }
}