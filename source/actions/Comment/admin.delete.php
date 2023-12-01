<?php

use BLibrary\Auth\Auth;
use BLibrary\Database\Connection\DB;

require_once __DIR__ . "/../../../autoload.php";

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'commentAdminDelete') {

    emptyFields($_POST);

    try {
        $stmt = DB::connect()->prepare("UPDATE comments SET is_approved = '0' WHERE id = ?");

        if ($stmt->execute([$_POST['comment_id']])) {
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
