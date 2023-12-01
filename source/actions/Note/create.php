<?php

use BLibrary\Auth\Auth;
use BLibrary\Database\Connection\DB;

require_once __DIR__ . "/../../../autoload.php";

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'noteCreate') {

    emptyFields($_POST);

    try {
        if ($_POST['user'] != Auth::id()) {
            echo json_encode(['auth' => false, 'message' => 'There was an error, please try again']);
            exit;
        }

        $stmt = DB::connect()->prepare("INSERT INTO notes (existing_user_id, note_on_book, note_text) VALUES(?, ?, ?)");
        $stmt->execute([$_POST['user'], $_POST['book_code'], $_POST['note']]);

        echo json_encode(['auth' => true, 'id' => DB::connect()->lastInsertId()]);
        exit;
    } catch (PDOException $e) {
        echo json_encode(['auth' => false, 'message' => $e]);
        exit;
    }
}
