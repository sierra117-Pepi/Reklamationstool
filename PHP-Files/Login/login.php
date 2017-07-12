<?
session_start();
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["email"]) && isset($_GET["pwd"])) {
        $email = htmlspecialchars($_GET['email']);
        $pwd = htmlspecialchars($_GET["pwd"]);
        if(isUserInputCorrect($email, $pwd)){
            if($_SESSION['isWorker'] == 0 && $_SESSION['isAdmin'] == 0){
                header("Location:../UserPages/dashboardUser.php");
                exit();
            } else if($_SESSION['isWorker'] == 1 && $_SESSION['isAdmin'] == 0){
                header("Location:../WorkerPages/dashboardWorker.php");
                exit();
            } else {
                header("Location:../AdminPages/dashboardAdmin.php");
                exit();
            }
        } else {
            header("Location:../ErrorPages/userNotFound.php");
            exit();
        }
    }
}

function isUserInputCorrect($email, $pwd){
    if(empty($email) || empty($pwd)){
        return false;
    } else {
        $con = mysqli_connect("localhost", "Petko", "petko", "legrandDB");
        
        if(mysqli_connect_errno()){
            header("Location:../ErrorPages/DBConnectionError.php");
            exit();
        } else {
            $query = "SELECT id, name, email, password, isWorker, isAdmin FROM users WHERE email=? AND password=?;";
            $stmt = mysqli_prepare($con,$query);
            mysqli_stmt_bind_param($stmt,"ss",$email,$pwd);
            if(!mysqli_stmt_execute($stmt)){
                die('Error: ' . mysqli_error($con));
                header("Location:../ErrorPages/dbConnectionError.php");
                exit();
            } else {
                mysqli_stmt_bind_result($stmt, $id, $name, $mail, $password, $isWorker, $isAdmin);
                $found = false;
                while(mysqli_stmt_fetch($stmt)){
                    $_SESSION['userID'] = $id;
                    $_SESSION['userName'] = $name;
                    $_SESSION['email'] = $mail;
                    $_SESSION['password'] = $password;    
                    $_SESSION['isWorker'] = $isWorker;
                    $_SESSION['isAdmin'] = $isAdmin;
                    $found = true;
                }
                mysqli_stmt_close($stmt);
                return $found;
            }  
        }
    }
}
?>
