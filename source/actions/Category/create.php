<?php

use BLibrary\Database\Connection\DB;

require_once __DIR__ . "/../../../autoload.php";

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'categoryCreate') {

    emptyFields($_POST);
    
    $_POST['title'] = strtolower($_POST['title']);

    try {
        $stmt = DB::connect()->prepare("SELECT title FROM categories WHERE title = ?");
        $stmt->execute([$_POST['title']]);

        if ($stmt->rowCount() != 0) {
            echo json_encode(['auth' => false, 'message' => "Category with title {$_POST['title']} already exists"]);
            exit;
        }

        $stmt = DB::connect()->prepare("INSERT INTO categories (title, is_deleted) VALUES(?, '0')");
        $stmt->execute([$_POST['title']]);

        echo json_encode(['auth' => true, 'id' => DB::connect()->lastInsertId()]);
        exit;
    } catch (PDOException $e) {
        echo json_encode(['auth' => false, 'message' => $e]);
        exit;
    }
}
