<?php

use BLibrary\Database\Connection\DB;

require_once __DIR__ . "/../../../autoload.php";

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'authorUpdate') {

    emptyFields($_POST);

    if (strlen($_POST['about']) <= 20) {
        echo json_encode(['auth' => false, 'message' => 'Biography field require minimum 20 characters']);
        exit;
    }

    try {
        $stmt = DB::connect()->prepare("SELECT name, surname FROM authors WHERE name = ? AND surname = ?");
        $stmt->execute([$_POST['name'], $_POST['surname']]);

        if ($stmt->rowCount() != 0) {
            echo json_encode(['auth' => false, 'message' => "You didn't made any changes"]);
            exit;
        }

        $stmt = DB::connect()->prepare("UPDATE authors SET name = ?, surname = ?, about = ? WHERE id = ?");
        $stmt->execute([$_POST['name'], $_POST['surname'], $_POST['about'], $_POST['author_id']]);

        echo json_encode(['auth' => true]);
        exit;
    } catch (PDOException $e) {
        echo json_encode(['auth' => false, 'message' => $e]);
        exit;
    }
}
