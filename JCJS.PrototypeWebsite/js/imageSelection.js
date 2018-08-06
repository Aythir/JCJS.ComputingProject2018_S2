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

    
        if ($("img.selected").length < 3) {
            $("#SelectPhotosError").on('hide.bs.modal', function img_selection(){

            });
            return false;
        }
        else {
            $("").submit(function(e) {
                var formData = new FormData($("img.selected")[0]);
        
                $.ajax({
                    url: "", // URL for the data to be sent too.
                    type: "POST", // Type of request.
                    data: formData, // Data for the 
                    async: false,
                    success: function (msg) {
                        alert(msg)
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
        
                e.preventDefault();
            });
        }
    

});
