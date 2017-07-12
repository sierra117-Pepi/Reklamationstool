/**
 * 
 */
window.onload = function () {
    var claimButton = document.getElementById("claimButton").addEventListener("click", getTask);
    var claimButton = document.getElementById("claimButton1").addEventListener("click", getTask1);
    var claimButton = document.getElementById("claimButton2").addEventListener("click", getTask2);
    var claimButton = document.getElementById("claimButton3").addEventListener("click", getTask3);
};

function getTask() {
    document.getElementById("claimWorker").innerHTML = "Mitarbeiter1";
}

function getTask1() {
    document.getElementById("claimWorker1").innerHTML = "Mitarbeiter1";
}

function getTask2() {
    document.getElementById("claimWorker2").innerHTML = "Mitarbeiter1";
}

function getTask3() {
    document.getElementById("claimWorker3").innerHTML = "Mitarbeiter1";
}
