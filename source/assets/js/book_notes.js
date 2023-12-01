import { path, success, danger, formatDate } from './modules.js'
$(function() {

    $('#addMyNoteAction').on('click', function() {
        $('#new_note').fadeToggle()
    })

    $('#createMyNoteAction').on('click', function() {
        let user = $(this).attr('data-user-id')
        let book_code = $(this).attr('data-book-code')
        let note = $('#newNote').val()

        $.post(path + 'source/actions/Note/create.php', {
            process: 'noteCreate', user, note, book_code
        })
        .then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success('You have successfully added new note')
                $('#newNote').val('')
                $('#ajax').append(`
                <div class="accordion mt-2" id="accordion${data.id}">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading${data.id}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${data.id}">
                            Note # - ${formatDate(new Date())}
                            </button>
                        </h2>
                        <div id="collapse${data.id}" class="accordion-collapse collapse" data-bs-parent="#accordion${data.id}">
                            <div class="accordion-body">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a note here" id="noteContent${data.id}" style="height: 100px; resize: none;">${note}</textarea>
                                    <label for="noteContent">Leave a note here</label>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button id='updateMyNoteAction' data-note-id='${data.id}'  data-user='${user}' class='btn btn-outline-dark btn-sm'>Update note</button>
                                <button id='deleteMyNoteAction'data-note-id='${data.id}'  data-user='${user}' class='btn btn-danger btn-sm'>Delete note</button>
                            </div>
                        </div>
                    </div>
                </div>
                `)
                $('#new_note').fadeToggle()
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })

    $('body').on('click', '#updateMyNoteAction', function() {
        let user = $(this).attr('data-user')
        let note_id = $(this).attr('data-note-id')
        let note_text = $(`#noteContent${note_id}`).val()

        $.post(path + "source/actions/Note/update.php", {
            process: 'noteUpdate', user, note_id, note_text
        })
        .then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success('You have successfully updated existing note')
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err)
            danger(`${data.message}`)
        })
    })

    $('body').on('click', '#deleteMyNoteAction', function() {
        let user = $(this).attr('data-user')
        let note_id = $(this).attr('data-note-id')

        $.post(path + "source/actions/Note/delete.php", {
            process: 'noteDelete', user, note_id
        })
        .then((response) => {
            let data = JSON.parse(response)

            if (data.auth) {
                success('You have successfully deleted existing note')
                $('#accordion'+note_id).hide('slow')
            } else if (!data.auth && data.message) {
                danger(`${data.message}`)
            }
        }).catch((err) => {
            let data = JSON.parse(err)
            danger(`${data.message}`)
        })
    })
})