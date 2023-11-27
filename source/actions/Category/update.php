<?php

use BLibrary\Database\Connection\DB;

require_once __DIR__ . "/../../../autoload.php";

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'categoryUpdate') {

    emptyFields($_POST);
    
    $_POST['title'] = strtolower($_POST['title']);

    try {
        $stmt = DB::connect()->prepare("SELECT title FROM categories WHERE title = ?");
        $stmt->execute([$_POST['title']]);

        if ($stmt->rowCount() != 0) {
            echo json_encode(['auth' => false, 'message' => "Category with title {$_POST['title']} already exists"]);
            exit;
        }

        $stmt = DB::connect()->prepare("UPDATE categories SET title = ? WHERE id = ?");
        
        if ($stmt->execute([$_POST['title'], $_POST['category_id']])) {
            echo json_encode(['auth' => true]);
            exit;
        }

        echo json_encode(['auth' => false, 'message' => 'There was an error, please try again']);
        exit;
        
    } catch (PDOException $e) {
        echo json_encode(['auth' => false, 'message' => $e]);
        exit;
    }
}
