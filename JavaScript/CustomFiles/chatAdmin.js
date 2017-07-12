$(document).ready(function() {
    var save = document.getElementById("cmd").addEventListener("click", savePDF);

});

function savePDF() {
    var doc = new jsPDF();
    doc.fromHTML($('#content').html(), 15, 15, {
        'width': 500,
    });
    doc.save('Nachrichten.pdf');

}





/*
var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function(element, renderer) {
        return true;
    }
};

$('#cmd').click(function() {
    doc.fromHTML($('#content').html(), 15, 15, {
        'width': 170,
        'elementHandlers': specialElementHandlers
    });
    doc.save('Nachrichten.pdf');
});
*/