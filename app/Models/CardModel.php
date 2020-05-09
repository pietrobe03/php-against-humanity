<?php namespace App\Models;

use \CodeIgniter\Model;

class CardModel extends Model
{
    protected $table = "Cards";
    protected $primaryKey = "id";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["packId", "type", "draw", "pick", "content"];

}