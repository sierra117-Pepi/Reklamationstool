function addMessageToChat() {
    var timezone = jstz.determine();
    $.ajax({
        url: 'userFunctions.php',
        type: 'POST',
        data: {
            complaintNr: document.getElementById("complaint").getAttribute("name"),
            content: document.getElementById("message").value,
            timeZone: timezone.name,
            function: 1
        },
        success: function (response) {
            window.location.reload();
        }
    });
}
