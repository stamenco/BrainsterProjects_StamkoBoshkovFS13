<?php

use BLibrary\Database\Connection\DB;

require_once __DIR__ . "/../../../autoload.php";

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'authorCreate') {

    emptyFields($_POST);

    if (strlen($_POST['bio']) <= 20) {
        echo json_encode(['auth' => false, 'message' => 'Biography field require minimum 20 characters']);
        exit;
    }

    try {
        $stmt = DB::connect()->prepare("SELECT name, surname FROM authors WHERE name = ? AND surname = ?");
        $stmt->execute([$_POST['name'], $_POST['surname']]);

        if ($stmt->rowCount() != 0) {
            echo json_encode(['auth' => false, 'message' => "Author with name {$_POST['name']} and surname {$_POST['surname']} already exists"]);
            exit;
        }

        $stmt = DB::connect()->prepare("INSERT INTO authors (name, surname, about, is_deleted) VALUES(?, ?, ?, '0')");
        $stmt->execute([$_POST['name'], $_POST['surname'], $_POST['bio']]);

        echo json_encode(['auth' => true]);
        exit;
    } catch (PDOException $e) {
        echo json_encode(['auth' => false, 'message' => $e]);
        exit;
    }
}
