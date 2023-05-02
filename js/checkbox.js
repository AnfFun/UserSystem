$(document).ready(function () {

    let allItems = $("#all-items");


    let itemCheckboxes = $(".custom-control-input");


    allItems.change(function () {
        if ($(this).prop("checked")) {
            itemCheckboxes.prop("checked", true);
        } else {
            itemCheckboxes.prop("checked", false);
        }
    });


    itemCheckboxes.change(function () {
        if (itemCheckboxes.filter(":checked").length === itemCheckboxes.length) {
            allItems.prop("checked", true);
        } else {
            allItems.prop("checked", false);
        }
    });
});
$(document).on('click', '#ok-btn', function () {
    let selectedRows = [];
    $('.select-checkbox:checked').each(function () {
        selectedRows.push($(this).val());
    });
    let optionSelected = $('#option').val();
    if (optionSelected === 'set-active') {
        $.ajax({
            url: "forms/edit.php",
            type: "post",
            data: {
                setActive: selectedRows
            },
            success: function (data, status) {
                displayData();
            }
        })

    } else if (optionSelected === 'set-not-active') {
        $.ajax({
            url: "forms/edit.php",
            type: "post",
            data: {
                setNotActive: selectedRows
            },
            success: function (data, status) {
                displayData();
            }
        })
    } else if (optionSelected === 'set-delete') {
        $.ajax({
            url: "forms/delete.php",
            type: "post",
            data: {
                setDelete: selectedRows
            },
            success: function (data, status) {
                displayData();
            }
        })
    }
});