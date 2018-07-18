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


        if ($("img.selected").length < 2) {
            alert("Select at least 2 images");
            return false;
        }
        else if  ($("img.selected").length > 5) {
            alert("You have selected too many images! Only a maximum of 5 can be turned into a GIF");
            return false;
        }
        else {
            alert("An error has occured.");
        }
    
    });
});