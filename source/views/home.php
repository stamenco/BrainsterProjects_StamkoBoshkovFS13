<?php

use BLibrary\Database\Connection\DB;

require_once __DIR__ . "/../layouts/navbar.php"; ?>

<div id="banner" class="d-flex justify-content-center align-items-center">
    <h1 class="text-capitalize text-light mb-0">brainster library</h1>
</div>

<div class="container my-2" id="notification"></div>

<?php require_once __DIR__ . "/../layouts/footer.php"; ?>
<?php require_once __DIR__ . "/../layouts/scripts.php"; ?>
<script src="<?= PATH . "source/assets/js/footer.js" ?>"></script>
<script type="module" src="<?= PATH . "source/assets/js/modules.js" ?>"></script>
<script type="module" src="<?= PATH . "source/assets/js/filter.js" ?>"></script>