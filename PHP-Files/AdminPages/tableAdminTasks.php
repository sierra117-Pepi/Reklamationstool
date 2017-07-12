<?php
    $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
    if(mysqli_connect_errno()){
        header("Location:../ErrorPages/dbConnectionError.php");
        exit();
    } else {
        $queryComplaints = "SELECT nr, type FROM complaints WHERE employee != '';";
        $stmtComplaints = mysqli_prepare($con,$queryComplaints);
        if(!mysqli_stmt_execute($stmtComplaints)){
            die('Error: ' . mysqli_error($con));
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            mysqli_stmt_bind_result($stmtComplaints, $nr, $type);
            echo('<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>    
                                    <th>Lieferschein Nr.</th>
                                    <th>Art</th>
                                    <th>Nachrichten</th>
                                    <th>Details</th>
                                </thead>
                                <tbody>');
            while(mysqli_stmt_fetch($stmtComplaints)){
                echo('<tr>
                            <td width>'.$nr.'</td>
                            <td>'.$type.'</td>
                            <td class="center">
                                <button type="button" id="'.$nr.'" class="btn btn-success btn-circle" data-toggle="modal" data-target="#myModal" onclick="fillChatInfoForModal(this.id)"><i class="fa fa-comments"></i>
                            </td>
                            <td>
                                <button type="button" id="'.$nr.'"class="btn btn-info btn-circle" onclick="openInfoWindow(this.id)"><i class="fa fa-info"></i>
                            </td>
				        </tr>');
            }
            echo('</tbody></table>');
        }
    }
?>

    <script type="text/javascript">
        function fillChatInfoForModal(complaintNr) {
            localStorage.setItem("complaintNr", complaintNr);
            $.ajax({
                url: 'functions.php',
                type: 'POST',
                data: {
                    complaintNr: complaintNr,
                    function: 3
                },
                success: function(response) {
                    var ul_chat = document.getElementById("chat-div");

                    if (ul_chat.childNodes.length > 0) {
                        ul_chat.innerHTML = "";
                    }

                    var messages = JSON.parse(response);
                    for (var d in messages) {
                        var li = document.createElement("li");
                        if (messages[d][5]) {
                            li.setAttribute("class", "right clearfix");
                            li.innerHTML = '<span class="chat-img pull-right"><img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle"/></span> <div class="chat-body clearfix"><div class="header"><small class=" text-muted"><i class="fa fa-clock-o fa-fw"></i> Vor 14 Minuten </small> <strong class="pull-right primary-font">' + messages[d][0] + '</strong></div><p>' + messages[d][2] + '</p></div>'
                            ul_chat.appendChild(li);
                        } else if (messages[d][5] !== undefined) {
                            li.setAttribute("class", "left clearfix");
                            li.innerHTML = ' <span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle"/></span><div class="chat-body clearfix"><div class="header"><strong class="primary-font">' +
                                messages[d][0] +
                                '</strong> <small class="pull-right text-muted"><i class="fa fa-clock-o fa-fw"></i> Vor 15 Minuten</small></div><p>' +
                                messages[d][2] +
                                '</div>'
                            ul_chat.appendChild(li);
                        }
                    }
                }
            });
        }


        function openInfoWindow(nr) {
            alert(nr);
        }

        function addMessageToChat() {

            $.ajax({
                url: 'functions.php',
                type: 'POST',
                data: {
                    complaintNr: localStorage.getItem("complaintNr"),
                    content: document.getElementById("message").value,
                    function: 4
                },
                success: function(response) {
                    fillChatInfoForModal(localStorage.getItem("complaintNr"));
                }
            });
        }

    </script>
