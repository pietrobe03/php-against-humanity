<?php


namespace App\Controllers;


use Config\App;

class GameAPI extends BaseController
{
    public function status() {
        $answer = array(
            "loggedIn" => false
        );

        if (isLoggedIn()) {
            $answer["loggedIn"] = true;
        }

        $action = $this->request->getPost("action");
        if (isLoggedIn() && !empty($action)) {
            switch ($action) {
                case "gamelist":
                    $gameModel = new \App\Models\GameModel();
                    $gameSessionModel = new \App\Models\GameSessionModel();
                    $userModel = new \App\Models\UserSessionModel();
                    $gamesRaw = $gameModel->findAll();

                    $games = [];
                    foreach ($gamesRaw as $gameRaw) {
                        $user = $userModel->where("id", $gameRaw["owner"])->first();

                        if ($user == null) {
                            continue;
                        }

                        $owner = [
                            "username" => $user["username"],
                            "usertag" => $user["usertag"]
                        ];

                        $players = $gameSessionModel->where("gameId", $gameRaw["id"])->where("spectator", 0)->findAll();
                        $spectators = $gameSessionModel->where("gameId", $gameRaw["id"])->where("spectator", 1)->findAll();

                        $playerCount = count($players);
                        $playerMax = $gameRaw["playermax"];
                        $spectatorCount = count($spectators);

                        $tags = array();
                        if ($gameRaw["password"] != "") {
                            $tags[] = "passworded";
                        }

                        if ($playerCount >= $playerMax) {
                            $tags[] = "full";
                        }

//                        if ($gameRaw["spectatorsenabled"] == true) {
//                            $tags[] = "spectate";
//                        }

                        if ($gameRaw["state"] == "waiting") {
                            $tags[] = "waiting";
                        } elseif ($gameRaw["state"] == "running") {
                            $tags[] = "running";
                        } elseif ($gameRaw["state"] == "finished") {
                            $tags[] = "finished";
                        }

                        $games[] = [
                            "token" => $gameRaw["publictoken"],
                            "name" => $gameRaw["name"],
                            "owner" => $owner,
                            "playercount" => $playerCount,
                            "playermax" => $playerMax,
                            "spectatorcount" => $spectatorCount,
                            "tags" => $tags,
                        ];
                    }

                    $cacheHash = md5(json_encode($games));
                    if ($cacheHash == $this->request->getPost("cacheHash")) {
                        $answer["games"] = "valid";
                    } else {
                        $answer["games"] = $games;
                        $answer["cacheHash"] = $cacheHash;
                    }

                    break;

                case "gamelobby":
                    $gameModel = new \App\Models\GameModel();
                    $gameSessionModel = new \App\Models\GameSessionModel();
                    $userModel = new \App\Models\UserSessionModel();

                    $token = $this->request->getPost("token");
                    $game = $gameModel->where("publictoken", $token)->first();

                    if ($game == null) {
                        $answer["status"] = "game_missing";
                        $answer["message"] = "There are no games with this token.";
                    } else {
                        $gameSession = $gameSessionModel->where("userId", getUserSession()["id"])->where("gameId", $game["id"])->first();
                        if ($gameSession == null) {
                            $answer["status"] = "session_missing";
                            $answer["message"] = "You are not member of this game.";
                        } else {
                            $gameSessionModel->where("gameId", $game["id"])->where("userId", getUserSession()["id"])->set("lastSeen", time())->update();
                            if ($game["state"] != "waiting") {
                                $answer["status"] = "game_started";
                            } else {
                                $players = array();
                                $gameSessionRaw = $gameSessionModel->where("gameId", $game["id"])->where("spectator", 0)->findAll();
                                foreach ($gameSessionRaw as $gsRaw) {
                                    $user = $userModel->where("id", $gsRaw["userId"])->first();
                                    $players[] = [
                                        "username" => $user["username"],
                                        "usertag" => $user["usertag"]
                                    ];
                                }

                                $cacheHash = md5(json_encode($players));
                                if ($cacheHash == $this->request->getPost("cacheHash")) {
                                    $answer["players"] = "valid";
                                } else {
                                    $answer["players"] = $players;
                                    $answer["cacheHash"] = $cacheHash;
                                }
                            }
                        }
                    }
                    break;

                case "gamemanage":
                    $gameModel = new \App\Models\GameModel();
                    $gameSessionModel = new \App\Models\GameSessionModel();
                    $userModel = new \App\Models\UserSessionModel();

                    $token = $this->request->getPost("token");
                    $configRaw = $this->request->getPost("config");

                    $game = $gameModel->where("publictoken", $token)->where("owner", getUserSession()["id"])->first();

                    if ($game == null) {
                        $answer["status"] = "game_missing";
                        $answer["message"] = "There are no games with this token owned by you.";
                    } else {
                        $gameSession = $gameSessionModel->where("userId", getUserSession()["id"])->where("gameId", $game["id"])->first();
                        if ($gameSession == null) {
                            $answer["status"] = "session_missing";
                            $answer["message"] = "You are not member of this game.";
                        } else {
                            $config = json_decode($configRaw, true);
                            if (is_array($config) || is_object($config)) {
                                $changes = array();

                                if (isset($config["name"])) {
                                    if (strlen($config["name"]) < 3 || strlen($config["name"]) > 32) {
                                        $answer["message"] = "The game's name must be between 3 and 32 characters long.";
                                    } elseif (preg_replace('/[\x00-\x1F\x7F]/', '', $config["name"]) != $config["name"]) {#
                                        $answer["message"] = "There are invalid characters in the game's name.";
                                    } else {
                                        $changes["name"] = $config["name"];
                                    }
                                }

                                if (isset($config["password"]) && isset($config["passwordChanged"]) && $config["passwordChanged"] == 1) {
                                    $changes["password"] = (trim($config["password"]) == "" ? "" : password_hash($config["password"], PASSWORD_DEFAULT));
                                }

                                if (isset($config["playermax"]) && is_numeric($config["playermax"]) && $config["playermax"] >= 3 && $config["playermax"] <= 12) {
                                    $changes["playermax"] = $config["playermax"];
                                }

                                if (isset($config["scoregoal"]) && is_numeric($config["scoregoal"]) && $config["scoregoal"] >= 3 && $config["scoregoal"] <= 15) {
                                    $changes["scoregoal"] = $config["scoregoal"];
                                }

                                if (isset($config["cardHandCount"]) && is_numeric($config["cardHandCount"]) && $config["cardHandCount"] >= 4 && $config["cardHandCount"] <= 10) {
                                    $changes["cardHandCount"] = $config["cardHandCount"];
                                }

                                if (isset($config["allowedDumps"]) && is_numeric($config["allowedDumps"]) && $config["allowedDumps"] >= 0 && $config["allowedDumps"] <= 100) {
                                    $changes["allowedDumps"] = $config["allowedDumps"];
                                }

                                if (isset($config["blankcount"]) && is_numeric($config["blankcount"]) && $config["blankcount"] >= 0 && $config["blankcount"] <= 50) {
                                    $changes["blankcount"] = $config["blankcount"];
                                }

                                if (isset($config["timeout"]) && is_numeric($config["timeout"]) && $config["timeout"] >= 30 && $config["timeout"] <= 120) {
                                    $changes["timeout"] = $config["timeout"];
                                }

                                if (isset($config["enabledpacks"]) && is_array($config["enabledpacks"])) {
                                    $packs = array();
                                    foreach ($config["enabledpacks"] as $enabledpack) {
                                        if (is_numeric($enabledpack)) {
                                            $packs[] = $enabledpack;
                                        }
                                    }
                                    $changes["enabledpacks"] = json_encode($packs);
                                }

                                if (!empty($changes)) {
                                    $gameModel->where("publictoken", $token)->set($changes)->update();
                                }
                            }

                            $gameSessionModel->where("gameId", $game["id"])->where("userId", getUserSession()["id"])->set("lastSeen", time())->update();

                            $players = array();
                            $gameSessionRaw = $gameSessionModel->where("gameId", $game["id"])->where("spectator", 0)->findAll();
                            foreach ($gameSessionRaw as $gsRaw) {
                                $user = $userModel->where("id", $gsRaw["userId"])->first();
                                $players[] = [
                                    "username" => $user["username"],
                                    "usertag" => $user["usertag"]
                                ];
                            }

                            $cacheHash = md5(json_encode($players));
                            if ($cacheHash == $this->request->getPost("cacheHash")) {
                                $answer["players"] = "valid";
                            } else {
                                $answer["players"] = $players;
                                $answer["cacheHash"] = $cacheHash;
                            }
                        }
                    }
                    break;

                case "gameplay":
                    $gameModel = new \App\Models\GameModel();
                    $gameCardStackModel = new \App\Models\GameCardStackModel();
                    $cardModel = new \App\Models\CardModel();
                    $gameSessionModel = new \App\Models\GameSessionModel();
                    $userModel = new \App\Models\UserSessionModel();

                    $token = $this->request->getPost("token");
                    $game = $gameModel->where("publictoken", $token)->first();

                    if ($game == null) {
                        $answer["status"] = "game_missing";
                        $answer["message"] = "There are no games with this token.";
                    } else {
                        $gameSession = $gameSessionModel->where("userId", getUserSession()["id"])->where("gameId", $game["id"])->first();
                        if ($gameSession == null) {
                            $answer["status"] = "session_missing";
                            $answer["message"] = "You are not member of this game.";
                        } else {
                            $gameSessionModel->where("gameId", $game["id"])->where("userId", getUserSession()["id"])->set("lastSeen", time())->update();
                            if ($game["state"] == "waiting") {
                                $answer["status"] = "game_not_started";
                            } else {
                                $players = array();
                                $gameSessionRaw = $gameSessionModel->where("gameId", $game["id"])->orderBy("score", "desc")->orderBy("userId", "asc")->findAll();

                                $db = \Config\Database::connect();

                                foreach ($gameSessionRaw as $gsRaw) {
                                    $user = $userModel->where("id", $gsRaw["userId"])->first();
                                    $players[] = [
                                        "username" => $user["username"],
                                        "usertag" => $user["usertag"],
                                        "score" => $gsRaw["score"],
                                        "judge" => ($gsRaw["userId"] == $game["judge"]),
                                        "done" => ($gsRaw["pickedCard"] != "[]"),
                                    ];

                                    $cards = json_decode($gsRaw["cards"], true);
                                    if ($gsRaw["userId"] == getUserSession()["id"] && count($cards) < $game["cardHandCount"]) {
                                        $diff = $game["cardHandCount"] - count($cards);
                                        $cardsRaw = $gameCardStackModel->where("gameId", $game["id"])->where("type", 1)->where("used", 0)->orderBy("id", "asc")->findAll($diff);
                                        foreach ($cardsRaw as $card) {
                                            $cards[] = (int) $card["cardId"];
                                        }
                                        $db->query("
                                        UPDATE GameCardStacks SET used = 1 WHERE id IN (
                                            SELECT * FROM (
                                                SELECT id FROM GameCardStacks WHERE gameId = " . $game["id"] . " AND type = 1 AND used = 0 ORDER BY id ASC LIMIT " . $diff . "
                                            ) as t
                                        );");
                                        $gameSessionModel->where("id", $gsRaw["id"])->set(["cards" => json_encode($cards)])->update();
                                    }
                                }


                                $answer["players"] = $players;

                                $gameSession = $gameSessionModel->where("gameId", $game["id"])->where("userId", getUserSession()["id"])->first();

                                if (time() > $game["phaseTimeout"]) {
                                    $newTimeout = time() + $game["timeout"] + 5;

                                    // Move on to next phase
                                    switch ($game["phase"]) {
                                        case "picking":

                                            $playerWithSelection = $gameSessionModel->where("gameId", $game["id"])->where("pickedCard !=", "[]")->first();
                                            if ($playerWithSelection == null) {
                                                $gameModel->where("id", $game["id"])->set(["phaseTimeout" => $newTimeout])->update();
                                            } else {
                                                $gameModel->where("id", $game["id"])->set(["phase" => "judging", "phaseTimeout" => $newTimeout])->update();
                                            }
                                            break;

                                        case "judging":
                                        case "result":
                                            $gameSessionModel->where("gameId", $game["id"])->set(["pickedCard" => "[]", "blankContent" => "[]"])->update();
                                            $judgeSession = $gameSessionModel->where("gameId", $game["id"])->where("userId", $game["judge"])->first();

                                            $winner = $gameSessionModel->where("gameId", $game["id"])->where("score >=", (int) $game["scoregoal"])->first();
                                            if ($winner != null) {
                                                $gameModel->where("id", $game["id"])->set(["state" => "finished", "judge" => -1, "phaseTimeout" => $newTimeout, "phase" => "finished"])->update();

                                            } else {
                                                $newJudge = $gameSessionModel->where("gameId", $game["id"])->where("queuenumber >", $judgeSession["queuenumber"])->orderBy("queuenumber", "asc")->first();
                                                if ($newJudge == null) {
                                                    $newJudge = $gameSessionModel->where("gameId", $game["id"])->where("queuenumber >", 0)->orderBy("queuenumber", "asc")->first();
                                                }

                                                $db = \Config\Database::connect();
                                                $blackCardRaw = $gameCardStackModel->where("gameId", $game["id"])->where("type", 0)->where("used", 0)->orderBy("id", "asc")->first();
                                                $db->query("
                                                    UPDATE GameCardStacks SET used = 1 WHERE id IN (
                                                        SELECT * FROM (
                                                            SELECT id FROM GameCardStacks WHERE gameId = " . $game["id"] . " AND type = 0 AND used = 0 ORDER BY id ASC LIMIT 1
                                                        ) as t
                                                    );
                                                ");

                                                $gameModel->where("id", $game["id"])->set(["phase" => "picking", "phaseTimeout" => $newTimeout, "judge" => $newJudge["userId"], "blackcard" => $blackCardRaw["cardId"]])->update();
                                            }

                                        break;

                                        case "finished":
                                            $gameModel->where("id", $game["id"])->delete();
                                            $answer["status"] = "game_missing";
                                            $answer["message"] = "There are no games with this token.";
                                            $this->response->setJSON($answer);
                                            $this->response->send();
                                            return;
                                            break;
                                    }
                                }

                                switch ($game["phase"]) {
                                    case "picking":
                                        $blackCard = $cardModel->where("id", $game["blackcard"])->first();
                                        $answer["blackCard"] = array(
                                            "text" => $blackCard["content"],
                                            "blanks" => $blackCard["pick"],
                                        );

                                        if ($game["judge"] == $gameSession["userId"]) {
                                            // Is judge
                                            $answer["phase"] = "judge_wait";
                                        } elseif ($gameSession["pickedCard"] == "[]") {
                                            // Is player
                                            $answer["cardHand"] = array();
                                            foreach (json_decode($gameSession["cards"], true) as $cardId) {
                                                $cardId = (int) $cardId;
                                                if ($cardId == -1) {
                                                    $answer["cardHand"][] = array(
                                                        "id" => $cardId,
                                                        "content" => "____",
                                                        "blank" => true,
                                                    );
                                                } else {
                                                    $card = $cardModel->where("id", $cardId)->first();
                                                    $answer["cardHand"][] = array(
                                                        "id" => $cardId,
                                                        "content" => $card["content"]
                                                    );
                                                }
                                            }
                                            $answer["dumpsLeft"] = $game["allowedDumps"] - $gameSession["usedDumps"];
                                            $answer["phase"] = "picking";
                                        } else {
                                            $answer["phase"] = "wait_picking";
                                        }
                                        break;

                                    case "judging":
                                        $blackCard = $cardModel->where("id", $game["blackcard"])->first();
                                        $answer["blackCard"] = array(
                                            "text" => $blackCard["content"],
                                            "blanks" => $blackCard["pick"],
                                        );

                                        $answer["whiteCardSelections"] = array();
                                        $playersRaw = $gameSessionModel->where("gameId", $game["id"])->where("pickedCard !=", "[]")->orderBy("pickedCard", "asc")->findAll();
                                        foreach ($playersRaw as $player) {
                                            $cards = array();

                                            $blankIndex = 0;
                                            $blankCards = @json_decode($player["blankContent"]);

                                            foreach (json_decode($player["pickedCard"], true) as $cardId) {
                                                if ($cardId == -1) {
                                                    $cards[] = $blankCards[$blankIndex];
                                                    $blankIndex++;
                                                } else {
                                                    $card = $cardModel->where("id", $cardId)->first();
                                                    $cards[] = $card["content"];
                                                }

                                            }

                                            $answer["whiteCardSelections"][] = array(
                                                "id" => (int) $player["userId"],
                                                "cards" => $cards,
                                            );
                                        }

                                        if ($game["judge"] == $gameSession["userId"]) {
                                            // Is judge
                                            $answer["phase"] = "judging";
                                        } else {
                                            // Is player
                                            $answer["phase"] = "wait_judging";
                                        }
                                        break;

                                    case "result":
                                        $blackCard = $cardModel->where("id", $game["blackcard"])->first();
                                        $answer["blackCard"] = array(
                                            "text" => $blackCard["content"],
                                            "blanks" => $blackCard["pick"],
                                        );

                                        $answer["whiteCardSelections"] = array();
                                        $answer["phase"] = "result";
                                        $playersRaw = $gameSessionModel->where("gameId", $game["id"])->where("pickedCard !=", "[]")->orderBy("pickedCard", "asc")->findAll();
                                        foreach ($playersRaw as $player) {
                                            $cards = array();

                                            $blankIndex = 0;
                                            $blankCards = @json_decode($player["blankContent"]);

                                            foreach (json_decode($player["pickedCard"], true) as $cardId) {
                                                if ($cardId == -1) {
                                                    $cards[] = $blankCards[$blankIndex];
                                                    $blankIndex++;
                                                } else {
                                                    $card = $cardModel->where("id", $cardId)->first();
                                                    $cards[] = $card["content"];
                                                }

                                            }

                                            $answer["whiteCardSelections"][] = array(
                                                "winner" => ((int) $player["userId"] == (int) $game["winner"]),
                                                "cards" => $cards,
                                            );
                                        }
                                        break;

                                    case "finished":
                                        $answer["phase"] = "finished";
                                        break;
                                }

                                $cacheHash = md5(json_encode($answer));

                                if ($cacheHash == $this->request->getPost("cacheHash")) {
                                    unset($answer["players"], $answer["cardHand"], $answer["answers"], $answer["blackCard"]);
                                    $answer["cacheHash"] = "valid";
                                } else {
                                    $answer["players"] = $players;
                                    $answer["cacheHash"] = $cacheHash;
                                }
                            }
                        }
                    }
                    break;

                default:
                    break;
            }
        }

        $this->response->setJSON($answer);
        $this->response->send();
    }

    public function login() {

        $answer = array(
            "status" => "success",
            "message" => "Created new session"
        );
        $success = true;

        $username = $this->request->getPost("username");

        if ($success && isLoggedIn()) {
            $answer["status"] = "error";
            $answer["message"] = "You are already logged in. Please reload the page.";
            $success = false;
        }

        if ($success && empty($username)) {
            $answer["status"] = "error";
            $answer["message"] = "You have to enter a username.";
            $success = false;
        }

        if (extension_loaded('mbstring')) {
            if ($success && mb_strlen($username) < 3 || mb_strlen($username) > 32) {
                $answer["status"] = "error";
                $answer["message"] = "Your username must be between 3 and 32 characters long.";
                $success = false;
            }

        } else {
            // mbstring not loaded

            if ($success && strlen($username) < 3 || strlen($username) > 32) {
                $answer["status"] = "error";
                $answer["message"] = "Your username must be between 3 and 32 characters long.";
                $success = false;
            }
        }

        if ($success && preg_replace('/[\x00-\x1F\x7F]/', '', $username) != $username) {
            $answer["status"] = "error";
            $answer["message"] = "There are invalid characters in your username.";
            $success = false;
        }

        $username = htmlentities($username, ENT_SUBSTITUTE & ENT_HTML5 & ENT_QUOTES);

        if ($success) {
            /** @var App\Models\UserSessionModel $userSessionModel */
            $userSessionModel = new \App\Models\UserSessionModel();

            $sessionToken = generateRandomString(32);
            $userTag = rand(1000, 9999);

            helper("cookie");

            $cookie = [
                'name'   => 'token',
                'value'  => $sessionToken,
                'expire' => '86500',
                'domain' => $this->request->uri->getAuthority(),
                'path'   => '/',
                'prefix' => 'cah_',
                'secure' => FALSE,
                'httponly' => TRUE
            ];
            $this->response->setCookie($cookie);

            $userSessionModel->insert([
                "lastSeen" => time(),
                "username" => $username,
                "sessionToken" => $sessionToken,
                "usertag" => $userTag
            ]);

        }
        $this->response->setJSON($answer);
        $this->response->send();
    }

    public function logout() {
        $answer = array(
            "status" => "success",
            "message" => "Removed current user session"
        );

        if (isLoggedIn()) {
            $userSessionModel = new \App\Models\UserSessionModel();
            $userSessionModel->where("id", getUserSession()["id"])->delete();
            $this->response->deleteCookie("cah_token");
        }


        $this->response->setJSON($answer);
        $this->response->send();
    }

    public function createGame() {
        $answer = array(
            "status" => "success",
            "message" => "Created new game."
        );
        $success = true;

        $name = $this->request->getPost("name");
        $password = $this->request->getPost("password");
        $spectatorsenabled = $this->request->getPost("spectatorsenabled");
        $playermax = $this->request->getPost("playermax");

        if (!is_numeric($playermax) || $playermax < 3 || $playermax > 8) {
            $playermax = 5;
        }

        if ($success && !isLoggedIn()) {
            $answer["status"] = "error";
            $answer["message"] = "You have to be logged in to create a game.";
            $success = false;
        }

        if ($success && empty($name)) {
            $answer["status"] = "error";
            $answer["message"] = "You have to enter a name.";
            $success = false;
        }

        if ($success && strlen($name) < 3 || strlen($name) > 32) {
            $answer["status"] = "error";
            $answer["message"] = "The game's name must be between 3 and 32 characters long.";
            $success = false;
        }

        if ($success && preg_replace('/[\x00-\x1F\x7F]/', '', $name) != $name) {
            $answer["status"] = "error";
            $answer["message"] = "There are invalid characters in the game's name.";
            $success = false;
        }

        if ($success) {
            $name = esc($name, "html");
            $token = generateRandomString(8);

            $gameModel = new \App\Models\GameModel();

            $uid = getUserSession()["id"];

            $gameModel->insert([
                "publictoken" => $token,
                "name" => $name,
                "owner" => $uid,
                "state" => "waiting",
                "enabledpacks" => "[]",
                "password" => $password == "" ? "" : password_hash($password, PASSWORD_DEFAULT),
                "blankcount" => 30,
                "playermax" => $playermax,
                "spectatorsenabled" => ($spectatorsenabled == 1),
                "lastSeen" => time() + 30,
                "timeout" => 60,
                "winner" => 0,
                "scoregoal" => 5,
                "cardHandCount" => 8,
                "allowedDumps" => 0,
            ]);

            $gid = $gameModel->where("publictoken", $token)->first()["id"];

            $gameSessionModel = new \App\Models\GameSessionModel();
            $gameSessionModel->insert([
                "userId" => $uid,
                "gameId" => $gid,
                "cards" => "[]",
                "pickedCard" => "[]",
                "score" => 0,
                "spectator" => false,
                "lastSeen" => time() + 30,
                "queuenumber" => rand(0, 100000),
                "usedDumps" => 0,
            ]);

            $answer["token"] = $token;
        }

        $this->response->setJSON($answer);
        $this->response->send();
    }

    public function joinGame() {
        $answer = array(
            "status" => "success",
            "message" => "Joined the game."
        );

        $gametoken = $this->request->getPost("token");
        $password = $this->request->getPost("password");
        $spectator = $this->request->getPost("spectator");

        $gameModel = new \App\Models\GameModel();
        $gameSessionModel = new \App\Models\GameSessionModel();

        $game = $gameModel->where("publictoken", $gametoken)->first();

        if (!isLoggedIn()) {
            $answer["status"] = "error";
            $answer["message"] = "You have to be logged in to join a game.";

        } elseif ($game == null) {
            $answer["status"] = "error";
            $answer["message"] = "There is no game with this token.";

        } elseif ($spectator == 1 && !$game["spectatorsenabled"]) {
            $answer["status"] = "error";
            $answer["message"] = "Spectating is not allowed in this game.";

        } elseif ($spectator == 0 && $game["password"] != "" && !password_verify($password, $game["password"])) {
            $answer["status"] = "error";
            $answer["message"] = "The given password is incorrect.";

        } else {
            $playerCount = count($gameSessionModel->where("gameId", $game["id"])->where("spectator", 0)->findAll());

            if ($game["playermax"] <= $playerCount)  {
                $answer["status"] = "error";
                $answer["message"] = "The game is full.";

            } else {
                $uid = getUserSession()["id"];

                if ($gameSessionModel->where("gameId", $game["id"])->where("userId", $uid)->first() == null) {
                    $gameSessionModel->insert([
                        "userId" => $uid,
                        "gameId" => $game["id"],
                        "cards" => "[]",
                        "pickedCard" => "[]",
                        "blankContent" => "[]",
                        "score" => 0,
                        "spectator" => $spectator == 1,
                        "lastSeen" => time() + 30,
                        "queuenumber" => rand(0, 100000),
                        "usedDumps" => 0,
                    ]);
                }
            }
        }

        $this->response->setJSON($answer);
        $this->response->send();
    }

    public function leaveGame() {
        $answer = array(
            "status" => "success",
            "message" => "Left the game."
        );
        $success = true;

        $gametoken = $this->request->getPost("token");

        $gameModel = new \App\Models\GameModel();
        $gameSessionModel = new \App\Models\GameSessionModel();

        $game = $gameModel->where("publictoken", $gametoken)->first();

        if (!isLoggedIn()) {
            $answer["status"] = "error";
            $answer["message"] = "You have to be logged in to leave a game.";
            $success = false;
        }

        if ($success && $game == null) {
            $answer["status"] = "error";
            $answer["message"] = "There is no game with this token.";
            $success = false;
        }

        if ($success) {
            $gameSessionModel->where("gameId", $game["id"])->where("userId", getUserSession()["id"])->delete();
        }

        $this->response->setJSON($answer);
        $this->response->send();
    }

    public function startGame() {
        $answer = array(
            "status" => "success",
            "message" => "Started the game."
        );

        if (!isLoggedIn()) {
            $answer["status"] = "error";
            $answer["message"] = "You have to be logged in to leave a game.";
        } else {
            $gameModel = new \App\Models\GameModel();
            $gameSessionModel = new \App\Models\GameSessionModel();
            $gameCardStackModel = new \App\Models\GameCardStackModel();
            $cardModel = new \App\Models\CardModel();
            $cardPackModel = new \App\Models\CardPackModel();

            $token = $this->request->getPost("token");
            $game = $gameModel->where("publictoken", $token)->where("owner", getUserSession()["id"])->first();

            if ($game == null) {
                $answer["status"] = "error";
                $answer["message"] = "There is no game with this token.";
            } else {
                $gameSessionModel->where("gameId", $game["id"])->where("userId", getUserSession()["id"])->set("lastSeen", time())->update();

                $cardPacksRaw = $cardPackModel->whereIn("id", json_decode($game["enabledpacks"], true))->findAll();

                $blackCardSum = 0;
                $whiteCardSum = 0;

                $cardStack = array();
                $lastSeen = time() + 30;

                // Add blank white cards
                for ($i = 0; $i < $game["blankcount"]; $i++) {
                    $cardStack[] = array(
                        "type" => 1,
                        "gameId" => $game["id"],
                        "cardId" => -1,
                        "lastSeen" => $lastSeen,
                    );
                }

                foreach ($cardPacksRaw as $cpRaw) {
                    $blackCards = $cardModel->where("type", 0)->where("packId", $cpRaw["id"])->findAll();
                    $whiteCards = $cardModel->where("type", 1)->where("packId", $cpRaw["id"])->findAll();

                    foreach ($blackCards as $bCard) {
                        $cardStack[] = array(
                            "type" => 0,
                            "gameId" => $game["id"],
                            "cardId" => $bCard["id"],
                            "lastSeen" => $lastSeen
                        );
                    }

                    foreach ($whiteCards as $wCard) {
                        $cardStack[] = array(
                            "type" => 1,
                            "gameId" => $game["id"],
                            "cardId" => $wCard["id"],
                            "lastSeen" => $lastSeen
                        );
                    }

                    $blackCardCount = count($blackCards);
                    $whiteCardCount = count($whiteCards);

                    $blackCardSum += $blackCardCount;
                    $whiteCardSum += $whiteCardCount;
                }

                if ($blackCardSum < 80 || $whiteCardSum < 200) {
                    $answer["status"] = "error";
                    $answer["message"] = "More card packs need to be selected (Min. 80b + 200w w/o blanks).";
                } else {
                    $playerCount = count($gameSessionModel->where("gameId", $game["id"])->where("spectator", 0)->findAll());

                    if ($playerCount < 3) {
                        $answer["status"] = "error";
                        $answer["message"] = "Not enough players.";
                    } elseif ($playerCount > 10) {
                        $answer["status"] = "error";
                        $answer["message"] = "Too many players.";
                    } else {

                        $shuffleSteps = count($cardStack) * 100;
                        for ($i = 0; $i < $shuffleSteps; $i++) {
                            $pos1 = rand(0, count($cardStack) - 1);
                            $pos2 = rand(0, count($cardStack) - 1);
                            $tmp = $cardStack[$pos1];
                            $cardStack[$pos1] = $cardStack[$pos2];
                            $cardStack[$pos2] = $tmp;
                        }

                        $gameCardStackModel->insertBatch($cardStack);

                        $db = \Config\Database::connect();


                        $unusedCount = $gameCardStackModel->where("gameId", $game["id"])->where("type", 0)->where("used", 0)->countAllResults();

                        if ($unusedCount <= 10) {
                            $gameCardStackModel->where("gameId", $game["id"])->where("type", 0)->set([
                                "used" => 0,
                            ])->update();
                        }

                        $blackCardRaw = $gameCardStackModel->where("gameId", $game["id"])->where("type", 0)->where("used", 0)->orderBy("id", "asc")->first();
                        $db->query("
                                UPDATE GameCardStacks SET used = 1 WHERE id IN (
                                    SELECT * FROM (
                                        SELECT id FROM GameCardStacks WHERE gameId = " . $game["id"] . " AND type = 0 AND used = 0 ORDER BY id ASC LIMIT 1
                                    ) as t
                                );
                            ");

                        $judge = $gameSessionModel->where("gameId", $game["id"])->orderBy("queuenumber", "asc")->first()["userId"];

                        $gameModel->where("id", $game["id"])->set([
                            "state" => "playing",
                            "phase" => "picking",
                            "judge" => $judge,
                            "phaseTimeout" => time() + $game["timeout"] + 5,
                            "blackcard" => $blackCardRaw["cardId"]
                        ])->update();
                        $answer["status"] = "success";
                        $answer["message"] = "Started the game.";
                    }
                }
            }
        }

        $this->response->setJSON($answer);
        $this->response->send();
    }

    public function pickCards() {
        $answer = array(
            "status" => "success",
        );

        $gametoken = $this->request->getPost("token");
        $cardSelectionRaw = $this->request->getPost("cardSelection");
        $blankContentRaw = $this->request->getPost("blankContent");
        $dumpCards = $this->request->getPost("dumpCards") == 1;

        $gameModel = new \App\Models\GameModel();
        $cardModel = new \App\Models\CardModel();
        $gameSessionModel = new \App\Models\GameSessionModel();


        $game = $gameModel->where("publictoken", $gametoken)->first();

        if (!isLoggedIn()) {
            $answer["status"] = "error";
            $answer["message"] = "You have to be logged in to leave a game.";

        } elseif ($game == null) {
            $answer["status"] = "error";
            $answer["message"] = "There is no game with this token.";

        } else {
            $cardSelection = @json_decode($cardSelectionRaw, true);
            if (!is_array($cardSelection)) {
                $answer["status"] = "error";
                $answer["message"] = "Invalid parameter.";

            } else {
                $blackCard = $cardModel->where("id", $game["blackcard"])->first();
                $gameSession = $gameSessionModel->where("gameId", $game["id"])->where("userId", getUserSession()["id"])->first();

                if (count($cardSelection) != $blackCard["pick"]) {
                    $answer["status"] = "error";
                    $answer["message"] = "Invalid card amount.";

                } else {
                    $valid = $gameSession["cards"];
                    $cardHand = json_decode($gameSession["cards"], true);
                    $blanksOnHand = 0;
                    $blanksChosen = 0;

                    for ($i = 0; $i < count($cardSelection); $i++) {
                        for ($j = 0; $j < count($cardSelection); $j++) {
                            if ($i != $j && $cardSelection[$i] == $cardSelection[$j] && $cardSelection[$i] != -1) {
                                $valid = false;
                            }
                        }

                        if (!in_array($cardSelection[$i], $cardHand)) {
                            $valid = false;
                        }

                        if ($cardSelection[$i] == -1) {
                            $blanksChosen++;
                        }
                    }

                    foreach ($cardHand as $card) {
                        if ($card == -1) {
                            $blanksOnHand++;
                        }
                    }

                    $blankContent = array();

                    if ($blanksChosen > 0) {
                        $blankContent = @json_decode($blankContentRaw, true);
                    }

                    if ($blanksChosen > $blanksOnHand || !is_array($blankContent) || count($blankContent) != $blanksChosen) {
                        $valid = false;
                    }

                    if ($game["allowedDumps"] - $gameSession["usedDumps"] <= 0 && $dumpCards) {
                        $valid = false;
                    }

                    if ($game["phase"] != "picking") {
                        $valid = false;
                    }

                    if (!$valid) {
                        $answer["status"] = "error";
                        $answer["message"] = "Something doesn't quite feel right. Probably, somebody tries to cheat the system, hmm..?";
                        $answer["help"] = get_defined_vars();

                    } else {
                        $newCardHand = array();
                        $blanksOnHand = $blanksOnHand - $blanksChosen;
                        foreach ($cardHand as $card) {
                            if (in_array($card, $cardSelection)) {
                                if ($card == -1 && $blanksOnHand > 0) {
                                    $blanksOnHand--;
                                    $newCardHand[] = (int) $card;
                                }
                            } else {
                                $newCardHand[] = (int) $card;
                            }
                        }

                        for ($i = 0; $i < $blanksChosen; $i++) {
                            $blankContent[$i] = esc((string) $blankContent[$i], "html");
                        }

                        $usedDumps = $gameSession["usedDumps"];

                        if ($dumpCards) {
                            $newCardHand = array();
                            $usedDumps++;
                        }

                        $gameSessionModel->where("id", $gameSession["id"])->set([
                            "cards" => json_encode($newCardHand),
                            "pickedCard" => json_encode($cardSelection),
                            "blankContent" => json_encode($blankContent),
                            "usedDumps" => $usedDumps,
                        ])->update();

                        $playerWithoutSelection = $gameSessionModel->where("gameId", $game["id"])->where("spectator", 0)->where("pickedCard", "[]")->findAll();
                        if (count($playerWithoutSelection) == 1 && $playerWithoutSelection[0]["userId"] == $game["judge"]) {
                            $gameModel->where("id", $game["id"])->set(["phase" => "judging", "phaseTimeout" => time() + 5 + $game["timeout"]])->update();
                        }
                    }
                }
            }
        }

        $this->response->setJSON($answer);
        $this->response->send();
    }

    public function pickWinner() {
        $answer = array(
            "status" => "success",
        );

        $gametoken = $this->request->getPost("token");
        $winnerId = (int) $this->request->getPost("winnerSelection");

        $gameModel = new \App\Models\GameModel();
        $gameSessionModel = new \App\Models\GameSessionModel();


        $game = $gameModel->where("publictoken", $gametoken)->first();

        if (!isLoggedIn()) {
            $answer["status"] = "error";
            $answer["message"] = "You have to be logged in to pick a winner.";

        } elseif ($game == null) {
            $answer["status"] = "error";
            $answer["message"] = "There is no game with this token.";

        } else {
            if (!is_numeric($winnerId) || getUserSession()["id"] == $winnerId) {
                $answer["status"] = "error";
                $answer["message"] = "Invalid parameter.";

            } else {
                $winnerSession = $gameSessionModel->where("gameId", $game["id"])->where("userId", $winnerId)->where("pickedCard !=", "[]")->first();

                if ($winnerSession == null) {
                    $answer["status"] = "error";
                    $answer["message"] = "Invalid parameter.";

                } else {

                    if ($game["phase"] != "judging") {
                        $answer["status"] = "error";
                        $answer["message"] = "Something doesn't quite feel right. Probably, somebody tries to cheat the system, hmm..?";

                    } else {
                        $gameSessionModel->where("id", $winnerSession["id"])->set(["score" => ((int) $winnerSession["score"]) + 1])->update();
                        $gameModel->where("id", $game["id"])->set(["phase" => "result", "phaseTimeout" => time() + 8, "winner" => $winnerSession["userId"]])->update();
                    }
                }
            }
        }

        $this->response->setJSON($answer);
        $this->response->send();
    }
}