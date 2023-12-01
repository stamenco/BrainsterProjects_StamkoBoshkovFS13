<?php

use BLibrary\Auth\Auth;
use BLibrary\Database\Connection\DB;

require_once __DIR__ . "/../../../autoload.php";

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'commentCreate') {

    emptyFields($_POST);

    try {
        if ($_POST['user'] != Auth::id()) {
            echo json_encode(['auth' => false, 'message' => 'There was an error, please try again']);
            exit;
        }

        $stmt = DB::connect()->prepare("SELECT * FROM comments WHERE existing_user_id = ? AND commented_on_book = ?");
        $stmt->execute([$_POST['user'], $_POST['comment_on_book']]);

        if ($stmt->rowCount() != 0) {
            echo json_encode(['auth' => false, 'message' => 'You have already commented']);
            exit;
        }

        $stmt = DB::connect()->prepare("INSERT INTO comments (existing_user_id, commented_on_book, comment, is_approved) VALUES(?, ?, ?, '0')");
        $stmt->execute([$_POST['user'], $_POST['comment_on_book'], $_POST['comment']]);

        echo json_encode(['auth' => true, 'id' => DB::connect()->lastInsertId()]);
        exit;
    } catch (PDOException $e) {
        echo json_encode(['auth' => false, 'message' => $e]);
        exit;
    }
}
