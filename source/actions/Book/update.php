<?php

use BLibrary\Database\Connection\DB;

require_once __DIR__ . "/../../../autoload.php";

if (!onlyPostRequestMethod()) {
    redirect(route('home'));
}

if ($_POST['process'] = 'bookUpdate') {

    emptyFields($_POST);

    if ($_POST['book_author'] == 0 || $_POST['book_category'] == 0) {
        echo json_encode(['auth' => false, 'message' => 'Please select valid author or category']);
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
        $stmt = DB::connect()->prepare("UPDATE books SET 
            existing_author_id = ?,
            category = ?,
            title = ?,
            published = ?,
            pages = ?,
            cover_image = ?
        WHERE id = ? AND code = ?");
        
        if (!$stmt->execute([$_POST['book_author'], $_POST['book_category'], $_POST['book_title'], $_POST['book_published'], $_POST['book_pages'], $_POST['book_image_url'], $_POST['book_id'], $_POST['book_code']])) {
            echo json_encode(['auth' => false, 'message' => 'There was an error, please try again']);
            exit;
        }

        echo json_encode(['auth' => true, 'rows' => $stmt->rowCount()]);
        exit;

    } catch (PDOException $e) {
        echo json_encode(['auth' => false, 'message' => $e]);
        exit;
    }
}
