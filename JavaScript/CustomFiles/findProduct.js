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
                if (response == "") {
                    //TODO create a response for already defined case
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
        //TODO create a error response
    }
}
