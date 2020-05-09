<?php namespace App\Models;

use \CodeIgniter\Model;

class GameSessionModel extends Model
{
    protected $table = "GameSessions";
    protected $primaryKey = "id";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["gameId", "userId", "spectator", "score", "cards", "pickedCard", "blankContent", "usedDumps", "lastSeen", "queuenumber"];

}