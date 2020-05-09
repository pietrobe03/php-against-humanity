<?= $this->extend('templates/full') ?>

<?= $this->section('content') ?>

    <?= $this->include('templates/navbar') ?>

    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-9">
                <h2>Home</h2>
                <p class="mb-0">These are the games currently available:</p>
            </div>
            <div class="col-3 text-right">
                <button class="btn btn-primary" data-toggle="modal" data-target="#create-modal">Create</button>
            </div>
            <div class="col-12 mt-4">
                <div class="table-responsive">
                    <table class="table table-hover table-dark rounded">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Owner</th>
                                <th>Players</th>
                                <th>Information</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="game-list">
                            <tr>
                                <td colspan="5">Loading games...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="create-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form class="modal-content bg-secondary text-light" id="create-form" action="javascript:void(0);" method="post">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Create new game</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name-input">Name of the new game</label>
                        <input type="text" id="name-input" class="form-control bg-dark text-light" required minlength="3" maxlength="32">
                        <small class="form-text text-muted">The name has to be between 3 and 32 characters long.</small>
                    </div>

                    <div class="custom-control custom-checkbox mt-2">
                        <input type="checkbox" class="custom-control-input" id="password-checkbox">
                        <label class="custom-control-label" for="password-checkbox">Require password to play in this game</label>
                    </div>

                    <div class="form-group mt-2" style="display: none;" id="password-fgroup">
                        <label for="password-input">Password</label>
                        <input type="password" id="password-input" class="form-control bg-dark text-light">
                        <small class="form-text text-muted">This password is only required to play this game, not to spectate it.</small>
                    </div>

                    <div class="form-group mt-4">
                        <label for="playermax-input">Player limit</label>
                        <input type="number" id="playermax-input" class="form-control bg-dark text-light" min="3" value="5" max="8" required>
                        <small class="form-text text-muted">A game can be played with at least 3 and no more than 8 players.</small>
                    </div>

                    <!--<div class="custom-control custom-checkbox mt-4">
                        <input type="checkbox" class="custom-control-input" id="spectatorsenabled-checkbox" checked>
                        <label class="custom-control-label" for="spectatorsenabled-checkbox">Allow spectating</label>
                    </div>-->

                    <small class="mt-2 d-block" id="errorblock" style="font-weight: bold; color: #ff5c59;"></small>
                </div>
                <div class="modal-footer border-0">
                    <button type="reset" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="create-submit">Create</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="password-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form class="modal-content bg-secondary text-light" id="password-form" action="javascript:void(0);" method="post">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Enter password</h5>
                </div>
                <div class="modal-body">
                    <input id="password-token" type="hidden" />

                    <div class="form-group mt-2">
                        <label for="password-password">A password is required to join the game &quot;<span id="password-name"></span>&quot;.</label>
                        <input type="password" id="password-password" class="form-control bg-dark text-light">
                        <small class="form-text text-muted"></small>
                    </div>

                    <small class="mt-2 d-block" id="password-error" style="font-weight: bold; color: #ff5c59;"></small>
                </div>
                <div class="modal-footer border-0">
                    <button type="reset" class="btn btn-dark" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="password-submit">Join</button>
                </div>
            </form>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section("footer") ?>
    <script>
        requireLogin = true;
        statusQueryData = {
            action: "gamelist",
            cacheHash: ""
        };

        statusQueryCallback = function(data) {
            if (data.games !== "valid") {
                $("#game-list").html("");
                if (data.games.length == 0) {
                    $("#game-list").append("<tr><td colspan=\"5\">There are no games at the moment.</td></tr>");
                } else {
                    for (let gameKey in data.games) {
                        game = data.games[gameKey];
                        $gameRow = $("<tr></tr>");
                        $gameRow.append("<td>" + game.name + "</td>");
                        $gameRow.append("<td>" + game.owner.username + "<span class=\"text-muted\">#" + game.owner.usertag + "</span></td>");

                        countstr = game.playercount + " of " + game.playermax + " players";
                        /*if (game.tags.includes("spectate")) {
                            countstr += ", <span class=\"text-nowrap\">" + game.spectatorcount + " spectators</span>";
                        }*/
                        $gameRow.append("<td>" + countstr + "</td>");

                        tagstr = "";
                        if (game.tags.includes("passworded")) {
                            tagstr += "<div class=\"badge badge-danger\">Passworded</div> ";
                        }
                        if (game.tags.includes("waiting")) {
                            tagstr += "<div class=\"badge badge-primary\">Waiting for players</div> ";
                        }
                        if (game.tags.includes("running")) {
                            tagstr += "<div class=\"badge badge-primary\">Running</div> ";
                        }
                        if (game.tags.includes("finished")) {
                            tagstr += "<div class=\"badge badge-primary\">Finished</div> ";
                        }
                        if (game.tags.includes("full")) {
                            tagstr += "<div class=\"badge badge-danger\">Round full</div> ";
                        }
                        /*if (game.tags.includes("spectate")) {
                            tagstr += "<div class=\"badge badge-dark\">Spectators allowed</div> ";
                        }*/
                        $gameRow.append("<td>" + tagstr + "</td>");

                        $td = $("<td class='text-nowrap'></td>");
                        if (!game.tags.includes("full")) {
                            $button = $("<button class=\"btn btn-sm btn-primary mr-1\">Join</button>");
                            $button.data("gametoken", game.token);
                            $button.click(function () {
                                if (game.tags.includes("passworded")) {
                                    $("#password-name").html(game.name);
                                    $("#password-token").val(game.token);
                                    $("#password-modal").modal("show");
                                } else {
                                    joinGame(game.token);
                                }
                            });
                            $td.append($button);
                        }

                        if (game.tags.includes("spectate")) {
                            $button = $("<button class=\"btn btn-sm btn-dark\">Spectate</button>");
                            $button.data("gametoken", game.token);
                            $button.click(function () {
                                alert(game.token);
                            });
                            $td.append($button);
                        }
                        $gameRow.append($td);


                        $("#game-list").append($gameRow);
                    }
                }

                statusQueryData.cacheHash = data.cacheHash;
            }
        };

        $("#password-checkbox").change(function (e) {
            if (e.target.checked) {
                $("#password-fgroup").slideDown();
                $("#password-input").prop("required", true);
            } else {
                $("#password-fgroup").slideUp();
                $("#password-input").prop("required", false);
            }
        });

        $("#create-form").submit(function (e) {
            e.preventDefault();
            $("#loader").fadeIn(100);
            $("#create-submit").attr("disabled", true);
            $.post({
                url: baseurl + "/GameAPI/createGame",
                data: {
                    name: $("#name-input").val(),
                    password: $("#password-checkbox").prop("checked") ? $("#password-input").val() : "",
                    spectatorsenabled: 0, //$("#spectatorsenabled-checkbox").prop("checked") ? 1 : 0,
                    playermax: $("#playermax-input").val(),
                }
            }).done(function (data) {
                if (typeof data.status == "undefined") {
                    data = JSON.parse(data);
                }

                if (data.status == "success") {
                    window.location = baseurl + "/game/manage/" + data.token;
                } else {
                    $("#loader").fadeOut(100);
                    $("#errorblock").text(data.message);
                    setTimeout(function () {
                        $("#errorblock").text("");
                        $("#create-submit").attr("disabled", false);
                    }, 3000);
                }
            });
        });

        $("#password-form").submit(function (e) {
            e.preventDefault();

            joinGame(
                $("#password-token").val(),
                false,
                $("#password-password").val(),
            );
        });

        function joinGame(token, spectate = false, password = "") {
            $("#loader").fadeIn(300);
            $.post({
                url: baseurl + "/GameAPI/joingame",
                data: {
                    token: token,
                    spectate: spectate ? 1 : 0,
                    password: password,
                },
            }).done(function (data) {
                if (typeof data.status == "undefined") {
                    data = JSON.parse(data);
                }

                if (data.status == "success") {
                    window.location = baseurl + "/game/lobby/" + token;
                } else {
                    $("#loader").fadeOut(100);
                    $("#password-error").text(data.message);
                    setTimeout(function () {
                        $("#password-error").text("");
                        $("#password-submit").attr("disabled", false);
                    }, 3000);
                }
            });
        }
    </script>
<?= $this->endSection() ?>