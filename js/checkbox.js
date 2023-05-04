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

$(document).off('click').on('click', '.ok-btn', function () {
    let selectedRows = [];
    $('.select-checkbox:checked').each(function () {
        selectedRows.push($(this).val());
    });
    if ($('.select-checkbox:checked').length === 0 && $('.option').val() !== '') {
        alert('Please pick at least one user');

    } else if ($('.select-checkbox:checked').length !== 0 && $('.sel-1').val() === '' && $('.sel-2').val() === '') {
        alert('Please choose the option');
        console.log($('.sel-2').val())
    } else if ($('.sel-1').val() !== '' && $('.sel-2').val() !== '') {
        if ($('.sel-1').val() !== $('.sel-2').val()) {
            $('.option').val('')
            return
        }
    } else if ($('.sel-1').val() === 'set-active' || $('.sel-2').val() === 'set-active') {
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

    } else if ($('.sel-1').val() === 'set-not-active' || $('.sel-2').val() === 'set-not-active') {
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
    } else if (($('.sel-1').val() === 'set-delete' || $('.sel-2').val() === 'set-delete') && selectedRows.length !== 0) {
        if (confirm("CONFIRM DELETE")) {
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
    }
})
;
