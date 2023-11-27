<?php 
    require_once __DIR__ . '/../../autoload.php';

    use BLibrary\Database\Connection\DB;

    if ($_POST['modal'] == 'createBookModal') { ?>
    <div class="modal fade" id="createBookModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create new book</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="book_notification"></div>
                    <div class="container-fluid">
                        <div class="row my-2">
                            <div class="col">
                                <div id="update_book_notifiation"></div>
                            </div>
                        </div>
                        <div class="row justify-content-center my-2 g-2">
                            <div class="col-12 col-md-6 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="book_title" placeholder="Book Title">
                                    <label for="book_title">Book Title</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-xl-6">
                                <div class="form-floating">
                                    <select class="form-select" id="book_author">
                                        <?php $stmt = DB::connect()->query("SELECT id, name, surname FROM authors WHERE is_deleted = '0'");

                                        if ($stmt->rowCount() == 0) {
                                            echo '<option selected disabled>No authors found yet</option>';
                                        } else { ?>
                                            <option selected disabled>Please select author</option>
                                            <?php while ($fetchAuthor = $stmt->fetch()) { ?>
                                                <option value="<?= $fetchAuthor['id'] ?>"><?= $fetchAuthor['name'] . " " . $fetchAuthor['surname'] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                    <label for="book_author">Book Author</label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center my-2 g-2">
                            <div class="col-12 col-md-6 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="book_published" placeholder="Originally published">
                                    <label for="book_published">Originally published</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-xl-6">
                                <div class="form-floating">
                                    <select class="form-select" id="book_category">
                                        <?php $stmt = DB::connect()->query("SELECT id, title FROM categories WHERE is_deleted = '0'");

                                        if ($stmt->rowCount() == 0) {
                                            echo '<option selected disabled>No categories found yet</option>';
                                        } else { ?>
                                            <option selected disabled>Please select category</option>
                                            <?php while ($fetchCategory = $stmt->fetch()) { ?>
                                                <option value="<?= $fetchCategory['id'] ?>"><?= $fetchCategory['title'] ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                    <label for="book_category">Book Category</label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center my-2 g-2">
                            <div class="col-12 col-md-6 col-xl-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="book_pages" placeholder="Book Pages">
                                    <label for="book_pages">Book Pages</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-xl-8">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="book_image_url" placeholder="Book Image URL">
                                    <label for="book_image_url">Book Image URL</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="createBookAction" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>
<?php } else if ($_POST['modal'] == 'deleteBookModal') { ?>
    <div class="modal fade" id="bookModalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirm delete book</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    You're about to delete selected book and it's data (comments & notes)</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="deleteGivenBook" data-book-id="<?= $_POST['book_id'] ?>" data-book-code="<?= $_POST['book_code'] ?>" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
<?php }
