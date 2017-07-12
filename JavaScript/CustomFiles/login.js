var user = {
    name: "testUser",
    email: "test@user.com",
    password: "testuser"
};
var worker = {
    name: "testWorker",
    email: "test@worker.com",
    password: "testworker"
};
var admin = {
    name: "testAdmin",
    email: "test@admin.com",
    password: "testadmin"
};

window.onload = function () {
    addActionListeners();
}

function addActionListeners() {
    var loginButton = document.getElementById("loginButton").addEventListener("click", function () {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;

        if (user.email === email && user.password === password) {
            window.location.href = "../HTML/UserSites/indexUser.html";
        } else if (worker.email === email && worker.password === password) {
            window.location.href = "../HTML/WorkerSites/indexWorker.html";
        } else if (admin.email === email && admin.password === password) {
            window.location.href = "../HTML/AdminSites/indexAdmin.html";
        } else {
            alert("Invalid data!");
        }
    });
}
