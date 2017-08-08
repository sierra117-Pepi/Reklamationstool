window.onload = function () {
    setDatetimepickers();
    var complaint = localStorage.getItem("complaintNr");
    $.ajax({
        url: 'complaintInfoExtract.php',
        type: 'POST',
        data: {
            complaintNr: complaint
        },
        success: function (response) {
            fillInfoForCompalint(JSON.parse(response));
        }
    });
}

function setDatetimepickers() {
    $('#issuedCalendar').datetimepicker({
        format: "YYYY/MM/DD HH:mm:ss",
        showTodayButton: true,
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            next: "fa fa-forward",
            previous: "fa fa-backward",
            today: "fa fa-bullseye"
        }
    });
    $('#takeCalendar').datetimepicker({
        format: "YYYY/MM/DD HH:mm:ss",
        showTodayButton: true,
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            next: "fa fa-forward",
            previous: "fa fa-backward",
            today: "fa fa-bullseye"
        }
    });
}

function fillInfoForCompalint(information) {
    document.getElementById("complaintNr").value = information["nr"];
    document.getElementById("name").innerHTML = information["name"] + "<br><br>" + information["details"] + "<br><br>";
    document.getElementById("employee").innerHTML = "Dieser Auftrag wird von <strong>" + information["employee"] + " </strong>bearbeitet. <br><br><br>";
    document.getElementById("status").value = information["status"];
    document.getElementById("type").value = information["type"];
    document.getElementById("details").value = information["description"];
    document.getElementById("issued").value = information["issued"];
    document.getElementById("taken").value = information["take"];
}
