<?php

    if(isset($_POST['btnforget']))
    {

        
        $email=$_POST['email'];
       function generateRandomString($length1)
       {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length1; $i++) 
            {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        

           $pswd=generateRandomString(5);
           $mailbody="<div style='display:block;width:500px;height:230px;border:1px solid black;'>
                <h3>Your New Password</h3>
                <h1>" . $pswd . "</h1>
           </div>";

        $select=mysqli_query($conn,"SELECT * FROM tbl_admin WHERE email='$email'");
        $dtrow=mysqli_num_rows($select);
        $dtrecord=mysqli_fetch_assoc($select);

        if($dtrow>0)
        {
            $sub="NEW PASSWORD";
            $headers = 'From: webmaster@example.com' . "\r\n" .
                        'Reply-To: webmaster@example.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

            // echo $email . '<br>';
            // echo $sub . '<br>';
            // echo $mailbody;
            // echo $headers;
           
           mail($email,$sub,$mailbody,$headers);
        }

    }

?>

<!DOCTYPE HTML>
<html>
<head>
    <link href="login.css" type="text/css" rel="stylesheet"/>
<style type="text/css">


</style>
</head>
<body>
    <div id="wrapper">

<br>
<br>
<br>
<div class="form_div">
<p>Forgot Password</p>
<form action='' method='post'>
<table cellspacing='5' align='center'>
<tr><td>Email:</td><td><input type='text' name='email'/></td></tr>
<tr><td></td><td><input type='submit' name='btnforget' value='Submit'/></td></tr>
</table>
</form>
</div>
</body>
</html>