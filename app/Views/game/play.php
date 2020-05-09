<?= $this->extend('templates/full') ?>

<?= $this->section('content', ["body_classes" => "d-flex flex-column game-body"]) ?>

<?= $this->include('templates/navbar') ?>

    <div class="d-flex flex-column flex-grow-1 mx-3 mb-3">
        <div class="d-flex mt-2 mb-2">
            <div class="flex-grow-1">
                <h2 class="d-inline">Game "<?= $name ?>"</h2>
                <p class="d-inline"> by <?= $owner["username"] ?><span class="text-muted">#<?= $owner["usertag"] ?></span></p>
            </div>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#leave-modal">Leave game</button>
            </div>
        </div>

        <div class="game-wrapper flex-grow-1">
            <div class="players" id="player-list">
                <div class="play-player w-100">Loading...</div>
            </div>
            <div class="game">
                <div class="judge-wait-wrapper game-partial">
                    <h2>You're the judge</h2>
                    <p>
                        Please wait for the players to pick cards!
                    </p>
                </div>
                <div class="picking-wait-wrapper game-partial">
                    <h2>Your selection was handed in.</h2>
                    <p>
                        Please wait for the other players to pick cards!
                    </p>
                </div>
                <div class="finish-wrapper game-partial">
                    <h2>The game is over!</h2>
                    <p>
                        <span id="finish-winner">A player</span> has reached the score goal.
                        <div class="players finish-wrapper-players">

                        </div>
                    </p>
                </div>
                <div class="judging-wait-wrapper game-partial">
                    <h2>It's the judge's turn now.</h2>
                    <p>
                        Please wait for the judge to pick a winner!
                    </p>
                </div>
                <div class="picking-wrapper game-partial">
                    <h2>Please pick an answer!</h2>
                </div>
                <div class="judging-wrapper game-partial">
                    <h2>Please pick a winner!</h2>
                </div>
                <div class="results-wrapper game-partial">
                    <h2>The judge has spoken!</h2>
                </div>
                <div class="black-card-wrapper game-partial">
                    <div class="black-card-flex">
                        <div class="black-card" id="black-card">
                            Loading...
                        </div>
                    </div>
                </div>
                <div class="white-card-wrapper game-partial">
                    <div class="white-card-flex" id="white-card-list">
                        <!-- White cards appear here -->
                    </div>
                    <div class="custom-control custom-checkbox mt-2 text-md-center" style="display: none" id="dumpcards-wrapper">
                        <input type="checkbox" class="custom-control-input" id="dumpcards-checkbox">
                        <label class="custom-control-label" for="dumpcards-checkbox">Dump all cards on hand (<span id="dumpcards-left">1</span> dump(s) left)</label>
                    </div>
                </div>
                <div class="judge-pick-wrapper game-partial">
                    <div class="white-card-selection-flex" id="white-card-selection-list">
                        <!-- White card selections appear here -->
                    </div>
                </div>
                <div class="submit-buttons-wrapper game-partial bg-secondary">
                    <div class="btn-group">
                        <button class="btn btn-dark w-50" id="reset-white-card-selection">
                            Reset selection
                        </button>
                        <button class="btn btn-primary w-50" id="submit-white-card-selection">
                            Confirm selection
                        </button>
                    </div>
                </div>
            </div>
            <div class="mobile-ui-tabs">
                <div class="btn-group w-100">
                    <button class="btn btn-primary w-50" id="cards-tab-button">Cards</button>
                    <button class="btn btn-dark w-50" id="players-tab-button">Players</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="leave-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-secondary text-light">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Leave the game</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to leave the game?
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-dark" data-dismiss="modal">Go back</button>
                    <button class="btn btn-primary" id="leave-submit">Leave</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="blank-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-secondary text-light">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Blank card</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group mt-2">
                        <label for="password-password">What should be written on the card?</label>
                        <input type="text" id="blank-content" class="form-control bg-dark text-light">
                        <small class="form-text text-muted">A good blank text starts with an UPPERCASE letter and end with a dot.</small>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-dark" id="blank-cancel">Cancel</button>
                    <button class="btn btn-primary" id="blank-submit">Use blank card</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" id="error-modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content bg-secondary text-light">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Game error</h5>
                </div>
                <div class="modal-body">
                    <p id="error-text"></p>
                </div>
                <div class="modal-footer border-0">
                    <a class="btn btn-primary" href="<?= base_url("/") ?>">Leave game</a>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section("footer") ?>
    <script>
        requireLogin = true;
        statusQueryData = {
            action: "gameplay",
            token: "<?= $token ?>",
            cacheHash: ""
        };

        whiteCardSelection = [];
        winnerSelection = -1;

        blackCard = {
            text: "Black card text here ___.",
            blanks: 2,
        };
        phase = "loading";
        players = [];

        blankContent = [];
        tempBlank = null;

        statusQueryCallback = function(data) {
            if (data.status == "game_missing") {
                $("#error-text").text("Sorry, this game no longer exists. Probably the owner left it or disconnected completely.");
                $("#error-modal").modal("show");
            } else if (data.status == "session_missing") {
                $("#error-text").text("Sorry, you are not member of this game anymore. Probably the owner or the server kicked you.");
                $("#error-modal").modal("show");
            } else if (data.cacheHash !== "valid") {

                // Rebuild Player List
                $(".players").html("");
                players = data.players;
                for (let playerKey in players) {
                    let player = players[playerKey];
                    $playerBox = $("<div class='play-player w-100'></div>");
                    if (player.judge) {
                        $playerBox.append("<div><i class=\"fas fa-gavel\"></i> " + player.username + "<span class='text-muted'>#" + player.usertag + "</span></div>");

                    } else if (player.done) {
                        $playerBox.append("<div><i class=\"far fa-check-circle\"></i> " + player.username + "<span class='text-muted'>#" + player.usertag + "</span></div>");

                    } else {
                        $playerBox.append("<div><i class=\"far fa-circle\"></i> " + player.username + "<span class='text-muted'>#" + player.usertag + "</span></div>");

                    }
                    $playerBox.append("<div class='text-primary'>" + player.score + "</div>");
                    $(".players").append($playerBox);
                }

                $(".game-partial.active").removeClass("active");

                if (data.blackCard) {
                    blackCard = data.blackCard;
                }

                phase = data.phase;
                switch (data.phase) {
                    case "picking":
                        $(".picking-wrapper").addClass("active");
                        $(".black-card-wrapper").addClass("active");
                        $(".white-card-wrapper").addClass("active");

                        $("#dumpcards-wrapper").css("display", data.dumpsLeft <= 0 ? "none" : "block");
                        $("#dumpcards-left").text(data.dumpsLeft);

                        $("#black-card").html(blackCard.text);

                        $(".white-card-template").remove();
                        for (let i = 0; i < blackCard.blanks; i++) {
                            $("#black-card").after("<div class='white-card-template'></div>");
                        }

                        $("#white-card-list").html("");
                        for (let cardHandKey in data.cardHand) {
                            card = data.cardHand[cardHandKey];
                            $card = $("<div class='white-card' tabindex='-1'>" + card.content + "</div>");
                            $card.data("id", card.id);

                            if (card.blank) {
                                $card.click(function () {
                                    if (!$(this).hasClass("active")) {
                                        if (whiteCardSelection.length < blackCard.blanks) {
                                            tempBlank = this;
                                            $(this).addClass("active");
                                            $("#blank-modal").modal("show");
                                        }
                                    }
                                });
                            } else {
                                $card.click(function () {
                                    if (!$(this).hasClass("active") && whiteCardSelection.indexOf($(this).data("id")) == -1) {
                                        if (whiteCardSelection.length < blackCard.blanks) {
                                            $(this).addClass("active");
                                            $template = $($(".white-card-template:not(.white-card)").first());
                                            $template.addClass("white-card");
                                            $template.text($(this).text());
                                            whiteCardSelection.push($(this).data("id"));
                                            $("#submit-white-card-selection").attr("disabled", (whiteCardSelection.length < blackCard.blanks));
                                            $(".submit-buttons-wrapper").fadeIn(160);
                                        }
                                    }
                                });
                            }

                            $("#white-card-list").append($card);
                        }

                        if (whiteCardSelection.length > 0) {
                            for (let i = 0; i < whiteCardSelection.length; i++) {
                                $("#white-card-list .white-card").each(function () {
                                    if ($(this).data("id") === whiteCardSelection[i]) {
                                        $template = $($(".white-card-template:not(.white-card)").first());
                                        $template.text($(this).text());
                                        $template.addClass("white-card");
                                        $(this).addClass("active");
                                        $("#submit-white-card-selection").attr("disabled", (whiteCardSelection.length < blackCard.blanks));
                                        $(".submit-buttons-wrapper").fadeIn(160);
                                    }
                                });
                            }
                        }
                        break;

                    case "judge_wait":
                        $(".black-card-wrapper").addClass("active");
                        $(".judge-wait-wrapper").addClass("active");
                        $(".white-card-template").remove();
                        for (let i = 0; i < blackCard.blanks; i++) {
                            $("#black-card").after("<div class='white-card-template'></div>");
                        }
                        $("#black-card").html(blackCard.text);
                        break;

                    case "wait_picking":
                        $(".black-card-wrapper").addClass("active");
                        $(".picking-wait-wrapper").addClass("active");
                        $(".white-card-template").remove();
                        for (let i = 0; i < blackCard.blanks; i++) {
                            $("#black-card").after("<div class='white-card-template'></div>");
                        }
                        $("#black-card").html(blackCard.text);

                        break;

                    case "judging":
                        $(".black-card-wrapper").addClass("active");
                        $(".judge-pick-wrapper").addClass("active");
                        $(".judging-wrapper").addClass("active");
                        $(".white-card-template").remove();
                        for (let i = 0; i < blackCard.blanks; i++) {
                            $("#black-card").after("<div class='white-card-template'></div>");
                        }
                        $("#black-card").html(blackCard.text);

                        $("#white-card-selection-list").html("");
                        for (let i = 0; i < data.whiteCardSelections.length; i++) {
                            wcs = data.whiteCardSelections[i];
                            $selWrapper = $('<div class="white-card-selection"></div>');
                            for (let j = 0; j < wcs.cards.length; j++) {
                                $card = $('<div class="white-card"></div>');
                                $card.html(wcs.cards[j]);
                                $selWrapper.append($card);
                            }
                            $selWrapper.data("id", wcs.id);
                            $selWrapper.click(function () {
                                $(".submit-buttons-wrapper").fadeIn(150);
                                $(".white-card-selection.active").removeClass("active");
                                $(this).addClass("active");
                                winnerSelection = $(this).data("id");
                            });
                            $("#white-card-selection-list").append($selWrapper);
                        }
                        break;

                    case "wait_judging":
                        $(".black-card-wrapper").addClass("active");
                        $(".judge-pick-wrapper").addClass("active");
                        $(".judging-wait-wrapper").addClass("active");
                        $(".white-card-template").remove();
                        for (let i = 0; i < blackCard.blanks; i++) {
                            $("#black-card").after("<div class='white-card-template'></div>");
                        }
                        $("#black-card").html(blackCard.text);

                        $("#white-card-selection-list").html("");
                        for (let i = 0; i < data.whiteCardSelections.length; i++) {
                            wcs = data.whiteCardSelections[i];
                            $selWrapper = $('<div class="white-card-selection disabled"></div>');
                            for (let j = 0; j < wcs.cards.length; j++) {
                                $card = $('<div class="white-card"></div>');
                                $card.html(wcs.cards[j]);
                                $selWrapper.append($card);
                            }
                            $("#white-card-selection-list").append($selWrapper);
                        }
                        break;

                    case "result":
                        $(".black-card-wrapper").addClass("active");
                        $(".judge-pick-wrapper").addClass("active");
                        $(".results-wrapper").addClass("active");
                        $(".white-card-template").remove();
                        for (let i = 0; i < blackCard.blanks; i++) {
                            $("#black-card").after("<div class='white-card-template'></div>");
                        }
                        $("#black-card").html(blackCard.text);

                        $("#white-card-selection-list").html("");
                        for (let i = 0; i < data.whiteCardSelections.length; i++) {
                            wcs = data.whiteCardSelections[i];
                            $selWrapper = $('<div class="white-card-selection disabled"></div>');
                            if (wcs.winner) {
                                $selWrapper.addClass("active");
                            }
                            for (let j = 0; j < wcs.cards.length; j++) {
                                $card = $('<div class="white-card"></div>');
                                $card.html(wcs.cards[j]);
                                $selWrapper.append($card);
                            }
                            $("#white-card-selection-list").append($selWrapper);
                        }
                        break;

                    case "finished":
                        $(".finish-wrapper").addClass("active");
                        highscore = 0;
                        for (i = 0; i < players.length; i++) {
                            if (players[i].score > players[highscore].score) {
                                highscore = i;
                            }
                        }
                        $(".finish-winner").html(players[highscore].username + "<span class='text-muted'>#" + players[highscore].usertag + "</span>");
                        statusQueryCallback = function () {return true;};
                        statusQueryData.action = "gameindex";
                        break;
                }

                statusQueryData.cacheHash = data.cacheHash;
            }
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

        $("#blank-cancel").click(function () {
            $(tempBlank).removeClass("active");
            $("#blank-modal").modal("hide");
        });

        $("#blank-submit").click(function () {
            blankText = $("#blank-content").val();
            if (blankText.trim().length < 2) {
                alert("Please enter something to put onto your blank card.");

            } else {
                $template = $($(".white-card-template:not(.white-card)").first());
                $template.addClass("white-card");
                $template.text(blankText);
                whiteCardSelection.push(-1);
                blankContent.push(blankText);
                $("#blank-content").val("");
                $("#blank-modal").modal("hide");
                $("#submit-white-card-selection").attr("disabled", (whiteCardSelection.length < blackCard.blanks));
                $(".submit-buttons-wrapper").fadeIn(160);
            }
        });

        $("#players-tab-button").click(function () {
            $(".game-wrapper .game").slideUp(300);
            $(".game-wrapper .players").slideDown(300);
            $("#cards-tab-button").addClass("btn-dark").removeClass("btn-primary");
            $("#players-tab-button").addClass("btn-primary").removeClass("btn-dark");
        });

        $("#cards-tab-button").click(function () {
            $(".game-wrapper .game").slideDown(300);
            $(".game-wrapper .players").slideUp(300);
            $("#players-tab-button").addClass("btn-dark").removeClass("btn-primary");
            $("#cards-tab-button").addClass("btn-primary").removeClass("btn-dark");
        });

        $("#reset-white-card-selection").click(function () {
            switch (phase) {
                case "picking":
                    $(".white-card-template").remove();
                    for (let i = 0; i < blackCard.blanks; i++) {
                        $("#black-card").after("<div class='white-card-template'></div>");
                    }
                    $(".white-card.active").removeClass("active");
                    whiteCardSelection = [];
                    blankContent = [];
                    $(".submit-buttons-wrapper").fadeOut(150);
                    break;

                case "judging":
                    $(".white-card-selection.active").removeClass("active");
                    $(".submit-buttons-wrapper").fadeOut(150);
                    winnerSelection = -1;
                    break;
            }
        });

        $("#submit-white-card-selection").click(function () {
            switch (phase) {
                case "picking":
                    $("#loader").fadeIn(300);
                    $.post({
                        url: baseurl + "/GameAPI/pickCards",
                        data: {
                            token: statusQueryData.token,
                            cardSelection: JSON.stringify(whiteCardSelection),
                            blankContent: JSON.stringify(blankContent),
                            dumpCards: $("#dumpcards-checkbox").prop("checked") ? 1 : 0,
                        }
                    }).done(function () {
                        $("#dumpcards-checkbox").prop("checked", false);
                        $(".submit-buttons-wrapper").fadeOut(150);
                        $("#loader").fadeOut(300);
                        whiteCardSelection = [];
                        blankContent = [];
                    });
                    break;

                case "judging":
                    $("#loader").fadeIn(300);
                    $.post({
                        url: baseurl + "/GameAPI/pickWinner",
                        data: {
                            token: statusQueryData.token,
                            winnerSelection: winnerSelection,
                        }
                    }).done(function () {
                        $(".submit-buttons-wrapper").fadeOut(150);
                        $("#loader").fadeOut(300);
                        winnerSelection = -1;
                    });
                    break;
            }
        });
    </script>
<?= $this->endSection() ?>