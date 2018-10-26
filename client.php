<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Double Submit Cookies Pattern</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
    <body>
    <br/><br/>
        <div class="container" style="margin-top: 100px">
            <h2 class="text-center"> Add New Status</h2>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <form method="post" action="server.php">
                        Status:<br/>
                        <input type="text" name="status" class="form-control" placeholder="Status" required><br/>

                        <input type="hidden" name="token_csrf" id="token_csrf">
                        <input type="submit" name="addstatussubmit" value="Add Status" class="btn btn-success"/>
                    </form>
                </div>
            </div><br/><br/>
            <input type="button" value="Log out!" onclick="window.location.href='logout.php'" class="btn btn-danger"/>
        </div>

        
    <script>
        // read CSRF Token cookie and change value of the hidden field
        document.getElementById("token_csrf").value = '<?php echo $_COOKIE["csrfTokenCookie"]; ?>';
        console.log("CSRF : " + '<?php echo $_COOKIE["csrfTokenCookie"]; ?>');
	</script>
    </body>
</html>