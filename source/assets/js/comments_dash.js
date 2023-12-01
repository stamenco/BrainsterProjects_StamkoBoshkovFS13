import { path, success, danger } from './modules.js'
$(function() {
    $('body').on('click', '#appoveCommentAction', function() {
        let comment_id = $(this).attr('data-comment-id')

        $.post(path + 'source/actions/Comment/update.php', {
            process: 'commentApprove', comment_id
        }).then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success(`You have approved selected comment`)
                $('#comments_list').load(location.href + ' #comments_list')
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })

    $('body').on('click', '#deleteCommentAction', function() {
        let comment_id = $(this).attr('data-comment-id')

        $.post(path + 'source/actions/Comment/admin.delete.php', {
            process: 'commentAdminDelete', comment_id
        }).then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success(`You have deleted selected comment`)
                $('#comments_list').load(location.href + ' #comments_list')
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })
})