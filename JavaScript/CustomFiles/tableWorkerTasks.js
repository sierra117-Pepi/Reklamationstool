function fillChatInfoForModal(complaintNr) {
    $('#myModal').on('hidden.bs.modal', function () {
        location.reload();
    });
    localStorage.setItem("complaintNr", complaintNr);
    $.ajax({
        url: 'workerFunctions.php',
        type: 'POST',
        data: {
            complaintNr: complaintNr,
            function: 2
        },
        success: function (response) {
            var ul_chat = document.getElementById("chat-div");

            if (ul_chat.childNodes.length > 0) {
                ul_chat.innerHTML = "";
            }

            document.getElementById("message").value = "";
            var messages = JSON.parse(response);
            document.getElementById("myModalLabel").innerHTML = "Kommunikationsverlauf für Reklamation " + complaintNr;
            for (var d in messages) {
                var li = document.createElement("li");
                var timeDiff = calculateDifference(messages[d][4]);
                if (messages[d][5]) {
                    li.setAttribute("class", "right clearfix");
                    li.innerHTML = '<div class="chat-body clearfix"><div class="header"><small class=" text-muted"><i class="fa fa-clock-o fa-fw"></i>' + timeDiff + ' </small> <strong class="pull-right primary-font">' + messages[d][0] + '</strong></div><p>' + messages[d][2] + '</p></div>'
                    ul_chat.appendChild(li);
                } else if (messages[d][5] !== undefined) {
                    li.setAttribute("class", "left clearfix");
                    li.innerHTML = '<div class="chat-body clearfix"><div class="header"><strong class="primary-font">' +
                        messages[d][0] +
                        '</strong> <small class="pull-right text-muted"><i class="fa fa-clock-o fa-fw"></i>' + timeDiff + '</small></div><p>' +
                        messages[d][2] +
                        '</div>'
                    ul_chat.appendChild(li);
                }
            }
        }
    });
}

function calculateDifference(timeSend) {
    var date = new Date();
    var messageDate = new Date(timeSend);

    var seconds = (date.getTime() - messageDate.getTime()) / 1000;
    var days = Math.floor(seconds / (3600 * 24));
    var hrs = Math.floor(seconds / 3600);
    var mnts = Math.floor((seconds - (hrs * 3600)) / 60);
    var secs = seconds - (hrs * 3600) - (mnts * 60);

    if (days > 0) {
        return days + " Tage";
    } else if (hrs > 0) {
        return hrs + " Stunden";
    } else if (mnts > 0) {
        return mnts + " Minuten";
    } else {
        return secs.toFixed(0) + " Sekunden";
    }
}

function openInfoWindow(nr) {
    localStorage.setItem("complaintNr", nr);
    window.location.href = "complaintDetailsWorker.php";
}

function addMessageToChat() {
    $('#myModal').on('hidden.bs.modal', function () {
        location.reload();
    });
    var timezone = jstz.determine();
    $.ajax({
        url: 'workerFunctions.php',
        type: 'POST',
        data: {
            complaintNr: localStorage.getItem("complaintNr"),
            content: document.getElementById("message").value,
            timeZone: timezone.name,
            function: 3
        },
        success: function (response) {
            fillChatInfoForModal(localStorage.getItem("complaintNr"));
        }
    });
}

function savePDF() {
    var doc = new jsPDF();
    doc.fromHTML($('#content').html(), 15, 15, {
        'width': 500,
    });
    doc.save('Nachrichten.pdf');
}
