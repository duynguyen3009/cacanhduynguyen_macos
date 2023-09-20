$('select[name="search[sort]"]').change(function (e) { 
    $('#searchForm').submit();
  });

$('.transform-search').click(function() {
    $('form#searchForm').attr('action', $(this).data('href')).submit();
})

$('a.page-link').click(function () { 
    var page = $(this).data('page');
    $('form#searchForm input[name="page"]').val(page);
    $('form#searchForm').submit();
});

$('a[name=next-page]').click(function() {
    var page = $(this).data('page');
    $('form#searchForm input[name="page"]').val(page);
    $('form#searchForm').submit();
});

function previewImage() {
    var previewImg  = $('#preview-image');
    var file        = event.target.files[0];
    var fileName    = file.name;
    var extension   = fileName.substring(fileName.lastIndexOf('.')+1).toLowerCase();

    const extensions  = ["jpeg", "jpg", "png"];
    isExtAccept       = extensions.includes(extension);
    if (!(isExtAccept)) {
        $(previewImg).empty();
        $(previewImg).html("<span class='text-danger'>Định dạng không hợp lệ </span>");
      } else {
            if (typeof(FileReader) != 'undefined') {
                previewImg.empty();
                var reader = new FileReader();
                reader.onload = function(e){
                    $('<img/>',{'src':e.target.result,  'style':'max-width:100%;'}).appendTo(previewImg);
                }
                previewImg.show();
                reader.readAsDataURL(file);
            } else {
                $(previewImg).html("<span class='text-danger'>Định dạng không hợp lệ </span>");
            }
      }
}

function updateStatus(el) {
    var dataSend = {
        id      : $(el).data('id'),
        status  : $(el).is(':checked'),
    };
    $.ajax({
        type: "POST",
        url: $(el).data('href'),
        data: dataSend,
        success: function (res) {
        if (res.success) {
            $(el).notify(res.msg, { 
                                className: 'success',
                            }
            );
        }
        }
    });
}

function updateSequence(el) {
    var dataSend = {
        id      : $(el).data('id'),
        sequence  : $(el).val(),
    };
    $.ajax({
        type: "POST",
        url: $(el).data('href'),
        data: dataSend,
        success: function (res) {
        if (res.success) {
            $(el).notify(res.msg, { 
                                className: 'success',
                            }
            );
        }
        }
    });
}

function deleteData(el) {
    var name = $(el).data('name');
    swal({
        title: `Bạn đang chọn và muốn xóa ${name} ?`,
        // text: "Các id sau: ",
        icon: "warning",
        buttons: ["Hủy", "Chấp nhận xóa"],
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            var url = $(el).data('href');
            var dataSend = {
                    id: $(el).data('id')
            };
            $.ajax({
                type: "POST",
                url: url,
                data: dataSend,
                success: function (res) {
                    if (res.success) {
                        $.notify(res.msg, {className: 'success',});
                        location.reload();
                    } else {
                        alert(res.msg);
                        return;
                    }
                }
            });
        } 
    });
}

function redirectForm(el, type) {
    var url = $(el).data('href');
    if (type == 'edit') {
        var id = $(el).data('id');
        $('form#searchForm').attr('action', url).submit();
    }
}