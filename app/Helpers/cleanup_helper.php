<?php

function cah_cleanup() {
    cah_cleanup_users();
    cah_cleanup_games();
}

function cah_cleanup_users() {
    $userModel = new \App\Models\UserSessionModel();
    $userModel->where("lastSeen <", time() - 60)->delete();

    foreach (scandir(WRITEPATH."/session/") as $file) {
        if (strpos($file, "ci_session") === false) {
            continue;
        }

        $timestamp = [];
        $sessionFile = file_get_contents(WRITEPATH."/session/".$file);

        preg_match('/__ci_last_regenerate\\|i:(\\d+);/', $sessionFile, $timestamp);
        if ($timestamp[1] < time() - 60) {
            unlink(WRITEPATH."/session/".$file);
        }
    }
}

function cah_cleanup_games() {
    $gameModel = new \App\Models\GameModel();
    $gameSessionModel = new \App\Models\GameSessionModel();
    $gameCardStackModel = new App\Models\GameCardStackModel();
    $userModel = new \App\Models\UserSessionModel();
    $gamesRaw = $gameModel->findAll();

    $gameSessionModel->where("lastSeen <", time() - 180)->delete();

    $games = [];
    foreach ($gamesRaw as $gameRaw) {
        $players = $gameSessionModel->where("gameId", $gameRaw["id"])->findAll();

        $ownerFound = false;
        $playerCount = 0;

        foreach ($players as $player) {
            if ($gameRaw["owner"] == $player["userId"]) {
                $ownerFound = true;
            }

            $playerUser = $userModel->where("id", $player["userId"])->first();
            if ($playerUser == null) {
                $gameSessionModel->where("userId", $player["userId"])->delete();
            } else {
                $playerCount++;
            }
        }

        if (!$ownerFound && ($gameRaw["state"] == "waiting" || $playerCount <= 1)) {
            $gameModel->where("id", $gameRaw["id"])->delete();
        } else {
            $games[] = $gameRaw["id"];
        }
    }

    $db = \Config\Database::connect();
    $db->query("DELETE FROM GameSessions WHERE lastSeen < ".time()." AND gameId NOT IN (SELECT id FROM Games)");

    if (count($userModel->findAll()) <= 0) {
        $db->query("ALTER TABLE UserSessions AUTO_INCREMENT = 0;");
    }

    if (count($gameCardStackModel->findAll()) <= 0) {
        $db->query("ALTER TABLE GameCardStacks AUTO_INCREMENT = 0;");
    }

    if (empty($games)) {
        $gameCardStackModel->where("lastSeen <", time() - 30)->delete();
        $db->query("ALTER TABLE Games AUTO_INCREMENT = 0;");
        $db->query("ALTER TABLE GameSessions AUTO_INCREMENT = 0;");
        //$db->query("ALTER TABLE GameRounds AUTO_INCREMENT = 0;");
    } else {
        $db->query("DELETE FROM GameCardStacks WHERE lastSeen < ".(time() - 30)." AND gameId NOT IN (SELECT id FROM Games)");
    }

}