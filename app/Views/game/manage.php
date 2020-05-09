<?= $this->extend('templates/full') ?>

<?= $this->section('content') ?>

<?= $this->include('templates/navbar') ?>

    <div class="container-fluid">
        <div class="d-flex m-2">
            <div class="flex-grow-1">
                <h2 class="d-inline">Game "<?= $name ?>"</h2>
                <p class="d-inline text-nowrap"> by <?= $owner["username"] ?><span class="text-muted">#<?= $owner["usertag"] ?></span></p>
            </div>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#leave-modal">Leave and delete game</button>
            </div>
        </div>

        <div class="row mt-4 mb-4">

            <div class="col-12">
                <hr class="border-primary" />
                <h3 class="mb-0">Game options </h3>
                <p class="text-muted">
                    Fields without a save button will be saved automagically.
                </p>

                <div class="row" id="config-list">
                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                        <form id="name-form" class="form-group">
                            <label for="name-input">Game name</label>
                            <div class="input-group">
                                <input type="text" class="form-control bg-dark text-light" required minlength="3" maxlength="32" id="name-input" value="<?= $game["name"] ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-light" type="submit">Save</button>
                                </div>
                            </div>
                            <small class="form-text text-muted">The name has to be between 3 and 32 characters long.</small>
                        </form>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                        <div class="form-group">
                            <label for="maxplayer-input">Player limit</label>
                            <select class="form-control bg-dark text-light" id="maxplayer-input">
                                <?php for ($i = 3; $i <= 8; $i++): ?>
                                <option value="<?= $i ?>" <?= $game["playermax"] == $i ? "selected" : ""; ?>><?= $i ?> Players</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                        <div class="form-group">
                            <label for="timeout-input">Timeout</label>
                            <select class="form-control bg-dark text-light" id="timeout-input">
                                <option value="30" <?= $game["timeout"] == 30 ? "selected" : ""; ?>>30 Seconds</option>
                                <option value="45" <?= $game["timeout"] == 45 ? "selected" : ""; ?>>45 Seconds</option>
                                <option value="60" <?= $game["timeout"] == 60 ? "selected" : ""; ?>>60 Seconds</option>
                                <option value="75" <?= $game["timeout"] == 75 ? "selected" : ""; ?>>75 Seconds</option>
                                <option value="90" <?= $game["timeout"] == 90 ? "selected" : ""; ?>>90 Seconds</option>
                                <option value="120" <?= $game["timeout"] == 120 ? "selected" : ""; ?>>120 Seconds</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                        <div class="form-group">
                            <label for="scoregoal-input">Score required to win</label>
                            <select class="form-control bg-dark text-light" id="scoregoal-input">
                                <?php for ($i = 3; $i <= 10; $i++): ?>
                                    <option value="<?= $i ?>" <?= $game["scoregoal"] == $i ? "selected" : ""; ?>><?= $i ?> Points</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                        <form id="password-form" class="form-group">
                            <label for="password-input">Password for joining</label>
                            <div class="input-group">
                                <input type="password" class="form-control bg-dark text-light" maxlength="32" id="password-input" placeholder="hidden">
                                <div class="input-group-append">
                                    <button class="btn btn-light" type="submit">Save</button>
                                </div>
                            </div>
                            <small class="form-text text-muted">Leave empty to not require a password.</small>
                        </form>
                    </div>

                    <!--<div class="col-12 col-md-6 col-lg-4">
                        <p class="d-none d-md-block">&nbsp;</p>
                        <div class="custom-control custom-checkbox mt-2 text-md-center">
                            <input type="checkbox" class="custom-control-input" id="spectatorsenabled-checkbox" <?= $game["spectatorsenabled"] == 1 ? "checked" : ""; ?>>
                            <label class="custom-control-label" for="spectatorsenabled-checkbox">Allow spectating</label>
                        </div>
                    </div>-->

                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                        <div class="form-group">
                            <label for="blankcount-input">Blank cards</label>
                            <select class="form-control bg-dark text-light" id="blankcount-input">
                                <?php for ($i = 0; $i <= 50; $i+=5): ?>
                                    <option value="<?= $i ?>" <?= $game["blankcount"] == $i ? "selected" : ""; ?>><?= $i ?> blank cards</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                        <div class="form-group">
                            <label for="cardHandCount-input">Cards per Hand</label>
                            <select class="form-control bg-dark text-light" id="cardHandCount-input">
                                <?php for ($i = 4; $i <= 10; $i++): ?>
                                    <option value="<?= $i ?>" <?= $game["cardHandCount"] == $i ? "selected" : ""; ?>><?= $i ?> white cards per hand</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                        <div class="form-group">
                            <label for="allowedDumps-input">Hand dumps per player</label>
                            <select class="form-control bg-dark text-light" id="allowedDumps-input">
                                <option value="0" <?= $game["allowedDumps"] == 0 ? "selected" : ""; ?>>Forbid dumping hand</option>
                                <option value="1" <?= $game["allowedDumps"] == 1 ? "selected" : ""; ?>>Allow dumping hand once</option>
                                <?php for ($i = 2; $i <= 8; $i++): ?>
                                    <option value="<?= $i ?>" <?= $game["allowedDumps"] == $i ? "selected" : ""; ?>>Allow dumping hand <?= $i ?> times</option>
                                <?php endfor; ?>
                                <option value="100" <?= $game["allowedDumps"] == 100 ? "selected" : ""; ?>>Allow dumping hand 100 times (always)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="border-primary" />

                <h3 class="mb-0">Enabled card packs</h3>
                <p class="text-muted mb-2">
                    Changes will be saved automagically.
                </p>
                <div id="cardpacks-list">
                    <?php
                    $bCount = 0;
                    $wCount = 0;
                    foreach ($cardpacks as $cp):
                        if (in_array($cp["id"], json_decode($game["enabledpacks"], true))) {
                            $bCount += $cp["blackCardCount"];
                            $wCount += $cp["whiteCardCount"];
                        }
                    ?>
                    <div class="custom-control custom-checkbox"  title="">
                        <input type="checkbox" class="custom-control-input" id="cardpack-<?= $cp["id"] ?>" data-cardpackid="<?= $cp["id"] ?>" data-blackcardcount="<?= $cp["blackCardCount"] ?>" data-whitecardcount="<?= $cp["whiteCardCount"] ?>" <?= in_array($cp["id"], json_decode($game["enabledpacks"], true)) ? "checked" : "" ?>>
                        <label class="custom-control-label" for="cardpack-<?= $cp["id"] ?>">
                            <?= $cp["name"] ?>
                            <small class="text-muted"><?= $cp["blackCardCount"] ?>b | <?= $cp["whiteCardCount"] ?>w</small>
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>
                <p class="text-muted mt-2">
                    Currently, there are <span id="cardpacks-count"><?= $bCount ?> black and <?= $wCount ?> white cards</span> selected.
                    The minimum required are 80 black and 200 white cards.
                </p>

                <hr class="border-primary" />

                <h3>Joined Players</h3>
                <div class="lobby-player-list row" id="player-list">
                    <div class="lobby-player col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="center">Loading...</div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-lg btn-primary btn-block" id="start-button">Start the game!</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="leave-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-secondary text-light">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Delete the game</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the game?
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-dark" data-dismiss="modal">Go back</button>
                    <button class="btn btn-primary" id="leave-submit">Delete game</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="starterror-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-secondary text-light">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Can't start the game</h5>
                </div>
                <div class="modal-body">
                    <p id="starterror-text"></p>
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-primary" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section("footer") ?>
    <script>
        requireLogin = true;

        let config = {
            "name": "<?= esc($game["name"], 'js'); ?>",
            "playermax": <?= $game["playermax"] ?>,
            "timeout": <?= $game["timeout"] ?>,
            "scoregoal": <?= $game["scoregoal"] ?>,
            "blankcount": <?= $game["blankcount"] ?>,
            "enabledpacks": <?= $game["enabledpacks"] ?>,
            "allowedDumps": <?= $game["allowedDumps"] ?>,
            "cardHandCount": <?= $game["cardHandCount"] ?>,
            "password": "",
            "passwordChanged": 0,
        };

        let players = [];

        statusQueryData = {
            action: "gamemanage",
            token: "<?= $token ?>",
            cacheHash: "",
            config: "{}"
        };



        statusQueryCallback = function(data) {
            if (data.players !== "valid") {
                players = data.players;
                $("#player-list").html("");
                for (let playerKey in data.players) {
                    let player = data.players[playerKey];
                    $playerCol = $("<div class='col-12 col-sm-6 col-md-4 col-lg-3'></div>");
                    $playerBox = $("<div class='lobby-player w-100'></div>");
                    $playerBox.append("<div class='center'>" + player.username + "<span class='text-muted'>#" + player.usertag + "</span></div>");
                    $playerCol.append($playerBox);
                    $("#player-list").append($playerCol);
                }
                statusQueryData.cacheHash = data.cacheHash;
            }

            statusQueryData.config = "{}";
        };

        $("#leave-submit").click(function () {
            $.post({
                url: baseurl + "/GameAPI/leaveGame",
                data: {
                    token: statusQueryData.token
                }
            }).done(function () {
                window.location = baseurl;
            });
        });

        $("#name-form").submit(function (event) {
            event.preventDefault();
            config.name = $("#name-input").val();
            statusQueryData.config = JSON.stringify(config);
        });

        $("#password-form").submit(function (event) {
            event.preventDefault();
            config.password = $("#password-input").val();
            config.passwordChanged = 1;
            statusQueryData.config = JSON.stringify(config);
        });

        $("#maxplayer-input").change(function () {
            config.playermax = Number.parseInt($("#maxplayer-input").val());
            statusQueryData.config = JSON.stringify(config);
        });

        $("#timeout-input").change(function () {
            config.timeout = Number.parseInt($("#timeout-input").val());
            statusQueryData.config = JSON.stringify(config);
        });

        $("#scoregoal-input").change(function () {
            config.scoregoal = Number.parseInt($("#scoregoal-input").val());
            statusQueryData.config = JSON.stringify(config);
        });

        $("#blankcount-input").change(function () {
            config.blankcount = Number.parseInt($("#blankcount-input").val());
            statusQueryData.config = JSON.stringify(config);
        });

        $("#cardHandCount-input").change(function () {
            config.cardHandCount = Number.parseInt($("#cardHandCount-input").val());
            statusQueryData.config = JSON.stringify(config);
        });

        $("#allowedDumps-input").change(function () {
            config.allowedDumps = Number.parseInt($("#allowedDumps-input").val());
            statusQueryData.config = JSON.stringify(config);
        });

        $("#spectatorsenabled-checkbox").change(function () {
            config.spectatorsenabled = $("#spectatorsenabled-checkbox").prop("checked") ? 1 : 0;
            statusQueryData.config = JSON.stringify(config);
        });

        $("#cardpacks-list input[type=checkbox]").change(function () {
            config.enabledpacks = [];
            bCount = 0;
            wCount = 0;

            $("#cardpacks-list input[type=checkbox]:checked").each(function () {
                config.enabledpacks.push(Number.parseInt($(this).data("cardpackid")));
                bCount += Number.parseInt($(this).data("blackcardcount"));
                wCount += Number.parseInt($(this).data("whitecardcount"));
            });

            $("#cardpacks-count").text("" + bCount + " black and " + wCount + " white cards");
            statusQueryData.config = JSON.stringify(config);
        });

        $("#start-button").click(function () {
            bCount = 0;
            wCount = 0;

            $("#cardpacks-list input[type=checkbox]:checked").each(function () {
                bCount += Number.parseInt($(this).data("blackcardcount"));
                wCount += Number.parseInt($(this).data("whitecardcount"));
            });

            if (players.length < 3) {
                $("#starterror-text").text("At least three players are required to start a game.");
                $("#starterror-modal").modal("show");

            } else if (bCount < 80 || wCount < 200) {
                $("#starterror-text").text("At least 80 black and 200 white cards have to be selected to start a game. Add card packs to reach this limit.");
                $("#starterror-modal").modal("show");

            } else {
                $("#loader").fadeIn(150);
                $.post({
                    url: baseurl + "/GameAPI/startGame",
                    data: {
                        token: statusQueryData.token,
                    }
                }).done(function (data) {
                    if (typeof data.status == "undefined") {
                        data = JSON.parse(data);
                    }

                    if (data.status == "error") {
                        alert("Couldn't start the game: " + data.message);
                    } else {
                        window.location = baseurl + "/game/play/" + statusQueryData.token;
                    }
                });
            }
        });

        // Polyfill for FF behaviour where select menus remember their values upon reload
        window.onunload += function() {
            $('select option').remove();
        };
    </script>
<?= $this->endSection() ?>