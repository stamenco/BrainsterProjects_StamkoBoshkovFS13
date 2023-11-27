<?php

use BLibrary\Database\Connection\DB;

require_once __DIR__ . "/../../../autoload.php";

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'bookDelete') {

    emptyFields($_POST);

    try {
 
        $stmt = DB::connect()->prepare("DELETE FROM books WHERE id = ? AND code = ?");
        if ($stmt->execute([$_POST['book_id'], $_POST['book_code']])) {

            $stmt = DB::connect()->prepare("DELETE FROM comments WHERE commented_on_book = ?")->execute([$_POST['book_id']]);
            $stmt = DB::connect()->prepare("DELETE FROM notes WHERE note_on_book = ?")->execute([$_POST['book_id']]);

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
