window.onload = function () {
    addActionListeners();
}

function addActionListeners() {
    var editButton = document.getElementById("editButton").addEventListener("click", function () {
        localStorage.setItem("auftrag", "Auftrag1");
        openWindowEditTask();
    });
    var editButton2 = document.getElementById("editButton2").addEventListener("click", function () {
        localStorage.setItem("auftrag", "Auftrag1");
        openWindowEditTask();
    });
    var editButton3 = document.getElementById("editButton3").addEventListener("click", function () {
        localStorage.setItem("auftrag", "Auftrag1");
        openWindowEditTask();
    });
    var editButton4 = document.getElementById("editButton4").addEventListener("click", function () {
        localStorage.setItem("auftrag", "Auftrag4");
        openWindowEditTask();
    });
}

function openWindowEditTask() {
    window.location.href = "editTask.html";
}
