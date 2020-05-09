<?php namespace App\Models;

use \CodeIgniter\Model;

class GameCardStackModel extends Model
{
    protected $table = "GameCardStacks";
    protected $primaryKey = "id";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["type", "gameId", "cardId", "lastSeen", "used"];

}