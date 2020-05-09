<?php namespace App\Models;

use \CodeIgniter\Model;

class CardPackModel extends Model
{
    protected $table = "CardPacks";
    protected $primaryKey = "id";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["source", "displayName", "blackCardCount", "whiteCardCount"];

}