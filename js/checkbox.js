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
})
;

$(document).off('click').on('click', '.ok-btn', function () {
    const numChecked = $('.select-checkbox:checked')
    const sel1 = $('.sel-1').val()
    const sel2 = $('.sel-2').val()
    let selectedRows = numChecked.map(function () {
        return $(this).val();
    }).get();

    if (numChecked.length === 0 && (sel1 !== '' || sel2 !== '')) {
        alert('Please pick at least one user');

    } else if (numChecked.length !== 0 && sel1 === '' && sel2 === '') {
        alert('Please choose the option');

    } else if (sel1 !== sel2 && (sel1 !== '' && sel2 !== '')) {
        if (sel1 !== sel2) {
            $('.option').val('')
        }
    } else if (sel1 === 'set-active' || sel2 === 'set-active') {
        $.ajax({
            url: "forms/setUser.php",
            type: "post",
            data: {
                setActive: selectedRows
            },
            success: function (data, status) {
                displayData();
                let active = JSON.parse(data)
                switch (active.response) {
                    case 200: {
                        console.log({
                                status: true, error: null, selectedId: selectedRows, action: 'set-active'
                            }
                        );
                        break;
                    }
                    case 500: {
                        console.log({
                            status: false, error: {
                                code: 500, message: 'Internal Server Error'
                            }
                        })
                    }
                }
            },
            error: function (data, status) {
                console.log({
                    status: false, error: {
                        code: 404, message: 'Not Found SetUser form'
                    }
                })
            }
        })

    } else if (sel1 === 'set-not-active' || sel2 === 'set-not-active') {
        $.ajax({
            url: "forms/setUser.php",
            type: "post",
            data: {
                setNotActive: selectedRows
            },
            success: function (data, status) {
                displayData();
                let notActive = JSON.parse(data)
                switch (notActive.response) {
                    case 200: {
                        console.log({
                                status: true, error: null, selectedId: selectedRows, action: 'set-not-active'
                            }
                        );
                        break;
                    }
                    case 500: {
                        console.log({
                            status: false, error: {
                                code: 500, message: 'Internal Server Error'
                            }
                        })
                    }
                }
            },
            error: function (data, status) {
                console.log({
                    status: false, error: {
                        code: 404, message: 'Not Found SetUser form'
                    }
                })
            }
        })

    } else if ((sel1 === 'set-delete' || sel2 === 'set-delete')) {
        if (confirm("CONFIRM DELETE")) {
            $.ajax({
                url: "forms/setUser.php",
                type: "post",
                data: {
                    setDelete: selectedRows
                },
                success: function (data, status) {
                    displayData();
                    let setDelete = JSON.parse(data)
                    switch (setDelete.response) {
                        case 200: {
                            console.log({
                                    status: true, error: null, selectedId: selectedRows, action: 'set-delete'
                                }
                            );
                            break;
                        }
                        case 500: {
                            console.log({
                                status: false, error: {
                                    code: 500, message: 'Internal Server Error'
                                }
                            })
                        }
                    }
                },
                error: function (data, status) {
                    console.log({
                        status: false, error: {
                            code: 404, message: 'Not Found Delete form'
                        }
                    })
                }
            })
        }
    }
})
;
