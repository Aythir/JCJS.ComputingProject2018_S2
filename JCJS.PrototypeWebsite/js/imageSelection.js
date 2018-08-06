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
          
        }
    

});
