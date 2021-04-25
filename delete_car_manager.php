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
        <link rel="stylesheet" type="text/css" href="INSERT.css">
        <link rel="stylesheet" type="text/css" href="MANAGER.css">
        <title>MANAGER</title>
    </head>
    <body>
        <?php
        	if(isset($_REQUEST['delete']))
        	{
        		$numplt=$_REQUEST['numplate'];
        		$conn=OpenCon();
        		$flag=DeleteCars($conn,$numplt);
        		if($flag)
                {
                    $Err = "Car with $numplt deleted successfully.<br>";
                }
                else
                {
                    $Err = "Error Occurred.<br>";
                }
        	}
        ?>
        <?php
        	if(isset($_SESSION['role'])&&$_SESSION['role']==$manager)
        	{
        		?>
        		<form style="max-width:550px;" class="box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <div class="title">DELETE CAR DATA</div>
                    <div class="form">
                        <div class="inputfield">
                            <label>Enter Number Plate</label>
                            <input type="text" name='numplate' value="<?php if(isset($_REQUEST['numplate'])){ echo $_REQUEST['numplate'];} ?>" class="input" required>
                        </div>
                        <div class="inputfield">
                            <input type="submit"  name='delete' value="Delete" class="btn">
                        </div>
                    </div>
                    <span style="color:white;">Message: <?php echo $Err; ?></span>
                </form>
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
        <?php
            }
            else
                echo "You got unauthorized access!<br>";
        ?>
    </body>
</html>