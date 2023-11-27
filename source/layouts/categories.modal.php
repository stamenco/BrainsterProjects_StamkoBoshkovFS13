<?php if ($_POST['modal'] == 'confirmDeleteCategory') { ?>
    <div class="modal fade" id="confirmModalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete category <span class="text-danger"><?= $_POST['title'] ?></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    You're about to delete selected category <strong><?= $_POST['title'] ?></strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="deleteGivenCategory" data-category-id="<?= $_POST['category_id'] ?>" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>
<?php }