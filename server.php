<?php
    session_start();
    
    // validate login
    if(isset($_POST['submit'])){
        ob_end_clean(); // buffer clean

        validate($_POST['username'],$_POST['password']);
    }

    //validate cookies and update status
    if(isset($_POST['addstatussubmit'])){
        ob_end_clean(); // buffer clean

	    $cookieNameCsrf = "csrfTokenCookie"; 
        validateStatus($_POST['token_csrf'],$_COOKIE[$cookieNameCsrf]);
    }

    //generate csrf token
    function generateToken($sessionCookie){
        if(empty($_SESSION['random_key'])){
            $_SESSION['random_key'] = bin2hex(random_bytes(32));
        }

        $token = hash_hmac('sha256',$sessionCookie,$_SESSION['random_key']);
        
        $sessionID = session_id();

        $expireTime = time() + 60*60; // expire time 1 hour
	    $cookieNameCsrf = "csrfTokenCookie"; 
        
        setcookie ($cookieNameCsrf, $token, $expireTime, "/","localhost", FALSE, TRUE);

        ob_start(); // store in buffer
        echo $token;
    }

    //validate cookie
    function validate($username,$password){
        /**
         * For demo ,
         * Username : user
         * Password : user
         */

        if($username == "user" && $password == "user"){
            $cookieName = "sessionCookie"; 
            
            generateToken($_COOKIE[$cookieName]);
            
            echo "<script> alert('Successfully Logged In') </script>";
            echo "<script type=\"text/javascript\"> window.location.href = 'client.php';</script>";
        
        }else{
            echo "<script> alert('Login failed! Check username and password again !!!') </script>";
            echo "<script type=\"text/javascript\"> window.location.href = 'index.php';</script>";
        }
    }

    //validate status
    function validateStatus($token,$csrfCookie){
        if($token == $csrfCookie){
            echo "<script> alert('Status successfully added') </script>";
            echo "<script type=\"text/javascript\"> window.location.href = 'client.php';</script>";
        }else{
            echo "<script> alert('Status posting failed! CSRF token not matched !!!') </script>";
            echo "<script type=\"text/javascript\"> window.location.href = 'client.php';</script>";
        }
    }

?>