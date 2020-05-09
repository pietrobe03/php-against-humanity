<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>/css/base.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/cah.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/all.min.css">

    <title><?= esc($title, "html"); ?> | CahClone</title>
    <script>const baseurl = "<?= base_url(); ?>";</script>
</head>
<body <?= isset($body_classes) ? 'class="'.$body_classes.'"' : "" ?>>
<?= $this->renderSection('content') ?>

<div id="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<script src="<?= base_url() ?>/js/base.js"></script>
<script  src="<?= base_url() ?>/js/cah.js"></script>
<?= $this->renderSection('footer') ?>
</body>
</html>