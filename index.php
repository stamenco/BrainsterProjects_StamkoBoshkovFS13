<?php
require_once __DIR__ . "/autoload.php";

use BLibrary\Router\Router;

if (!Router::get(2)) {
    $file = "home";
} else {
    $file = Router::get(2);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once __DIR__ . "/source/layouts/head.php"; ?>
</head>

<body>
    <?php
    if (file_exists(__DIR__ . "/source/views/{$file}.php")) {
        require_once __DIR__ . "/source/views/{$file}.php";
    } else {
        require_once __DIR__ . "/source/views/404.php";
    }
    ?>
</body>

</html>