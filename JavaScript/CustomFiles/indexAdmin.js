/**
 * 
 */
window.onload = function () {

    document.getElementById("remWorkerButton").addEventListener("click", remWorker);
    document.getElementById("remWorkerButton1").addEventListener("click", remWorker1);
    document.getElementById("remWorkerButton2").addEventListener("click", remWorker2);
    document.getElementById("remWorkerButton3").addEventListener("click", remWorker3);

    document.getElementById("addWorker").addEventListener("click", addWorker);
    document.getElementById("addWorker1").addEventListener("click", addWorker1);
    document.getElementById("addWorker2").addEventListener("click", addWorker2);
    document.getElementById("addWorker3").addEventListener("click", addWorker3);
}

function remWorker() {
    document.getElementById("worker").innerHTML = "";
}

function remWorker1() {
    document.getElementById("worker1").innerHTML = "";
}

function remWorker2() {
    document.getElementById("worker2").innerHTML = "";
}

function remWorker3() {
    document.getElementById("worker3").innerHTML = "";
}

function addWorker() {
    document.getElementById("worker").innerHTML = "MitarbeiterTest";
}

function addWorker1() {
    document.getElementById("worker1").innerHTML = "MitarbeiterTest";
}

function addWorker2() {
    document.getElementById("worker2").innerHTML = "MitarbeiterTest";
}

function addWorker3() {
    document.getElementById("worker3").innerHTML = "MitarbeiterTest";
}
