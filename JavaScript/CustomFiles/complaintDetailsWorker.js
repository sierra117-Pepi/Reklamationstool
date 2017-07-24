window.onload = function () {
    setDatetimepickers();
    var complaint = localStorage.getItem("complaintNr");
    $.ajax({
        url: 'complaintDetailsExtractWorker.php',
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

function updateInformationForComplaint() {
    var complaint = document.getElementById("complaintNr").value;
    var status = document.getElementById("status").value;
    var issued = document.getElementById("issued").value;
    var taken = document.getElementById("taken").value;
    var rs = document.getElementById("reasonSchachinger").value;
    var ms = document.getElementById("measureSchachinger").value;
    var ma = document.getElementById("measureAvoid").value;
    $.ajax({
        url: 'workerFunctions.php',
        type: 'POST',
        data: {
            function: 4,
            complaintNr: complaint,
            status: status,
            issued: issued,
            taken: taken,
            reasonSchachinger: rs,
            measureSchachinger: ms,
            measureAvoid: ma

        },
        success: function (response) {
            window.location.reload();
        }
    });
}

function fillInfoForCompalint(information) {
    document.getElementById("complaintNr").value = information["nr"];
    document.getElementById("name").innerHTML = information["name"] + "<br><br>" + information["details"] + "<br><br>";
    document.getElementById("client").innerHTML = "Dieser Auftrag wurde von <strong>" + information["customer"] + " </strong>beantragt. <br><br><br>"
    document.getElementById("employee").innerHTML = "Dieser Auftrag wird von <strong>" + information["employee"] + " </strong>bearbeitet. <br><br><br>";
    document.getElementById("status").options.selectedIndex = getIndexStatus(information["status"]);
    document.getElementById("type").value = information["type"];
    document.getElementById("details").value = information["description"];
    document.getElementById("issued").value = information["issued"];
    document.getElementById("taken").value = information["take"];
    document.getElementById("reasonSchachinger").options.selectedIndex = getIndexRS(information['reasonSchachinger']);
    document.getElementById("measureSchachinger").options.selectedIndex = getIndexMS(information['measureSchachinger']);
    document.getElementById("measureAvoid").value = information['measureAvoid'];
}

function getIndexStatus(status) {
    switch (status) {
        case "Offen":
            return 0;
        case "In Bearbeitung Offen":
            return 1;
        case "Abgeschlossen - Berechtigt":
            return 2;
        case "Abgeschlossen - Unberechtigt":
            return 3;
    }
}

function getIndexRS(reason) {
    switch (reason) {
        case "keine Auswahl":
            return 0;
        case "Reklamation unberechtigt":
            return 1;
        case "Reklamation berechtigt":
            return 2;
    }
}

function getIndexMS(reason) {
    switch (reason) {
        case "keine Auswahl":
            return 0;
        case "Keine Aktion":
            return 1;
        case "Nachlieferung":
            return 2;
        case "Abholung":
            return 3;
        case "Anderes":
            return 4;
    }
}
