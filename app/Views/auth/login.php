<?php
    $data = array(
        "title" => "Pick an username"
    );
    $title = "Pick a username";
?>

<?= $this->extend('templates/full', $data) ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <h2>Welcome to CahClone!</h2>
            <p class="mb-0">Please pick an username.</p>
        </div>
        <div class="col-12 mt-4">
            <div class="cah-card-wrapper login-box">
                <form id="loginform" class="cah-card position-relative" action="" method="post">
                    <div class="cah-card-content">
                        <div class="mb-1">
                            I want to be called
                            <input id="username" name="username" autofocus autocomplete="false"/>.
                        </div>
                        <small class="mb-2 d-block" id="errorblock" style="display:none;"></small>
                        <button type="submit" class="btn btn-primary" id="submitbtn">
                            Start playing
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("footer") ?>
<script>
    $(function () {
        $("#loginform").submit(function (e) {
            e.preventDefault();

            $("#submitbtn").attr("disabled", true);

            $.ajax({
                url: "<?= base_url('gameAPI/login') ?>",
                method: "post",
                data: {
                    username: $("#username").val()
                }
            }).done(function (data) {
                if (typeof data.status == "undefined") {
                    data = JSON.parse(data);
                }

                if (data.status == "success") {
                    window.location = "<?= base_url("game") ?>";
                } else if (data.status == "error") {
                    $("#errorblock").text(data.message);
                    setTimeout(function () {
                        $("#submitbtn").attr("disabled", false);
                        $("#errorblock").html("");
                    }, 4000);
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>