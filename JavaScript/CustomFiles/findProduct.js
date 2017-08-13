function findProduct() {
    var productNr = document.getElementById("productNr").value;
    if (productNr != null && productNr != undefined && productNr != "") {
        $.ajax({
            url: 'userFunctions.php',
            type: 'POST',
            data: {
                productNr: productNr,
                function: 2
            },
            success: function (response) {
                if (response === "[]") {
                    $.notify({
                        icon: "fa fa-info-circle",
                        message: "Es gibt kein Produkt mit der Produktnummer im System. Bitte überprüfen Sie die Nummer und versuchen Sie es nocheinmal!"
                    }, {
                        type: "danger",
                        timer: 4000,
                        placement: {
                            from: "right",
                            align: "right"
                        }
                    });
                } else if (response === "false") {
                    $.notify({
                        icon: "fa fa-info-circle",
                        message: "Für diese Produktnummer wurde bereits eine Reklamation definiert."
                    }, {
                        type: "warning",
                        timer: 4000,
                        placement: {
                            from: "center",
                            align: "right"
                        }
                    });
                } else {
                    var productInfo = JSON.parse(response);
                    localStorage.setItem("productnr", productInfo['productNr']);
                    localStorage.setItem("productname", productInfo['productName']);
                    localStorage.setItem("productdetails", productInfo['productDetails']);
                    window.location.href = "../../PHP-Files/UserPages/createNewReturn.php";
                }
            }
        });
    } else {
        $.notify({
            icon: "fa fa-ban",
            message: "Es wurde keine Produktnummer für die Suche definiert!"
        }, {
            type: "danger",
            timer: 4000,
            placement: {
                from: "right",
                align: "right"
            }
        });
    }
}
