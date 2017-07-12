window.onload = function () {
    var claimButton = document.getElementById("retButton").addEventListener("click", sendRetoure);
};

function sendRetoure() {
    localStorage.setItem("art", document.getElementById("reklamation").value);
    window.location.href = "../../HTML/UserSites/messagesUser.html";
}
