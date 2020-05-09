<?= $this->extend('templates/full') ?>

<?= $this->section('content') ?>

<?= $this->include('templates/navbar') ?>

    <div class="container-fluid d-flex flex-column">
        <div class="d-flex m-2">
            <div class="flex-grow-1">
                <h2 class="d-inline">Game "<?= $name ?>"</h2>
                <p class="d-inline text-nowrap"> by <?= $owner["username"] ?><span class="text-muted">#<?= $owner["usertag"] ?></span></p>
            </div>
            <div>
                <button class="btn btn-primary" data-toggle="modal" data-target="#leave-modal">Leave game</button>
            </div>
        </div>


        <div class="m-2">
            <p>These players joined this game:</p>
            <div class="lobby-player-list row" id="player-list">
                <div class="lobby-player col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="center">Loading...</div>
                </div>
            </div>
        </div>

        <hr class="border-primary w-100" />

        <div class="mt-2 text-center">
            <h2>Please wait for the game to start!</h2>
        </div>

        <div>
            <!-- Collapse here -->
            <div id="containthecat" style="">
                <div class="row" id="catheader" style="height:120px;">
                    <div class="col-md-12"></div>
                </div>
                <div class="row" style=height:200px;>
                    <div class="col-7" style="padding:0;margin:0">
                        <div class="slideshow">
                            <div class="rainbows">
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-1'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                                <div class='rainbow frame-2'><div class='wave wave-1'></div><div class='wave wave-2'></div><div class='wave wave-3'></div><div class='wave wave-4'></div><div class='wave wave-5'></div><div class='wave wave-6'></div><div class='wave wave-7'></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2" style="padding:0;margin:0">
                        <div id='cat' class='nyan-cat'>
                            <img src="<?= base_url() ?>/cats/original.gif">
                        </div>
                    </div>
                    <div class="col-3" style="padding:0;margin:0">
                    </div>

                </div>
                <div class="row" id="cattrailer" style="height:80px;">
                    <div class="col-md-12"></div>
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

    <div class="modal modal-lg fade" tabindex="-1" role="dialog" data-backdrop="static" id="error-modal">
        <div class="modal-dialog  modal-dialog-centered" role="document">
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
            action: "gamelobby",
            token: "<?= $token ?>",
            cacheHash: ""
        };

        statusQueryCallback = function(data) {
            if (data.status == "game_missing") {
                $("#error-text").text("Sorry, this game no longer exists. Probably the owner left it or disconnected completely.");
                $("#error-modal").modal("show");
            } else if (data.status == "session_missing") {
                $("#error-text").text("Sorry, you are not member of this game anymore. Probably the owner or the server kicked you.");
                $("#error-modal").modal("show");
            } else if (data.status == "game_started") {
                window.location = baseurl + "/game/play/<?= $token ?>";
            } else if (data.players !== "valid") {
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
    </script>

<!-- NyanScript -->
<style>
    #containthecat {
        min-height: 400px;
        height: calc(100vh - 480px);
        overflow: hidden;
        padding: 0;
        margin: 32px -32px;
        width: 100%;
        position: relative;
    }

    .row{
        padding: 0;
        margin: 0;
    }

    .nyan-cat {
        position: absolute;
        left: -180px;
        animation: catani 1.7s infinite;
        z-index: 3;
    }
    @keyframes catani {
        0% {
            left: -180px;
        }

        50% {
            left: -160px;
        }

        100% {
            left: -180px;
        }
    }

    .slideshow {
        position: relative;
        height: 200px;
        width: 98%;
        overflow: hidden;
        opacity: .9;
        z-index:2;
    }

    .rainbows {
        /*background-image: linear-gradient(red,orange,yellow,green,blue,indigo);*/
        position: absolute;
        height:100%;
        left: 0;
        top: 0;
        animation: slideshow 8s linear infinite;
    }
    @keyframes slideshow {
        0% {
            left: 0;
        }

        100% {
            left: -600.5%;
        }
    }

    .rainbow {
        position: relative;
        font-size: 14px;
        padding: 0;
        margin-top: 24px;
        margin-bottom: 30px;
        float: left;
        overflow: hidden;
        border: 0;
    }

    .rainbow .wave {
        height: 1.25em;
        width: 3.5em;
    }

    .frame-1 {
        margin-top: 2em;
    }

    .frame-2 {
    }

    .rainbow .wave-1 {
        background: #ff0000;
    }
    .rainbow .wave-2 {
        background: #ff9900;
    }
    .rainbow .wave-3 {
        background: #ffff00;
    }
    .rainbow .wave-4 {
        background: #33ff00;
    }
    .rainbow .wave-5 {
        background: #0099ff;
    }
    .rainbow .wave-6 {
        background: #6633ff;
    }


    .star {
        font-size: 5px;
        position: absolute;
        z-index: 1;
    }

    .star .wrapper {
        position: absolute;
        height: 10px;
        width: 10px;
    }

    .star .dot {
        background: white;
        height: 1em;
        width: 1em;
        position: absolute;
        display: none;
        top: 50%;
        left: 50em;
        margin: 0;
        padding: 0;
    }


    .star.frame-1 .dot-1 {
        margin-top: 0em;
        margin-left: 0em;
        display: block;
    }
    .star.frame-2 .dot-2, .star.frame-3 .dot-2 {
        margin-top: 1em;
        margin-left: 0em;
        display: block;
    }
    .star.frame-2 .dot-3, .star.frame-3 .dot-3 {
        margin-top: -1em;
        margin-left: 0em;
        display: block;
    }
    .star.frame-2 .dot-4, .star.frame-3 .dot-4 {
        margin-top: 0em;
        margin-left: 1em;
        display: block;
    }
    .star.frame-2 .dot-5, .star.frame-3 .dot-5 {
        margin-top: 0em;
        margin-left: -1em;
        display: block;
    }

    .star.frame-3 .dot-6, .star.frame-4 .dot-6 {
        margin-top: 2em;
        margin-left: 0em;
        display: block;
    }
    .star.frame-3 .dot-7, .star.frame-4 .dot-7 {
        margin-top: -2em;
        margin-left: 0em;
        display: block;
    }
    .star.frame-3 .dot-8, .star.frame-4 .dot-8 {
        margin-top: 0em;
        margin-left: 2em;
        display: block;
    }
    .star.frame-3 .dot-9, .star.frame-4 .dot-9 {
        margin-top: 0em;
        margin-left: -2em;
        display: block;
    }

    .star.frame-4 .dot-1, .star.frame-5 .dot-1, .star.frame-6 .dot-1 {
        margin-top: 3em;
        margin-left: 0em;
        display: block;
    }
    .star.frame-4 .dot-2, .star.frame-5 .dot-2, .star.frame-6 .dot-2 {
        margin-top: -3em;
        margin-left: 0em;
        display: block;
    }
    .star.frame-4 .dot-3, .star.frame-5 .dot-3, .star.frame-6 .dot-3 {
        margin-top: 0em;
        margin-left: 3em;
        display: block;
    }
    .star.frame-4 .dot-4, .star.frame-5 .dot-4, .star.frame-6 .dot-4 {
        margin-top: 0em;
        margin-left: -3em;
        display: block;
    }

    .star.frame-5 .dot-5 {
        margin-top: 2em;
        margin-left: 2em;
        display: block;
    }

    .star.frame-5 .dot-6 {
        margin-top: 2em;
        margin-left: -2em;
        display: block;
    }

    .star.frame-5 .dot-7{
        margin-top: -2em;
        margin-left: 2em;
        display: block;
    }

    .star.frame-5 .dot-8{
        margin-top: -2em;
        margin-left: -2em;
        display: block;
    }
</style>
<script>

    // do all this at the start
    $(document).ready(function () {
        $('div.view2').hide();

        animateStarsTimer = setInterval(animateStars, 150);
        placeStarTimer = setInterval(placeStar, 60);
    });


    function animateStars() {

        $(".speed-1").each(function () {
            var l = $(this).offset();
            $(this).offset({ left: (l.left - 10) });
        });
        $(".speed-2").each(function () {
            var l = $(this).offset();
            $(this).offset({ left: (l.left - 20) });
        });
        $(".speed-3").each(function () {
            var l = $(this).offset();
            $(this).offset({ left: (l.left - 30) });
        });
        $(".speed-4").each(function () {
            var l = $(this).offset();
            $(this).offset({ left: (l.left - 40) });
        });

        $('.star').each(function () {
            thisFrame = $(this).attr('class');
            thisFrame = thisFrame.split(' ');
            thisFrame = thisFrame[1].split('-');
            thisFrame = parseInt(thisFrame[1]);
            secFrame = $(this).attr('class');
            secFrame = secFrame.split(' ');
            secFrame = secFrame[2].split('-');
            secFrame = parseInt(secFrame[1]);
            thiFrame = $(this).attr('class');
            thiFrame = thiFrame.split(' ');
            thiFrame = thiFrame[3].split('-');
            thiFrame = parseInt(thiFrame[1]);
            var test = $(this).offset();
            if (test.left < -50) {
                $(this).remove();
                starcount--;
            }
            if (thiFrame == 7) {
                var l = $(this).offset();
                $(this).removeClass("repeat-" + String(secFrame)).addClass("repeat-" + String(parseInt(secFrame) + 1));
                $(this).removeClass("frame-" + String(thiFrame)).addClass("frame-1");
            } else {
                $(this).removeClass("frame-" + String(thiFrame)).addClass("frame-" + String(parseInt(thiFrame) + 1));
            }
        })
    } //400
    function animateStars2() {

        $(".speed-1").each(function () {
            var l = $(this).offset();
            $(this).offset({ left: (l.left - 1) });
        });
        $(".speed-2").each(function () {
            var l = $(this).offset();
            $(this).offset({ left: (l.left - 2) });
        });
        $(".speed-3").each(function () {
            var l = $(this).offset();
            $(this).offset({ left: (l.left - 3) });
        });
        $(".speed-4").each(function () {
            var l = $(this).offset();
            $(this).offset({ left: (l.left - 4) });
        });

        $('.star').each(function () {
            thisFrame = $(this).attr('class');
            thisFrame = thisFrame.split(' ');
            thisFrame = thisFrame[1].split('-');
            thisFrame = parseInt(thisFrame[1]);
            secFrame = $(this).attr('class');
            secFrame = secFrame.split(' ');
            secFrame = secFrame[2].split('-');
            secFrame = parseInt(secFrame[1]);
            thiFrame = $(this).attr('class');
            thiFrame = thiFrame.split(' ');
            thiFrame = thiFrame[3].split('-');
            thiFrame = parseInt(thiFrame[1]);
            var test = $(this).offset();
            if (test.left < -50) {
                $(this).remove();
                starcount--;
            }
            if (thiFrame == 7) {
                var l = $(this).offset();
                $(this).removeClass("repeat-" + String(secFrame)).addClass("repeat-" + String(parseInt(secFrame) + 1));
                $(this).removeClass("frame-" + String(thiFrame)).addClass("frame-1");
            } else {
                $(this).removeClass("frame-" + String(thiFrame)).addClass("frame-" + String(parseInt(thiFrame) + 1));
            }
        })
    } //400
    var starcount = 0;
    function placeStar() {
        var rand = Math.floor(Math.random() * 4) + 1;
        var newStar = $("<div class='star speed-" + rand + " repeat-1 frame-1'> <div class='wrapper speed-"+rand+"'><div class='dot dot-1'></div><div class='dot dot-2'></div><div class='dot dot-3'></div><div class='dot dot-4'></div><div class='dot dot-5'></div><div class='dot dot-6'></div><div class='dot dot-7'></div><div class='dot dot-8'></div><div class='dot dot-9'></div></div></div > ");
        var minxframe = document.getElementById("containthecat").offsetLeft;
        var maxxframe = document.getElementById('containthecat').offsetWidth;
        var minyframe = document.getElementById("containthecat").offsetTop;
        var maxyframe = document.getElementById('containthecat').offsetHeight;

        newStar.css({ //1600
            top: Math.floor(Math.random() * (maxyframe-64)) + 32,
            left: Math.floor(Math.random() * (maxxframe-64))+ 32
        }); //1200
        if (starcount < 15) {
            $('#containthecat').append(newStar);
            starcount++;
        }

    } //100

</script>
<?= $this->endSection() ?>