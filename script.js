$(document).ready(function(){

    let allItems = $("#all-items");


    let itemCheckboxes = $(".custom-control-input");


    allItems.change(function(){
        if($(this).prop("checked")){
            itemCheckboxes.prop("checked", true);
        } else {
            itemCheckboxes.prop("checked", false);
        }
    });


    itemCheckboxes.change(function(){
        if(itemCheckboxes.filter(":checked").length === itemCheckboxes.length){
            allItems.prop("checked", true);
        } else {
            allItems.prop("checked", false);
        }
    });
});