<?php

use BLibrary\Auth\Auth;
use BLibrary\Database\Connection\DB;


require_once __DIR__ . "/../layouts/navbar.php"; ?>

<div id="modal-load"></div>

<div class="container py-3">
    <ul class="nav nav-tabs" id="myTab">
        <li class="nav-item">
            <button class="nav-link active" id="dashboard-tab" data-bs-target="#dashboard" data-bs-toggle="tab">Dashboard</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="authors-tab" data-bs-target="#authors" data-bs-toggle="tab">Authors</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="categories-tab" data-bs-target="#categories" data-bs-toggle="tab">Categories</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="books-tab" data-bs-target="#books" data-bs-toggle="tab">Books</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="comments-tab" data-bs-target="#comments" data-bs-toggle="tab">Comments</button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div id="notification" class="mt-4"></div>
        <div class="tab-pane fade show active" id="dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="card text-light bg-danger mt-2 pb-3">
                            <div class="card-body">
                                <p class="fs-3 fw-bold mb-0">
                                    <?php $stmt = DB::connect()->query("SELECT id as total FROM `users` WHERE 1"); ?>
                                    <?= $stmt->rowCount() ?></p>
                                <p class="fs-6 fw-light text-uppercase mb-0">users</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="card text-light bg-danger mt-2">
                            <div class="card-body">
                                <p class="fs-3 fw-bold mb-0">
                                <p class="fs-3 fw-bold mb-0">
                                    <?php $stmt = DB::connect()->query("SELECT id FROM `books` WHERE 1"); ?>
                                    <?= $stmt->rowCount() ?></p>
                                </p>
                                <p class="fs-6 fw-light text-uppercase mb-0">books</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="card text-light bg-danger mt-2">
                            <div class="card-body">
                                <p class="fs-3 fw-bold mb-0">
                                <p class="fs-3 fw-bold mb-0">
                                    <?php $stmt = DB::connect()->query("SELECT id FROM `categories` WHERE is_deleted = '0'"); ?>
                                    <?= $stmt->rowCount() ?></p>
                                </p>
                                <p class="fs-6 fw-light text-uppercase mb-0">active categories</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="card text-light bg-danger mt-2">
                            <div class="card-body">
                                <p class="fs-3 fw-bold mb-0">
                                <p class="fs-3 fw-bold mb-0">
                                    <?php $stmt = DB::connect()->query("SELECT id FROM `categories` WHERE is_deleted = '1'"); ?>
                                    <?= $stmt->rowCount() ?></p>
                                </p>
                                <p class="fs-6 fw-light text-uppercase mb-0">inactive categories</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="card text-light bg-primary mt-2">
                            <div class="card-body">
                                <p class="fs-3 fw-bold mb-0">
                                <p class="fs-3 fw-bold mb-0">
                                    <?php $stmt = DB::connect()->query("SELECT id FROM `authors` WHERE is_deleted = '0'"); ?>
                                    <?= $stmt->rowCount() ?></p>
                                </p>
                                <p class="fs-6 fw-light text-uppercase mb-0">active authors</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="card text-light bg-primary mt-2">
                            <div class="card-body">
                                <p class="fs-3 fw-bold mb-0">
                                <p class="fs-3 fw-bold mb-0">
                                    <?php $stmt = DB::connect()->query("SELECT id FROM `authors` WHERE is_deleted = '1'"); ?>
                                    <?= $stmt->rowCount() ?></p>
                                </p>
                                <p class="fs-6 fw-light text-uppercase mb-0">inactive authors</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="card text-light bg-primary mt-2">
                            <div class="card-body">
                                <p class="fs-3 fw-bold mb-0">
                                <p class="fs-3 fw-bold mb-0">
                                    <?php $stmt = DB::connect()->query("SELECT id FROM `comments` WHERE 1"); ?>
                                    <?= $stmt->rowCount() ?></p>
                                </p>
                                <p class="fs-6 fw-light text-uppercase mb-0">comments</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="card text-light bg-primary mt-2">
                            <div class="card-body">
                                <p class="fs-3 fw-bold mb-0">
                                <p class="fs-3 fw-bold mb-0">
                                    <?php $stmt = DB::connect()->query("SELECT id FROM `notes` WHERE 1"); ?>
                                    <?= $stmt->rowCount() ?></p>
                                </p>
                                <p class="fs-6 fw-light text-uppercase mb-0">notes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="categories">
            <small class="small text-uppercase fw-bold mt-2 mb-0">insert new categry</small>
            <form class="form-floating mb-3">
                <input type="text" class="form-control" id="category_name" placeholder="e.g. Marketing, Business, etc.">
                <label for="category_name">e.g. Marketing, Business, etc.</label>
                <button id="createCategoryAction" class="btn btn-outline-dark btn-sm mt-1">Create category</button>
            </form>

            <div class="container">
                <div class="row justify-content-center my-5" id="categories_list">
                    <?php $stmt = DB::connect()->query("SELECT * FROM categories WHERE 1");
                    if ($stmt->rowCount() > 0) {
                        while ($categoryData = $stmt->fetch()) { ?>
                            <div class="col-12 col-md-4 col-xl-3 mt-2" id="category<?= $categoryData['id'] ?>">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="category_title_<?= $categoryData['id'] ?>" placeholder="Category" value="<?= $categoryData['title'] ?>">
                                            <label for="category">Category</label>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <?php
                                        if ($categoryData['is_deleted']) { ?>
                                            <span class="xs-small text-uppercase text-danger m-0">deleted</span>
                                            <button id="restoreCategoryAction" data-category-id="<?= $categoryData['id'] ?>" class="btn btn-warning btn-sm">Restore</button>
                                        <?php } else if (!$categoryData['is_deleted']) { ?>
                                            <button id="updateCategoryAction" data-category-id="<?= $categoryData['id'] ?>" class="btn btn-outline-primary btn-sm mt-1">Update</button>
                                            <button id="deleteCategory" data-category-id="<?= $categoryData['id'] ?>" class="btn btn-danger btn-sm mt-1">Delete</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="col-12">
                            <div class="card border-0">
                                <div class="card-footer">
                                    <p class="lead mb-0">No categories were found yet</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="authors">
            <small class="small text-uppercase fw-bold mt-2 mb-0">insert new author</small>
            <form class="row g-2">
                <div class="col col-md col-xl-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="author_name" placeholder="John">
                        <label for="author_name">First Name</label>
                    </div>
                </div>
                <div class="col col-md col-xl-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="author_surname" placeholder="Doe">
                        <label for="author_surname">Last Name</label>
                    </div>
                </div>
                <div class="col col-md col-xl-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="author_about" placeholder="Author short bio. (min. 20 chars)..">
                        <label for="author_about">Author short bio. (min. 20 chars)..</label>
                    </div>
                </div>
                <div class="d-block mt-0">
                    <button id="createAuthorAction" class="btn btn-outline-dark btn-sm mt-1">Insert author</button>
                </div>
            </form>

            <div class="container">
                <ul class="list-group my-4" id="authors_list">
                    <?php $stmt = DB::connect()->query("SELECT * FROM authors WHERE 1");
                    if ($stmt->rowCount() > 0) {
                        while ($authorData = $stmt->fetch()) { ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center <?= ($authorData['is_deleted'] ? 'bg-gray' : '') ?>">
                                <div class="d-flex">
                                    <p class="fw-bold mb-0 me-4">Author: </p><?= $authorData['name'] . " " . $authorData['surname'] ?>
                                </div>
                                <div class="d-flex">
                                    <?php
                                    if (!$authorData['is_deleted']) { ?>
                                        <span id="updateAuthorModalA" data-author-id="<?= $authorData['id'] ?>" data-name="<?= $authorData['name'] ?>" data-surname="<?= $authorData['surname'] ?>" data-about="<?= $authorData['about'] ?>" data-created="<?= $authorData['created_at'] ?>" class="badge bg-warning rounded-pill mx-2 pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </span>
                                        <span id="deleteAuthorModal" data-author-id="<?= $authorData['id'] ?>" class="badge bg-danger rounded-pill mx-2 pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                                                <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z" />
                                            </svg>
                                        </span>
                                    <?php } else { ?>
                                        <span id="restoreAuthorAction" data-author-id="<?= $authorData['id'] ?>" class="badge bg-danger rounded-pill mx-2 pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                            </svg>
                                        </span>
                                </div>
                            </li>
                <?php }
                                }
                            } else {
                                echo "<li class='list-group-item fw-bold'>No authors found yet</li>";
                            } ?>
                </ul>
            </div>
        </div>

        <div class="tab-pane fade" id="comments">
            <div class="container">
                <div class="row justify-content-center mb-4" id="comments_list">
                    <?php $stmt = DB::connect()->query("SELECT `comments`.*, `users`.`fullname`, `books`.`title`, `books`.`code` 
                    FROM `comments`
                    JOIN `users` ON comments.existing_user_id = users.id
                    JOIN `books` ON comments.commented_on_book = books.id
                    WHERE 1 ORDER BY id ASC");

                    if ($stmt->rowCount() > 0) {
                        while ($commentData = $stmt->fetch()) { ?>
                            <div class="col-12 col-md-4 col-xl-3 mt-2">
                                <div class="card <?= (!$commentData['is_approved'] ? 'bg-gray' : '') ?>">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0 fw-bold">From: <span class="fw-normal"><?= $commentData['fullname'] ?></span></p>
                                            <?php if ($commentData['is_approved']) { ?>
                                                <span id="deleteCommentAction" data-comment-id="<?= $commentData['id'] ?>" class="badge bg-danger rounded-pill pointer fload-end">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                                                        <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z" />
                                                    </svg>
                                                </span>
                                            <?php } else { ?>
                                                <span id="appoveCommentAction" data-comment-id="<?= $commentData['id'] ?>" class="badge bg-danger rounded-pill pointer fload-end">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                                    </svg>
                                                </span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <strong>Comment:</strong> <?= $commentData['comment'] ?>
                                    </div>
                                    <div class="card-footer">
                                        <strong>Comment on Book:</strong><a href="<?= PATH . "book/" . $commentData['code'] ?>" class="text-decoration-none" target="_blank"> <?= $commentData['title'] ?></a>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } else {
                        echo "<ul class='list-group my-4'><li class='list-group-item fw-bold'>No comments found yet</li></ul>";
                    } ?>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="books">
            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                <small class="small text-uppercase fw-bold mx-1">insert new book</small>
                <button id="createBookModalBtn" class="btn btn-outline-dark btn-sm mx-1">Insert book</button>
            </div>
            <div class="container">
                <ul class="list-group my-4" id="books_list">
                    <?php
                    $stmt = DB::connect()->query("SELECT `books`.*, `authors`.`name`, `authors`.`surname`, `categories`.`title` as category_title FROM `books`
                    JOIN `authors` ON `books`.`existing_author_id` = `authors`.`id`
                    JOIN `categories` ON `books`.`category` = `categories`.`id`
                    WHERE 1");

                    if ($stmt->rowCount() > 0) {
                        while ($bookData = $stmt->fetch()) { ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <p class="fw-normal fs-5 mb-1">Book: <span class="fw-bold"><?= $bookData['title'] ?></span></p>
                                    <small>Author: <span class="fw-bold"><?= $bookData['name'] . " " . $bookData['surname'] ?></span></small>
                                </div>
                                <div class="d-flex">
                                    <a href="<?= PATH . "book/{$bookData['code']}" ?>" target="_blank" class="badge bg-info rounded-pill mx-2 pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg>
                                    </a>
                                    <a href="<?= PATH . "book/{$bookData['code']}/edit" ?>" target="_blank" class="badge bg-warning rounded-pill mx-2 pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </a>
                                    <span id="deleteBookModal" data-book-id="<?= $bookData['id'] ?>" data-book-code="<?= $bookData['code'] ?>" class="badge bg-danger rounded-pill mx-2 pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                                            <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z" />
                                        </svg>
                                    </span>
                                </div>
                            </li>
                    <?php }
                    } else {
                        echo "<ul class='list-group my-4'><li class='list-group-item fw-bold'>No books found yet</li></ul>";
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . "/../layouts/scripts.php"; ?>
<script type="module" src="<?= PATH . "source/assets/js/modules.js" ?>"></script>
<script type="module" src="<?= PATH . "source/assets/js/categories.js" ?>"></script>
<script type="module" src="<?= PATH . "source/assets/js/authors.js" ?>"></script>
<script type="module" src="<?= PATH . "source/assets/js/comments_dash.js" ?>"></script>
<script type="module" src="<?= PATH . "source/assets/js/books.js" ?>"></script>