<?php

use BLibrary\Auth\Auth;
use BLibrary\Database\Connection\DB;

require_once __DIR__ . "/../../../autoload.php";

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'noteUpdate') {

    emptyFields($_POST);

    try {
        if ($_POST['user'] != Auth::id()) {
            echo json_encode(['auth' => false, 'message' => 'There was an error, please try again']);
            exit;
        }

        $stmt = DB::connect()->prepare("UPDATE notes SET note_text = ? WHERE id = ?");
        $stmt->execute([$_POST['note_text'], $_POST['note_id']]);

        echo json_encode(['auth' => true]);
        exit;
        
    } catch (PDOException $e) {
        echo json_encode(['auth' => false, 'message' => $e]);
        exit;
    }
}
