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
            		if(isset($_POST['insert']))
            		{
            			$uname=trim($_POST['new_user']);
            			$pass=trim($_POST['new_pass']);
						$pass=hash('sha256',$pass); // encrypting the password
            			$role=trim($_POST['role']); 
            			if($role=='Manager')
            			{
            				$role=$manager;
            			}							#this if for insertion of employee
            			else
            			{
            					$role=$employee;
            			}
            			$conn=OpenCon();
                        $flag=Insertemployees($conn,$uname,$pass,$role);
                        $id = mysqli_insert_id($conn);
            ?>
            <div>
                <?php
                    if($flag)
                    {
                        $Err = "Message: Employee $uname  has been assigned ID $id!";
                    }
                    else
                    {
                        $Err = "Error occurred or Record doesn't exist";
                        echo mysqli_error($conn);
                    }
                    CloseCon($conn);
                ?>
            </div>
            <?php
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
        		<div class='e_ins'>
                    <form class='box' method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                        <h1>Insert Employee</h1>
                        <input type='text' placeholder='ENTER USERNAME' name='new_user' required></input>
                        <input type='password' placeholder='ENTER PASSWORD' name='new_pass' required></input>
                        <span>Select Your Role:</span><br>
                        <input type='radio' id="rad" value='Employee' name='role' checked ><span>&nbsp;Employee</span></input><br>
                        <input type='radio' id="rad" value='Manager' name='role' ><span>&nbsp;Manager</span></input>
                        <input type='submit' name='insert' value='Insert'></input>
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