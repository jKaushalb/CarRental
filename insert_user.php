<!DOCTYPE html>
<html>
    <head>
        <?php
            session_start();
            include "db_connection.php";
            include 'gvar.php';
            $Err = "";
        ?>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="MANAGER.css">

        <title>MANAGER</title>
    </head>
    <body>
        <?php
        	if(isset($_SESSION['role'])&&($_SESSION['role']==$manager || $_SESSION['role']==$employee ))
        	{
        		if(isset($_REQUEST['numplate'])) // as first time we reach here it has numplate in ints url;
        		    $_SESSION['numplate']=$_REQUEST['numplate'];
        		?>
                <?php
                if(isset($_SERVER['REQUEST_METHOD']))
                 {
                    $conn=OpenCon();
                    if(isset($_REQUEST['user']))
                    {
                        $lino=trim($_REQUEST['licno']);
                        $flag=Checkusers($conn,$lino);
                        $cf = mysqli_affected_rows($conn);
                        if($cf == 1)
                        {
                            $Err = "User with $lino fetched.<br>";
                            $_SESSION['licno']=$lino;
                            header('Location: rental.php');
                        }
                        else
                        {
                            $Err = "User with $lino doesn't exist.<br>";
                        }
                        CloseCon($conn);
                    }
                    else if(isset($_REQUEST['new_user']))
                    {
                        $n_lino=trim($_REQUEST['n_licno']);
                        $cname=trim($_REQUEST['cname']);
                        $cmob=trim($_REQUEST['cmob']);
                        $flag=Insertusers($conn,$cname,$cmob,$n_lino);
                        if($flag)
                        {
                            $Err = "User with $n_lino inserted successfully.<br>";
                            $_SESSION['licno']=$n_lino;
                            header('Location: rental.php');
                        }
                        else
                        {
                            $Err = "Error Occurred<br>";
                        }
                    }
                 }
                ?>
        		<div class='form'>
                    <div class='existing'>
                	    <h2>Search Customer</h2>
                        <form class="box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                            <input type="text" name='licno' placeholder='Enter License No.'></input>
                            <input type="submit" name='user' value='Search'></input>
                    </div>
                        </form>
                        <h2>New Customer</h2>
                        <button name='new_c' onclick="unhide()" >Register</button>
                            <form class="box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                                <input style="visibility:hidden" type="text" name='n_licno' id='n_licno' placeholder='Enter License No.' required></input>
                                <input style="visibility:hidden" type="text" name="cname" id="cname" placeholder='Enter Customer Name' required></input>
                                <input style="visibility:hidden" type="number"name="cmob" id="cmob" placeholder='Enter Customer Mobile No.' required></input>
                                <input style="visibility:hidden" type="submit" name='new_user' id='new_user'  value='Sign Up'></input><br>
                    <span style="color:white;">Message: <?php echo $Err; ?></span>
                 </div>
        <?php
            }
            else
            {
                 echo "You got unauthorized access!<br>";
            }
         ?>
        <script type="text/javascript">
            function unhide()
            {
                document.getElementById("n_licno").style.visibility="visible";
                document.getElementById("cname").style.visibility="visible";
                document.getElementById("cmob").style.visibility="visible";
                document.getElementById("new_user").style.visibility="visible";
            }
        </script>
    </body>
</html>