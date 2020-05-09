<?php


namespace App\Controllers;


use App\Models\CardModel;

class Game extends BaseController
{
    public function index() {
        isLoggedIn() || url_redirect(base_url("login"));

        $data = array(
            "title" => "Welcome"
        );
        echo view("game/index", $data);
    }

    public function login() {
        !isLoggedIn() || url_redirect(base_url());

        $data = array(
            "title" => "Welcome"
        );
        echo view("auth/login", $data);
    }

    public function manage($gameToken = null) {
        isLoggedIn() || url_redirect(base_url("login"));

        $gameModel = new \App\Models\GameModel();
        $userModel = new \App\Models\UserSessionModel();
        $cardPackModel = new \App\Models\CardPackModel();
        $cardModel = new \App\Models\CardModel();

        if ($gameToken == null) {
            url_redirect(base_url());
        }

        $game = $gameModel->where("publictoken", $gameToken)->first();
        if ($game == null) {
            url_redirect(base_url());
        }

        $owner = $userModel->where("id", $game["owner"])->first();

        if (getUserSession()["id"] != $game["owner"]) {
            url_redirect(base_url());
        }

        if ($game["state"] != "waiting") {
            url_redirect(base_url("game/play/".$gameToken));
        }

        $cardPacksRaw = $cardPackModel->findAll();
        $cardPacks = array();

        foreach ($cardPacksRaw as $cpRaw) {
            $blackCardCount = count($cardModel->where("type", 0)->where("packId", $cpRaw["id"])->findAll());
            $whiteCardCount = count($cardModel->where("type", 1)->where("packId", $cpRaw["id"])->findAll());

            $cardPacks[] = [
                "name" => $cpRaw["displayName"],
                "id" => $cpRaw["id"],
                "blackCardCount" => $blackCardCount,
                "whiteCardCount" => $whiteCardCount,
            ];
        }

        $data = array(
            "title" => "Manage game",
            "name" => $game["name"],
            "owner" => [
                "username" => $owner["username"],
                "usertag" => $owner["usertag"]
            ],
            "token" => $gameToken,
            "cardpacks" => $cardPacks,
            "game" => $game,
            "enabledpacks" => json_decode($game["enabledpacks"], true),
        );
        echo view("game/manage", $data);
    }

    public function lobby($gameToken = null) {
        isLoggedIn() || url_redirect(base_url("login"));

        $gameModel = new \App\Models\GameModel();
        $gameSessionModel = new \App\Models\GameSessionModel();
        $userModel = new \App\Models\UserSessionModel();


        if ($gameToken == null) {
            url_redirect(base_url());
        }

        $game = $gameModel->where("publictoken", $gameToken)->first();
        if ($game == null) {
            url_redirect(base_url());
        }

        $gameSession = $gameSessionModel->where("gameId", $game["id"])->where("userId", getUserSession()["id"])->first();

        if ($gameSession == null) {
            url_redirect(base_url());
        }

        $gameSessionModel->where("gameId", $game["id"])->where("userId", getUserSession()["id"])->set("lastSeen", time())->update();
        $owner = $userModel->where("id", $game["owner"])->first();

        if ($game["state"] != "waiting") {
            url_redirect(base_url("game/play/".$gameToken));
        }

        if (getUserSession()["id"] == $game["owner"]) {
            url_redirect(base_url("game/manage/".$gameToken));
        }

        $data = array(
            "title" => "Waiting",
            "name" => $game["name"],
            "owner" => [
                "username" => $owner["username"],
                "usertag" => $owner["usertag"]
            ],
            "token" => $gameToken,
        );
        echo view("game/lobby", $data);
    }

    public function play($gameToken = null) {
        isLoggedIn() || url_redirect(base_url("login"));

        $gameModel = new \App\Models\GameModel();
        $gameSessionModel = new \App\Models\GameSessionModel();
        $userModel = new \App\Models\UserSessionModel();


        if ($gameToken == null) {
            url_redirect(base_url());
        }

        $game = $gameModel->where("publictoken", $gameToken)->first();

        if ($game == null) {
            url_redirect(base_url());
        }

        $gameSession = $gameSessionModel->where("gameId", $game["id"])->where("userId", getUserSession()["id"])->first();
        $gameSessionModel->where("gameId", $game["id"])->where("userId", getUserSession()["id"])->set("lastSeen", time())->update();
        $owner = $userModel->where("id", $game["owner"])->first();

        if ($gameSession == null) {
            url_redirect(base_url());
        }

        if ($game["state"] == "waiting") {
            url_redirect(base_url("game/lobby/".$gameToken));
        }

        $data = array(
            "title" => "Playing",
            "name" => $game["name"],
            "owner" => [
                "username" => $owner["username"],
                "usertag" => $owner["usertag"]
            ],
            "token" => $gameToken,
            "body_classes" => "d-flex flex-column game-body",
        );
        echo view("game/play", $data);
    }

}