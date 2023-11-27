<?php

use BLibrary\Database\Connection\DB;

require_once __DIR__ . "/../../../autoload.php";

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'bookCreate') {

    emptyFields($_POST);

    if ($_POST['book_author'] == 0 || $_POST['book_category'] == 0) {
        echo json_encode(['auth' => false, 'message' => 'Please select valid author or category']);
        exit;
    }

    if (!is_numeric($_POST['book_author']) || !is_numeric($_POST['book_category'])) {
        echo json_encode(['auth' => false, 'message' => 'Book author or book category must be of type integer']);
        exit;
    }

    if (!filter_var($_POST['book_image_url'], FILTER_VALIDATE_URL)) {
        echo json_encode(['auth' => false, 'message' => 'Please provide a valid URL link for image cover']);
        exit;
    }

    if (!is_numeric($_POST['book_published']) || !is_numeric($_POST['book_pages'])) {
        echo json_encode(['auth' => false, 'message' => 'Book published year or book pages must be of type integer']);
        exit;
    }

    try {
        $stmt = DB::connect()->prepare("SELECT existing_author_id FROM books WHERE existing_author_id = ?");
        $stmt->execute([$_POST['book_author']]);

        if ($stmt->rowCount() != 0) {
            echo json_encode(['auth' => false, 'message' => 'There are existing book with selected author']);
            exit;
        }

        $book_code = generateCode();
        $stmt = DB::connect()->prepare("SELECT code FROM books WHERE code = ?");
        $stmt->execute([$book_code]);

        if ($stmt->rowCount() != 0) {
            $book_code = generateCode();
        }

        $stmt = DB::connect()->prepare("INSERT INTO books 
              (existing_author_id, category, title, published, pages, cover_image, code) 
        VALUES(?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([$_POST['book_author'], $_POST['book_category'], $_POST['book_title'], $_POST['book_published'], $_POST['book_pages'], $_POST['book_image_url'], $book_code]);

        echo json_encode(['auth' => true, 'book_code' => $book_code]);
        exit;

    } catch (PDOException $e) {
        echo json_encode(['auth' => false, 'message' => $e]);
        exit;
    }
}
