window.onload = function () {
    var art = localStorage.getItem("art");
    var auftrag = localStorage.getItem("auftrag");
    if (auftrag != undefined || auftrag != null) {
        changeAuftragType(auftrag, art);
        localStorage.removeItem("art");
        localStorage.removeItem("auftrag");
    }
    addActionListeners();
}

function addActionListeners() {
    //Define action for btn-chat
    document.getElementById("btn-chat").addEventListener("click", function () {
        var message = document.getElementById("btn-input").value;
        var chat = document.getElementById("chat-div");
        addMessage(chat, message);
    });
    $("#pdf").click(savePDF);
}

function addMessage(chat, message) {

    //Create the entry for the caht list
    var li = document.createElement("li");
    li.setAttribute("class", "left clearfix");
    var span = document.createElement("span");
    span.setAttribute("class", "chat-img pull-left");
    var img = document.createElement("img");
    img.setAttribute("class", "img-circle");
    img.setAttribute("alt", "User Avatar");
    img.setAttribute("src", "http://placehold.it/50/55C1E7/fff");
    var divBody = document.createElement("div");
    divBody.setAttribute("class", "chat-body clearfix");
    var divHeader = document.createElement("div");
    divHeader.setAttribute("class", "header");
    var strong = document.createElement("strong");
    strong.setAttribute("class", "primary-font");
    strong.appendChild(document.createTextNode("TestUser"));
    var small = document.createElement("small");
    small.setAttribute("class", "pull-right text-muted");
    var i = document.createElement("i");
    i.setAttribute("class", "fa fa-clock-o fa-fw");
    var p = document.createElement("p");
    p.appendChild(document.createTextNode(message));
    //End create the entry for the caht list

    //Appen child elements
    small.appendChild(i);
    small.appendChild(document.createTextNode(" Vor 1 Sekunde"));
    divHeader.appendChild(strong);
    divHeader.appendChild(small);
    divBody.appendChild(divHeader);
    divBody.appendChild(p);
    span.appendChild(img);
    li.appendChild(span);
    li.appendChild(divBody);
    chat.appendChild(li);
    //End append child elements
}

function changeAuftragType(auftrag, art) {
    switch (auftrag) {
        case 'Auftrag1':
            document.getElementById("Art1").innerHTML = art;
            break;
        case 'Auftrag2':
            document.getElementById("Art2").innerHTML = art;
            break;
        case 'Auftrag3':
            document.getElementById("Art3").innerHTML = art;
            break;
        case 'Auftrag4':
            document.getElementById("Art4").innerHTML = art;
            break;
    }
}

function changeColour(btn) {
    switch (btn) {
        case 'btn1':
            document.getElementById("btn1").setAttribute("class", "btn btn-success btn-circle");
            break;
        case 'btn2':
            document.getElementById("btn2").setAttribute("class", "btn btn-success btn-circle");
            break;
        case 'btn3':
            document.getElementById("btn3").setAttribute("class", "btn btn-success btn-circle");
            break;
        case 'btn4':
            document.getElementById("btn4").setAttribute("class", "btn btn-success btn-circle");
            break;

    }
}

function savePDF() {
    // parse the HTML table element having an id=exportTable
    var dataSource = shield.DataSource.create({
        data: "#dataTables-example",
        schema: {
            type: "table",
            fields: {
                Reklamationsnummer: {
                    type: String
                },
                Beschreibung: {
                    type: String
                },
                Status: {
                    type: String
                },
                Datum: {
                    type: String
                },
                Zeit: {
                    type: String
                }
            }
        }
    });

    // when parsing is done, export the data to PDF
    dataSource.read().then(function (data) {
        var pdf = new shield.exp.PDFDocument({
            author: "PrepBootstrap",
            created: new Date()
        });

        pdf.addPage("a4", "portrait");

        pdf.table(
            50,
            50,
            data, [
                {
                    field: "Reklamationsnummer",
                    title: "Reklamationsnummer",
                    width: 100
                    },
                {
                    field: "Beschreibung",
                    title: "Beschreibung Name",
                    width: 100
                    },
                {
                    field: "Datum",
                    title: "Datum",
                    width: 100
                    },
                {
                    field: "Zeit",
                    title: "Zeit",
                    width: 100
                    },
                {
                    field: "Status",
                    title: "Status",
                    width: 100,
                    }
                    ], {
                margins: {
                    top: 50,
                    left: 50
                }
            }
        );

        pdf.saveAs({
            fileName: "Reklamation.pdf"
        });
    });
}

//Define PDF action
var pdf = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

document.addEventListener("DOMContentLoaded", function (event) {
    document.getElementById('pdf1').onclick = function () {

        var options = {
            background: "#FFFFFF"
        };
        //pdf.addHTML (element, x, y, options, callback );
        pdf.addHTML(document.getElementById('column1'), 15, 15, options, function () {
            pdf.save('Reklamation.pdf');
        });
    };
});

document.addEventListener("DOMContentLoaded", function (event) {
    document.getElementById('pdf2').onclick = function () {

        var options = {
            background: "#FFFFFF"
        };
        //pdf.addHTML (element, x, y, options, callback );
        pdf.addHTML(document.getElementById('column2'), 15, 15, options, function () {
            pdf.save('Reklamation.pdf');
        });
    };
});

document.addEventListener("DOMContentLoaded", function (event) {
    document.getElementById('pdf3').onclick = function () {

        var options = {
            background: "#FFFFFF"
        };
        //pdf.addHTML (element, x, y, options, callback );
        pdf.addHTML(document.getElementById('column3'), 15, 15, options, function () {
            pdf.save('Reklamation.pdf');
        });
    };
});

document.addEventListener("DOMContentLoaded", function (event) {
    document.getElementById('pdf4').onclick = function () {

        var options = {
            background: "#FFFFFF"
        };
        //pdf.addHTML (element, x, y, options, callback );
        pdf.addHTML(document.getElementById('column4'), 15, 15, options, function () {
            pdf.save('Reklamation.pdf');
        });
    };
});
