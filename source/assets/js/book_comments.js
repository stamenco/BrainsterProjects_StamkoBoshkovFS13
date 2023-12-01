import { path, success, danger, formatDate } from './modules.js'
$(function() {
    $('#commentAction').on('click', function(e) {
        e.preventDefault()

        let user = $(this).attr('data-user-id')
        let comment = $('#comment').val()
        let comment_on_book = $(this).attr('data-book-id')

        $.post(path + "source/actions/Comment/create.php", {
            process: 'commentCreate', user, comment, comment_on_book
        })
        .then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                $('#comment').val('')
                $(`<div class="card-body border-bottom" id="comment${data.id}" style="background-color: #ffb7b7;">
                        <div class='float-end'>
                            <button id='deleteCommentAction' data-comment-id='${data.id}' data-user-id='${user}' class='btn btn-danger btn-sm'>Delete comment</button>
                        </div>
                        <h5 class="fw-bold text-primary mb-1">Your comment is awaiting moderation</h5>
                        <p class="text-muted small mb-0">${formatDate(new Date())}</p>
                        <p class="mt-3 mb-0">${comment}</p>
                    </div>
                `).insertBefore('.card-footer')
                success('You have successfully commented on this book', 'book_notifications')    
            } else if (!data.auth && data.message) {
                danger(`${data.message}`, 'book_notifications')
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`, 'book_notifications')
        })
    })

    $('body').on('click', '#deleteCommentAction', function() {
        let user = $(this).attr('data-user-id') 
        let comment_id = $(this).attr('data-comment-id')

        $.post(path + "/source/actions/Comment/delete.php", {
            process: 'commentDelete', user, comment_id
        })
        .then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success('You have successfully delete the selected comment', 'book_notifications')
                $(`#comment${comment_id}`).hide('slow')
            } else if (!data.auth && data.message) {
                danger(`${data.message}`, 'book_notifications')
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`, 'book_notifications')
        })
    })
})