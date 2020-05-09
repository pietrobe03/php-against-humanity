<?php namespace App\Models;

use \CodeIgniter\Model;

class UserSessionModel extends Model
{
    protected $table = "UserSessions";
    protected $primaryKey = "id";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["username", "usertag", "sessionToken", "lastSeen"];

}