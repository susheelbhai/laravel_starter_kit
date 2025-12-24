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
$(".custom_img_input").change(function () {
  var preview_id = $(this).attr('data-prview_id');
    readURL(this, preview_id);
});
/* image Function end */


function getDeviceType() {
    const userAgent = navigator.userAgent || navigator.vendor || window.opera;
  
    // Check for iPhone/iPad/iOS
    if (/iPhone|iPad|iPod/i.test(userAgent)) {
      return "iOS";
    }
    // Check for Android
    if (/Android/i.test(userAgent)) {
      return "Android";
    }
    // Check for Windows
    if (/Windows/i.test(userAgent)) {
      return "Windows";
    }
    // Check for MacOS
    if (/Macintosh|Mac OS X/i.test(userAgent)) {
      return "MacOS";
    }
    // Check for Linux
    if (/Linux/i.test(userAgent) && !/Android/i.test(userAgent)) {
      return "Linux";
    }
  
    return "Unknown Device";
  }

  function openCamFile(name, media) {
    if (media == 'cam') {
        document.getElementById(name).setAttribute('capture', 'environment');
        document.getElementById(name).click();
    }
    if (media == 'file') {
        document.getElementById(name).removeAttribute('capture');
        document.getElementById(name).click();
    }
    
}