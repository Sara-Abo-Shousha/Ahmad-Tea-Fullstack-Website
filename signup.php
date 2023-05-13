
<?php
include("session.php");
if (!($mysqli = mysqli_connect("localhost", "root")))
{
    die("Could not connect");
}
if(!(mysqli_select_db($mysqli, "webproject")))
      die("Could not open");

$_SESSION["Email"]=$_POST["email"];
$password = !isset($_POST['psswrd']) ? NULL : $_POST['psswrd'];
$hashed_pass = password_hash($password, PASSWORD_DEFAULT);

if ($_POST["hidden"] == "UP")
{
    $query="SELECT * FROM users WHERE Email = '".
    $_POST["email"]."'";
    $result = mysqli_query($mysqli, $query);
    if (mysqli_num_rows($result)==0){
         $query1 = "INSERT INTO users (Email, Fname, Lname, Password, Type) VALUES ('".
         $_POST["email"]."','".$_POST["Fname"]."', '".$_POST['Lname']."', '".$hashed_pass."', '1')";
         if (!mysqli_query($mysqli, $query1)){

            echo 'Query error: ' . mysqli_error($mysqli);
            die();
          }
    }
    else
    {echo "email already exists";}
}

$fp=file("users.txt");
$check=0;
$password = !isset($_POST['psswrd']) ? NULL : $_POST['psswrd'];
$hashed_pass = password_hash($password, PASSWORD_DEFAULT);

if(isset($_POST['Fname']))
{
    foreach ($fp as $loopdata){

   
     $userslists = explode(", ", $loopdata);
      if($userslists[0] == $_POST['email']){
       
        echo "<p>Please go to the <a href='signlog.html'>SignIn</a> page</p>";
        $check++;
        break;
    }
}
if($check == 0){
    file_put_contents("users.txt",$_POST["email"].", ".$hashed_pass.", ".$_POST["Fname"].", ". $_POST["Lname"]."\n", FILE_APPEND);
    header("Location: Shop.html");
}
$check=0;
}

elseif(isset($_POST['email1'])){

foreach ($fp as $loopdata){
    $userlistss = explode(", ",$loopdata);
    if($userlistss[0] == $_POST['email1'] && password_verify($_POST['pass1'], $userlistss[1]) ) {

            header("Location: Shop.html");
            $check++;
            break;}
    }
    if($check == 0){
        echo "<p style='color:red;'><strong>Incorrect Info </p></strong>";
        echo "<p style='color:red;'><strong>Please;
        <a href='signlog.html'>sign in again</a> or <a href='signlog.html'>Sign up if you are a new user</a></p></strong>";
    }
}
?>
</html>
