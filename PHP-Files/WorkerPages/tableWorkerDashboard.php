<?php  
    $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");

    if(mysqli_connect_errno()){
        header("Location:../ErrorPages/dbConnectionError.php");
        exit();
    } else {
        $con->set_charset("utf8");
        $queryComplaints = "SELECT nr, issued, type, description, employee FROM complaints WHERE employee='' ORDER BY employee ASC;";
        $stmtComplaints = mysqli_prepare($con,$queryComplaints);
        if(!mysqli_stmt_execute($stmtComplaints)){
            die('Error: ' . mysqli_error($con));
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            mysqli_stmt_bind_result($stmtComplaints, $nr, $issued, $type, $description, $employee);
            echo('<table id="tasks" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Auftrag</th>
                                <th>Datum</th>
                                <th>Beschreibung</th>
                                <th>Bearbeitet von</th>
                                <th>Mitarbeiter zuweisen</th>
                        </tr>
                        </thead>
                        <tbody>');
            while(mysqli_stmt_fetch($stmtComplaints)){
                    echo('<tr>
                                <td>'.$nr.'</td>
                                <td>'.$issued.'</td>
                                <td>'.$type.'
                                <button type="button" class="btn btn-info btn-circle" data-container="body" data-toggle="popover" data-         placement="top" data-content="'.$description.'.">
                                    <i class="fa fa-list"></i>
                                </button>
                                </td>
                                <td id="worker">'.$employee.'</td>
                                <td>
                                    <button type="button" id="'.$_SESSION["userName"].'" name="'.$nr.'"onclick="addWorkerToTask(this.id, this.name)" class="btn btn-success btn-circle">
                                        <i class="fa fa-link"></i>
                                    </button>
                                </td>
                            </tr>');
            }
            echo('</tbody></table>');
            mysqli_stmt_close($stmtComplaints);
        }
    }
?>

<script type="text/javascript">
    function addWorkerToTask(name, complaint) {
        $.ajax({
            url: 'workerFunctions.php',
            type: 'POST',
            data: {
                employee: name,
                complaintNr: complaint,
                function: 1
            },
            success: function(response) {
                window.location.reload();
            }
        });
    }

</script>
