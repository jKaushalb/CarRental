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
        <link rel="stylesheet" type="text/css" href="empfunc.css">
        <title>MANAGER</title>
    </head>
    <body>
        <?php
            if(isset($_SERVER['REQUEST_METHOD']))
            {
                if(isset($_POST['delete']))
                {
                    $eid=trim($_POST['del_eid']);
                    $uname=trim($_POST['del_uname']);
                    $conn=OpenCon();
                    if(Deleteemployees($conn,$eid,$uname))
                    {
                        $Err = "Record with ID $eid is deleted";
                    }
                    else
                    {
                        mysqli_error($conn);
                        $Err = "Error occurred or Record Doesn't Exist";
                    }
                    CloseCon($conn);
                }
            }
        ?>
        <?php
        	if(isset($_SESSION['role'])&&$_SESSION['role']==$manager)
        	{
        		?>
                <header>
                    <nav>
                        <div class="logo">RENT-A-CAR</div>
                        <label for="btn" class="icon">
                            <span class="fa fa-bars"></span>
                        </label>
                        <input class="rad" type="checkbox" id="btn">
                        <ul>
                            <li><a href="./manager.php">HOME</a></li>
                            <li>
                                <label for="btn-1" class="show">EMPLOYEE +</label>
                                <a href="#">EMPLOYEE</a>
                                <input class="rad" type="checkbox" id="btn-1">
                                <ul>
                                    <li><a href="./insert_manager.php">INSERT EMPLOYEE</a></li>
                                    <li><a href="./delete_manager.php">DELETE EMPLOYEE</a></li>
                                    <li><a href="./promote_manager.php">PROMOTE EMPLOYEE</a></li>
                                    <li><a href="./update_manager.php">UPDATE PASSWORD</a></li>
                                </ul>
                            </li>
                            <li>
                                <label for="btn-2" class="show">CAR +</label>
                                <a href="#">CAR</a>
                                <input class="rad" type="checkbox" id="btn-2">
                                <ul>
                                    <li><a href="./insert_car_manager.php">INSERT CAR</a></li>
                                    <li><a href="./update_car_manager.php">UPDATE CAR</a></li>
                                    <li><a href="./delete_car_manager.php">DELETE CAR</a></li>
                                </ul>
                            </li>&emsp;&emsp;&emsp;
                        </ul>
                    </nav>
                </header>
                <div class ='e_del'>
                	<form class='box' method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                        <h1>Delete Employee</h1>
                        <input type='text' placeholder='ENTER EMPLOYEE ID ' name='del_eid' required></input>
                        <input type='password' placeholder='ENTER USERNAME ' name='del_uname' required></input>
                        <input type='submit' name='delete' value='Delete'></input>
                        <span>Message: <?php echo $Err; ?></span>
                    </form>
                </div>
                <?php
            }
            else
                echo "You got unauthorized access!<br>";
            ?>
    </body>
</html>