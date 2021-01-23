function addItem() {
    var add = $('#add-item');
}

function editItem(id) {
    var li = $('#item-'+id);
    var edit = $('li#edit-item-'+id);

    $.ajax({
            type: 'POST',
            url: '/admin/order-item/update',
            data: {id: id}
        }
    ).done(function (data) {
        li.toggleClass('hidden');
        edit.toggleClass('hidden');

        if(data.success !== true) {
            edit.html(data);
        }
    })
    .fail(function () {

    });

    return false;
}

function saveItem(id) {
    if(id.length > 0) {

        var li = $('#item-'+id);
        var edit = $('li#edit-item-'+id);

        $('#edit-'+id).submit(function (event) {
            event.preventDefault();
            var editForm = $(this);
            $.ajax({
                    type: editForm.attr('method'),
                    url: editForm.attr('action'),
                    data: editForm.serializeArray()
                }
            ).done(function(data) {
                if(data.success) {
                    li.toggleClass('hidden');
                    edit.empty();
                    edit.toggleClass('hidden');
                }
            })
                .fail(function () {
                    console.log('Error!');
                });

            return false;
        });
    }
}

function cancelEdit(id) {
    var li = $('#item-'+id);
    var edit = $('li#edit-item-'+id);

    li.toggleClass('hidden');
    edit.empty();
    edit.toggleClass('hidden');
}