/* image Function start */
function readURL(input, preview_id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#"+preview_id).css(
                "background-image",
                "url(" + e.target.result + ")"
            );
            $("#"+preview_id).hide();
            $("#"+preview_id).fadeIn(650);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
$(".imput_logo").change(function () {
  var preview_id = $(this).attr('data-prview_id');
    readURL(this, preview_id);
});
/* image Function end */