<?php
session_start();

    if(isset($_GET["logout"]))
    {

        setcookie("Email", 1, time() - (86400 * 30));
        setcookie("Pass", 1, time() - (86400 * 30));
        unset($_SESSION["Email"]);
        unset($_SESSION["Password"]);
        header("Location: Index.php");
    }
    else
    {

        

        if (isset($_COOKIE["Email"]) && isset($_COOKIE["Pass"]))
        {
          $_SESSION["Email"] = $_COOKIE["Email"];
      
          $_SESSION["Password"] = $_COOKIE["Pass"];
        }

    
        if (isset($_SESSION["Email"]) && isset($_SESSION["Password"]))
        {
            
            setcookie("Email", $_SESSION["Email"], time() + (86400 * 30));
            setcookie("Pass", $_SESSION["Password"], time() + (86400 * 30));
        }
        
        
    }

?>