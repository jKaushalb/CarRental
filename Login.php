<!DOCTYPE html>
<html>
<head>
    <?php
        session_start();
        $role=-1;
        include 'db_connection.php';
        include 'gvar.php';
        $Err = "";
    ?>
	<meta charset="utf-8">
	<title>LOG IN</title>
	<link rel="stylesheet" type="text/css" href="LoginStyle.css">
    <?php
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        if(isset($_POST['login']))
        {
            if(isset($_POST['uname'])&&$_POST['pass'])
            {
                $uname=trim($_POST['uname']);
                $pass=trim($_POST['pass']);
				$pass=hash('sha256',$pass); // encrypting the password
                $conn=OpenCon();  #opening database connection to check credentails
                $role=login($conn,$uname,$pass);
                //echo $uname." ".$pass." ".$role."<br>";
				if(isset($_REQUEST['cbox']))
				{
					
					if(isset($_COOKIE['user']))
					{
						$_COOKIE['user']=$uname;
					}
					else if($_REQUEST['cbox']='checked')
					{
						setcookie('user',$uname,time() + (86400 * 30), "/");
					}
				}
				else
				{
					if(isset($_COOKIE['user']))
					{
						unset($_COOKIE['user']); 
						setcookie('user', null, -1, '/');
					}
				}

                if($role>=0)
                {
                    $_SESSION["role"]=$role;
                    $_SESSION["uname"]=$uname;
                    $_SESSION["pass"]=$pass;
                    $_SESSION["eid"]=eid($conn,$uname,$pass);
                    if($role==$manager)
                    {
                        CloseCon($conn);
                        sleep(2);//after 2 sec redirection will be happen
                        header ("Location: manager.php");
                    }
                    else
                    {
                        sleep(2);//after 2 sec redirection will be happen
                        header ("Location: emp.php");
                    }
                }
                else
                {
                    $Err = "Message: Please check the entered credentials again.";
                }
            }
            else
            {
                $Err = "Message: Enter Valid Credentials<br>";
            }
        }
    }
    ?>
</head>
<body>
	<form class="box" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
		<h1>LOGIN</h1>
		<input type="text" name="uname" placeholder="Username" value="<?php if(isset($_COOKIE["user"])){ echo $_COOKIE['user'];}?>" required></input>
		<input type="password" name="pass" placeholder="Password" required></input>
		<input type='checkbox' name="cbox" value='checked' > <font color='white'>Remember Me!</font></input>
		<input type="submit" name="login" value="Login">
		<span style="color:white;"><?php echo $Err; ?></span>
	</form>
</body>
</html>