$('.sm-box').delay(3000).slideUp();
$(document).ready(function () {
    $('#summernote').summernote();
});


$(".delete_btn").on("click", function () {
    if (confirm("are you sure you want to delete this post?")) {

    } else {
        return false;
    }
});