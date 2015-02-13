$('input[type=file]').on('change', function (event) {
    uploadFiles(event, 'changed');
});
function uploadFiles(event, etype) {
    event.stopPropagation(); // Stop stuff happening
    event.preventDefault(); // Totally stop stuff happening
    $('#draglabel').hide();
    $('#profileImage').hide();
    $('#uploadprogress').removeClass('hide');
    if (etype === 'changed') {
        files = event.target.files;
    } else if (etype === 'dragged') {
        files = event.originalEvent.dataTransfer.files;
    }
    var data = new FormData();
    $.each(files, function (key, value) {
        data.append(key, value);
    });
    $.ajax({
        url: 'ajaximageupload.php',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function (data) {
            cropinit(data.url);
            canvasElement = document.getElementById('panel');
            canvas.width = data.newDimention.newWidth;
            canvas.height = data.newDimention.newHeight;
            $('#cropimage').removeClass('hidden');
            $('#cropimage').slideDown();
            $('#imageurl').val(data.url);
            $('#uploadprogress').hide();
            $('.profileimagesection').find('br').remove();
        },
        error: function (errorThrown) {
            console.log('ERRORS: ' + errorThrown);
        }
    });
}
$('.dragzone').on('dragover', function (event) {
    event.preventDefault();
    event.stopPropagation();
});

$('.dragzone').on('dragleave', function (event) {
    event.preventDefault();
    event.stopPropagation();
});

$('.dragzone').on('drop', function (event) {
    event.preventDefault();
    event.stopPropagation();
    uploadFiles(event, 'dragged');
});
