<?php
include("session.php");
if (!($mysqli = mysqli_connect("localhost", "root"))) {
    die("Could not connect");
}
if (!(mysqli_select_db($mysqli, "webproject")))
    die("Could not open");

$_SESSION["Email"] = !isset($_POST['email']) ? NULL : $_POST['email'];
$_SESSION["Password"] = NULL;
$password = !isset($_POST['psswrd']) ? NULL : $_POST['psswrd'];
$hashed_pass = password_hash($password, PASSWORD_DEFAULT);
if (isset($_POST["hidden"])) {
    if ($_POST["hidden"] == "UP") {
        $query = "SELECT * FROM users WHERE Email = '" .
            $_POST["email"] . "'";
        $result = mysqli_query($mysqli, $query);
        if (mysqli_num_rows($result) == 0) {
            
                $query1 = "INSERT INTO users (Email, Fname, Lname, Password, Type) VALUES ('" .
                    $_POST["email"] . "','" . $_POST["Fname"] . "', '" . $_POST['Lname'] . "', '" . $hashed_pass . "', '1')";
                if (!mysqli_query($mysqli, $query1)) {

                    echo 'Query error: ' . mysqli_error($mysqli);
                    die();
                }
                $_SESSION["Password"] = $hashed_pass;
                header("Location: Index.php");
            
        } else {
            $message = "*email already exists";
        }
    }
    if ($_POST["hidden"] == "IN") {
        $query2 = "SELECT Email, Password FROM users WHERE Email = '" .
            $_POST["email"] . "'";
        if (!mysqli_query($mysqli, $query2)) {

            $message2 = "incorrect email";
        }
        $result1 = mysqli_query($mysqli, $query2);
        $row = mysqli_fetch_assoc($result1);

        if (password_verify($_POST['psswrd'], $row['Password'])) {
            $_SESSION["Email"] = $_POST["email"];
            $_SESSION["Password"] = $hashed_pass;
            header("Location: account.php");
        } else
            $message2 = "incorrect password";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Sign-up and Sign-in</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

<?php include("top.php");?>
<div class="header2"></div> 

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST" id="myForm">
                <h2>Create your new<br>Tea Account!</h2> <br>

                <table>
                    <tr>
                        <td>
                            <label class="custom">
                                <input class="name" type="text" id="firstName" name="Fname" maxlength="15" required><span class="placeholder">First Name:</span>
                            </label>
                        </td>
                        <!--First name and last name are on the same row-->
                        <td>
                            <label class="custom">
                                <input class="name" type="text" id="Lname" name="Lname" maxlength="15" required><span class="placeholder">Last Name: </span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <!--elements take 2 cells merged in order to keep elements centered-->
                            <label class="custom">
                                <input type="email" name="email" required><span class="placeholder">Email: </span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label class="custom">
                                <input type="password" id="psswrd" name="psswrd" maxlength="16" required><span class="placeholder">Password: </span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label class="custom">
                                <input type="password" name="cnfrmpass" id="cnfrmpass" maxlength="16" required><span class="placeholder">Confirm Password: </span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 0px">
                            <p style="color: rgb(255, 0, 0)" id="message"></p>
                        </td>
                    </tr>
                    <tr>
                        <input type="hidden" name="hidden" value="UP">
                        <td colspan="2"><button type="button" class="button" onclick="ConfrimPassword()">Submit</button></td>
                    </tr>
                </table>

            </form>
        </div>

        <div class="form-container sign-in-container">
            <form class="form2" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="POST">
                <h2 style="font-size:  30px;">Sign In</h2>
                <table>
                    <tr>
                        <td>
                            <label class="custom">
                                <input type="email" name="email" class="inputwidth" required><span class="placeholder">Email: </span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="custom">
                                <input type="password" name="psswrd" class="inputwidth" required><span class="placeholder">Password: </span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px">
                            <p style="color: rgb(255, 0, 0)" id="message"> <?php if (isset($_POST["hidden"])) if ($_POST["hidden"] == "IN") echo $message2; ?> </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="hidden" value="IN">
                            <a href="#">Forgot Your Password</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="button" value="Sign In">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="align">
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>Sign-in to see what you've been missing!</p>
                        <button class="ghost switchbtn button" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Sign-up to start a journey with us!</p>
                        <button class="ghost switchbtn button" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="javascript/signup.js" type="text/javascript"></script>

</body>

</html>