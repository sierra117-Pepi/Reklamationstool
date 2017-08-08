<?php 
    echo(
        '<ul class="dropdown-menu dropdown-user">
            <li>
                <a id="username">'.$_SESSION['userName'].'</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="../LogOut/logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
            </li>
        </ul>'
    );
?>
