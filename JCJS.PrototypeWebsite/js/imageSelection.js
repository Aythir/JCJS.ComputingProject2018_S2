$(function img_selection() {
    $("#gallery > img").click(function img_selection() {
        $(this).toggleClass("selected");
    });
    $("#reset").click( function img_selection() {
        $("input").val("");
        $("img.selected").removeClass("selected");
    });
    $("#create").click(function img_selection() {
        var txt = "Have all desired images been selected?";
        var conf = confirm(txt);
        if (!conf) return false;


        if ($("img.selected").length < 3) {
            alert("Select at least 3 images");
            return false;
        }
        else {
            alert("An error has occured.");
        }
    
    });
});