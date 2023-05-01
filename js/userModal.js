function adduser() {
    let nameAdd = $('#first_name').val()
    let surnameAdd = $('#last_name').val()
    let statusAdd = $('#status').val()
    let roleAdd = $('#role').val()

    $.ajax({
        url: "forms/addUser.php",
        type: "post",
        data: {
            first_name: nameAdd,
            last_name: surnameAdd,
            status: statusAdd,
            role: roleAdd,
        },
        success: function (data, status) {
            // console.log(status)
            displayData();
        },
        error: function (data, status) {
            console.log(status)
        }
    });

}
$(document).ready(function (){
    displayData();
});
function displayData(){
    let displayData = "true"
    $.ajax({
        url:"forms/display.php",
        type: "post",
        data: {
            displaySend: displayData
        },
        success:function (data,status){
$('#displayDataTable').html(data)
        }
    });
}