import { path, danger } from './modules.js'
$(function() {

    $('#list_books').load(path + 'source/layouts/books.filter.php')

    let filterArr = []
    
    $('[name="categoryFilter"]').bind('click', function () {
        let filter = $(this).attr('data-category')

        if ($(this).is(':checked')) {
            filterArr.push(filter);
        } else {
            let index = filterArr.indexOf(filter);
            if ((index = filterArr.indexOf(filter)) !== -1) {
                filterArr.splice(index, 1);
            }
        }

        if (isNaN(filter)) {
            return
        }
        
        $.post(path + 'source/layouts/books.filter.php', {
            filterArr
        }).then((response) => {
            $('#list_books').html(response)
        }).catch((err) => {
            let data = JSON.parse(err.responseText)
            danger(`${data.message}`)
        })
    })
})