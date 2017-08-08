window.onload = function extractProductInfo() {
    document.getElementById("name").innerHTML = localStorage.getItem("productname") + "<br><br>" + localStorage.getItem("productdetails")
    document.getElementById("complaintNr").value = localStorage.getItem("productnr");
}

function createCase() {
    var type = document.getElementById("type").value;
    var details = document.getElementById("details").value;
    $.ajax({
        url: 'userFunctions.php',
        type: 'POST',
        data: {
            productNr: localStorage.getItem("productnr"),
            type: type,
            details: details,
            date: new Date(),
            function: 3
        },
        success: function (response) {
            window.location.href = "../../PHP-Files/UserPages/dashboardUser.php";
        }
    });
}
