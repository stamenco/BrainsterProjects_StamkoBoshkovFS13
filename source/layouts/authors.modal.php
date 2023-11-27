<?php if ($_POST['modal'] == 'confirmDeleteCategory') { ?>
    <div class="modal fade" id="confirmModalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    You're about to delete selected author
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="deleteGivenAuthor" data-author-id="<?= $_POST['author'] ?>" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
<?php } else if ($_POST['modal'] == 'updateAuthorModal') { ?>
    <div class="modal fade" id="updateAuthorModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Author created at: <span class="text-danger"><?= $_POST['created_at'] ?></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mt-2">
                        <input type="text" class="form-control" id="author_name" value="<?= $_POST['name'] ?>" placeholder="John">
                        <label for="author_name">Name</label>
                    </div>
                    <div class="form-floating mt-2">
                        <input type="text" class="form-control" id="author_surname" value="<?= $_POST['surname'] ?>" placeholder="Doe">
                        <label for="author_surname">Surname</label>
                    </div>

                    <div class="form-floating mt-2">
                        <textarea class="form-control" placeholder="Author bio.." id="author_about" style="height: 250px; resize: none;"><?= $_POST['about'] ?></textarea>
                        <label for="author_about">Author bio..</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="updateGivenAuthor" data-author-id="<?= $_POST['author'] ?>" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
<?php } $_POST = [];