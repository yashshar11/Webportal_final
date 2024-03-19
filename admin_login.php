<?php
session_start();
include "_dbconnect_admin.php";

if (isset($_POST['username']) && isset($_POST['password']))
{
    function validate($data)
    { 
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
$username = validate($_POST['username']);
$password = validate($_POST['password']);
 
// if(empty($username))
// {
//     header("Location: index.php?error=User Name is required");
//     exit();
// }
// else if(empty($password))
// {
//     header("Location: index.php?error=Password is required");
//     exit();
// }

$sql = "SELECT * FROM admin WHERE admin_ID='$username' AND password='$password'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['admin_ID'] === $username && $row['password'] === $password) {
        echo "Logged In!";
        $_SESSION['admin_ID'] = $row['admin_ID'];
        // $_SESSION['name'] = $row['name'];
        $_SESSION['admin_name'] = $row['admin_name'];
        $_SESSION['image_link'] = $row['image_link'];

        header("Location: admin_dashboard.php");
        exit();
    } else {
        
        echo("<script>alert('Incorrect User ID or Password!')</script>");
        echo("<script>window.location = 'index.html';</script>");
        
        // $alert="<script>alert('Incorrect Username or Password!');</script>";
        // echo $alert;
        // header("Location: index.html" );
        exit();
    }
} else {
    echo("<script>alert('Incorrect User ID or Password!')</script>");
    echo("<script>window.location = 'index.html';</script>");
    
    // $alert="<script>alert('Incorrect Username or Password!');</script>";
    // echo $alert;
    // header("Location: index.php");
    exit();
}
?>
