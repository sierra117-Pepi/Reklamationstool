<?php  
    $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");

    if(mysqli_connect_errno()){
        header("Location:../ErrorPages/dbConnectionError.php");
        exit();
    } else {
        $con->set_charset("utf8");
        $queryComplaints = "SELECT nr, issued, type, description, employee FROM complaints ORDER BY employee ASC;";
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
                                <th>Mitarbeiterzuweisung löschen</th>
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
                                    <div class="dropdown">
                                        <button type="button" data-toggle="dropdown" class="btn btn-success btn-circle dropdown-toggle">
                                            <i class="fa fa-link"></i>
                                        </button>
                                        <ul class="dropdown-menu">');
                    dropdown($employee, $nr);
                    echo('          </ul>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" name="'.$nr.'" id="complaintBtn" value="'.$employee.'" class="btn btn-danger btn-circle" onclick="removeWorkerFromComplaint(this.value, this.name)">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>');
            }
            echo('</tbody></table>');
            mysqli_stmt_close($stmtComplaints);
        }
    }

    function dropdown($employee, $nr){
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/dbConnectionError.php");
            exit();
        } else {
            $con->set_charset("utf8");
            $queryWorkers = "SELECT name FROM users WHERE isWorker = true;";
            $stmtWorkers = mysqli_prepare($con,$queryWorkers);
            if(!mysqli_stmt_execute($stmtWorkers)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            } else {
                mysqli_stmt_bind_result($stmtWorkers, $name);
                while(mysqli_stmt_fetch($stmtWorkers)){
                    if($employee != $name){
                        echo('<li><a id="'.$name.'" name="'.$nr.'" href="#" onclick="addWorkerToTask(this.id, this.name);">'.$name.'</a></li>');
                    }
                }
            }
        }
    }
?>

<script type="text/javascript">
    function removeWorkerFromComplaint(employee, nr) {
        $.ajax({
            url: 'adminFunctions.php',
            type: 'POST',
            data: {
                employee: employee,
                nr: nr,
                function: 2
            },
            success: function(response) {
                window.location.reload();
            }
        });
    }

    function addWorkerToTask(name, complaint) {
        $.ajax({
            url: 'adminFunctions.php',
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
