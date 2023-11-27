import { path, success, danger } from './modules.js'
$(function() {

    $('#createAuthorAction').on('click', function(e) {
        e.preventDefault()

        let name = $('#author_name').val()
        let surname = $('#author_surname').val()
        let bio = $('#author_about').val()

        $.post(path + 'source/actions/Author/create.php', {
            process: 'authorCreate', name, surname, bio
        }).then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success(`You have successfully inserted new Author: <strong>${name} ${surname}</strong>`)
                $('#authors_list').load(location.href + ' #authors_list')
                $('#author_name').val('')
                $('#author_surname').val('')
                $('#author_about').val('')
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })

    $('body').on('click', '#restoreAuthorAction', function() {
        let author_id = $(this).attr('data-author-id')

        $.post(path + 'source/actions/Author/restore.php', {
            process: 'authorRestore', author_id 
        }).then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success(`You have successfully restored selected author`)
                $('#authors_list').load(location.href + ' #authors_list')
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })

    $('body').on('click', '#deleteAuthorModal', function() {
        let author = $(this).attr('data-author-id')

		$('#modal-load').load(path + 'source/layouts/authors.modal.php', { modal: "confirmDeleteCategory", author }, function() {
            $('#confirmModalDelete').modal('show')
        })
    })

    $('#modal-load').on('click', '#deleteGivenAuthor', function() {
        let author_id = $(this).attr('data-author-id')

        $.post(path + 'source/actions/Author/delete.php', {
            process: 'authorDelete', author_id
        }).then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                $('#confirmModalDelete').modal('hide')
                success('You have successfully deleted selected author')
                $('#authors_list').load(location.href + ' #authors_list');
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })

    $('body').on('click', '#updateAuthorModalA', function() {
        let author = $(this).attr('data-author-id')
        let name = $(this).attr('data-name')
        let surname = $(this).attr('data-surname')
        let about = $(this).attr('data-about')
        let created_at = $(this).attr('data-created')

		$('#modal-load').load(path + 'source/layouts/authors.modal.php', { modal: "updateAuthorModal", author, name, surname, about, created_at }, function() {
            $('#updateAuthorModal').modal('show')
            $('#updateAuthorModal').prop('disabled', true)
        })
    })

    $('#modal-load').on('click', '#updateGivenAuthor', function() {
        let author_id = $(this).attr('data-author-id')
        let name = $('#author_name').val()
        let surname = $('#author_surname').val()
        let about = $('#author_about').val()

        $.post(path + 'source/actions/Author/update.php', {
            process: 'authorUpdate', author_id, name, surname, about
        }).then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                $('#updateAuthorModal').modal('hide')
                success(`You have successfully updated author: <strong>${name} ${surname}</strong>`)
                $('#authors_list').load(location.href + ' #authors_list')
                $('#updateAuthorModal').prop('disabled', false)
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
                $('#updateAuthorModal').modal('hide')
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })
})