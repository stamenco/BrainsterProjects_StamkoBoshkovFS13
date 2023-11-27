import { success, danger, path } from './modules.js'
$(function () {

    $('#createBookModalBtn').on('click', function () {
        $('#modal-load').load(path + 'source/layouts/books.modal.php', { modal: "createBookModal" }, function () {
            $('#createBookModal').modal('show')
        })
    })

    $('body').on('click', '#createBookAction', function () {
        
        let book_title = $('#book_title').val()
        let book_author = $('#book_author').val()
        let book_published = $('#book_published').val()
        let book_category = $('#book_category').val()
        let book_pages = $('#book_pages').val()
        let book_image_url = $('#book_image_url').val()

        $.post(path + 'source/actions/Book/create.php', {
            process: 'bookCreate', book_title, book_author, book_category, book_published, book_pages, book_image_url
        }).then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success(`You have successfully created book: <strong>${book_title}</strong>`, 'book_notification')
                setTimeout(() => { window.location.href = path + `book/${data.book_code}` }, 2000)
            } else if (!data.auth && data.message) {
                danger(`${data.message}`, 'book_notification')
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`, 'book_notification')
        })
    })

    $('#cancelUpdate').on('click', function () {
        danger('You have canceled the editing process', 'update_book_notifiation')
        setTimeout(() => { window.location.href = path + "dashboard" }, 2000)
    })

    $('#updateBookAction').on('click', function () {
        let book_id = $(this).attr('data-book-id')
        let book_code = $(this).attr('data-book-code')
        let book_title = $('#book_title').val()
        let book_author = $('#book_author').val()
        let book_published = $('#book_published').val()
        let book_category = $('#book_category').val()
        let book_pages = $('#book_pages').val()
        let book_image_url = $('#book_image_url').val()

        $.post(path + 'source/actions/Book/update.php', {
            process: 'bookUpdate', book_id, book_code, book_title, book_author, book_category, book_published, book_pages, book_image_url
        }).then((response) => {
            let data = JSON.parse(response)
            if (data.rows == 0) {
                danger(`You didn't make any changes`, 'update_book_notifiation')
                return
            }
            if (data.auth) {
                success('You have successfully updated current book', 'update_book_notifiation')
                setTimeout(() => { window.location.href = path + `book/${book_code}` }, 2000)
            } else if (!data.auth && data.message) {
                danger(`${data.message}`, 'update_book_notifiation')
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`, 'update_book_notifiation')
        })
    })

    $('body').on('click', '#deleteBookModal', function() {
        let book_id = $(this).attr('data-book-id')
        let book_code = $(this).attr('data-book-code')

		$('#modal-load').load(path + 'source/layouts/books.modal.php', { modal: "deleteBookModal", book_id, book_code }, function() {
            $('#bookModalDelete').modal('show')
        })
    })

    $('#modal-load').on('click', '#deleteGivenBook', function() {
        let book_id = $(this).attr('data-book-id')
        let book_code = $(this).attr('data-book-code')

        $.post(path + 'source/actions/Book/delete.php', {
            process: 'bookDelete', book_id, book_code
        }).then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                $('#bookModalDelete').modal('hide')
                success('You have successfully deleted selected book and it\'s data')
                $('#books_list').load(location.href + ' #books_list');
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })
})