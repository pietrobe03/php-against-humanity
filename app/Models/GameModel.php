<?php namespace App\Models;

use \CodeIgniter\Model;

class GameModel extends Model
{
    protected $table = "Games";
    protected $primaryKey = "id";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["publictoken", "name", "owner", "state", "enabledpacks", "password", "cardHandCount", "blankcount", "allowedDumps", "playermax", "lastSeen", "timeout", "scoregoal", "spectatorsenabled", "judge", "winner", "phase", "phaseTimeout", "blackcard"];

}