function notification(msg) {
    $("#alert").html(
        '<div id="warn" class="alert alert-danger alert-dismissible fade show" role="alert">' +
            msg +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
    );
    setTimeout(function() {
        $('#warn').fadeOut('slow');
    }, 2000); // <-- time in milliseconds
}