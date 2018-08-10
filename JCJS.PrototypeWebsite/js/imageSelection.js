$(function img_selection() {
    $("#SelectPhotos").on('hide.bs.modal', function img_selection(){

    });
    $("#gallery > img").click(function img_selection() {
        $(this).toggleClass("selected");
    });
    $("#reset").click( function img_selection() {
        $("input").val("");
        $("img.selected").removeClass("selected");
    });
    $("#create").click(function img_selection() {
        var txt = $("#YesButton").click();
        });
        $("#SelectedPhotos").on('hide.bs.modal', function img_selection(){
            
        });
        var conf = confirm(txt);
        if (!conf) return false;

    
        if ($("img.selected").length > 5)  {
            $("#SelectPhotosError").on('hide.bs.modal', function img_selection(){

            });
            return false;
        }
        else {
            imageSubmission();
        }
    
    });
    
function imageSubmission() {
    
    $("").submit(function(e) { // form element 
        var formData = new FormData($("img.selected")[0]); // img.selected 
    
        $.ajax({
            url: "gallery.php", // URL for the data to be sent too.
            type: "POST", // Type of request.
            data: formData, // Data for the server to process 
            async: false,
            success: function (msg) {
                alert(msg['Success!'])
            },
            cache: false,
            contentType: false,
            processData: false
        });
    
        e.preventDefault();
    });
}