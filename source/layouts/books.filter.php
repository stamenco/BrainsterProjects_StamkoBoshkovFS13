<?php

require_once __DIR__ . "/../../autoload.php";
use BLibrary\Database\Connection\DB;

$sql = "SELECT `books`.*, `authors`.`name`, `authors`.`surname`, `categories`.`title` as category_title 
FROM `books`
JOIN `authors` ON `books`.`existing_author_id` = `authors`.`id`
JOIN `categories` ON `books`.`category` = `categories`.`id` WHERE 1 ";

if (isset($_POST['filterArr']) && $_POST['filterArr'] != "") {
    $sql .= 'AND category IN ('. join(",", $_POST['filterArr']) .') ';
}

try {
    $stmt = DB::connect()->prepare($sql);
    $stmt->execute(); 

    if ($stmt->rowCount() == 0) {
        echo "<div class='alert' role='alert'>No books were found!</div>";
    } else { while($bookData = $stmt->fetch()) { ?>
        <div class="col-12 col-md-4 mt-3">
            <div class="book text-light card-has-bg click-col" style="background-image:url('<?= $bookData['cover_image'] ?>');">
                <img class="card-img d-none" src="<?= $bookData['cover_image'] ?>" />
                <div class="card-img-overlay d-flex flex-column">
                    <div class="card-body">
                        <small class="text-warning mb-2"><?= $bookData['name'] . " " . $bookData['surname'] ?></small>
                        <a href="<?= PATH . "book/" . $bookData['code'] ?>" class="h4 d-block mt-0 text-light "><?= $bookData['title'] ?></a>
                        <small><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmarks" viewBox="0 0 16 16">
                                <path d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4zm2-1a1 1 0 0 0-1 1v10.566l3.723-2.482a.5.5 0 0 1 .554 0L11 14.566V4a1 1 0 0 0-1-1H4z" />
                                <path d="M4.268 1H12a1 1 0 0 1 1 1v11.768l.223.148A.5.5 0 0 0 14 13.5V2a2 2 0 0 0-2-2H6a2 2 0 0 0-1.732 1z" />
                            </svg> <?= ucfirst($bookData['category_title']) ?></small>
                    </div>
                </div>
            </div>
        </div>
    <?php } }
} catch (PDOException $e) {
    echo json_encode(['auth' => false, 'message' => $e]);
    exit;
}