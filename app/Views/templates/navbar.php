<nav class="navbar navbar-expand-md navbar-dark bg-gradient-primary fixed-top">
    <a class="navbar-brand" href="#">CahClone</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item my-0">
                <span class="navbar-text mx-2">
                    Playing as <span class="text-light"><?= getUserSession()["username"] ?></span>#<?= getUserSession()["usertag"] ?>
                </span>
                <button class="btn btn-dark my-0" data-toggle="modal" data-target="#logout-modal">Logout</button>
            </li>
        </ul>
    </div>
</nav>

<div class="mt-2 mb-2">
    <br/><br/>
</div>

<!-- Logout modal -->
<div class="modal fade" id="logout-modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-secondary">
            <div class="modal-header border-0">
                <h5 class="modal-title">Log out</h5>
            </div>
            <div class="modal-body">
                Are you sure you want to log out? Your score will be discarded.
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Go back</button>
                <button type="button" class="btn btn-primary" id="logout-button">Log out</button>
            </div>
        </div>
    </div>
</div>