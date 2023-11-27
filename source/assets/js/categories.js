import { path, success, danger } from './modules.js'
$(function() {

    $('#createCategoryAction').on('click', function(e) {
        e.preventDefault()

        let title = $('#category_name').val()

        $.post(path + 'source/actions/Category/create.php', {
            process: 'categoryCreate', title
        }).then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success('You have successfully inserted new category')
                $('#categories_list').load(location.href + ' #categories_list');
                $('#category_name').val('')
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })

    $('body').on('click', '#restoreCategoryAction', function() {
        let category_id = $(this).attr('data-category-id')

        $.post(path + 'source/actions/Category/restore.php', {
            process: 'categoryRestore', category_id
        }).then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success('You have successfully restored deleted category')
                $('#categories_list').load(location.href + ' #categories_list');
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })

    $('body').on('click', '#updateCategoryAction', function() {
        let category_id = $(this).attr('data-category-id')
        let title = $(`#category_title_${category_id}`).val()

        $.post(path + 'source/actions/Category/update.php', {
            process: 'categoryUpdate', category_id, title
        }).then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success('You have successfully updated category')
                $('#categories_list').load(location.href + ' #categories_list');
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })

    $('body').on('click', '#deleteCategory', function() {
        let category_id = $(this).attr('data-category-id')
        let title = $(`#category_title_${category_id}`).val()

		$('#modal-load').load(path + 'source/layouts/categories.modal.php', { modal: "confirmDeleteCategory", category_id, title }, function() {
            $('#confirmModalDelete').modal('show')
        })
	})

    $('#modal-load').on('click', '#deleteGivenCategory', function() {
        let category_id = $(this).attr('data-category-id')

        $.post(path + 'source/actions/Category/delete.php', {
            process: 'categoryDelete', category_id
        }).then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                $('#confirmModalDelete').modal('hide')
                success('You have successfully deleted selected category')
                $('#categories_list').load(location.href + ' #categories_list');
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })
})