<?php

use BLibrary\Database\Connection\DB;

require_once __DIR__ . "/../layouts/navbar.php"; ?>

<div id="banner" class="d-flex justify-content-center align-items-center">
    <h1 class="text-capitalize text-light mb-0">brainster library</h1>
</div>

<!-- Filter initialization -->
<div class="container my-2" id="notification"></div>
<div class="container">
    <p class="small text-uppercase p-0 mt-5">Filter categories</p>
    <div class="row border border-2 rounded g-0">
        <form class="d-flex flex-wrap m-2" id="submit">
            <?php $stmt = DB::connect()->query("SELECT * FROM categories WHERE is_deleted = 0 ORDER BY title ASC");
            if ($stmt->rowCount() == 0) {
                echo "<p class='small text-uppercase mt-3 bg-danger text-light p-1 rounded'>nothing found</p>";
            } else {
                while ($filterData = $stmt->fetch()) { ?>
                    <input type="checkbox" class="btn-check m-2 filter-checkbox" id="categoryFilter<?= $filterData['id'] ?>" name="categoryFilter" data-category="<?= $filterData['id'] ?>" autocomplete="off">
                    <label class="btn btn-outline-secondary m-2" for="categoryFilter<?= $filterData['id'] ?>"><?= htmlspecialchars(ucfirst($filterData['title'])) ?></label>
            <?php }
            } ?>
        </form>
    </div>
</div>

<!-- Cards initialization -->
<div class="container">
    <div class="row py-5" id="list_books"></div>
</div>

<?php require_once __DIR__ . "/../layouts/footer.php"; ?>
<?php require_once __DIR__ . "/../layouts/scripts.php"; ?>
<script src="<?= PATH . "source/assets/js/footer.js" ?>"></script>
<script type="module" src="<?= PATH . "source/assets/js/modules.js" ?>"></script>
<script type="module" src="<?= PATH . "source/assets/js/filter.js" ?>"></script>