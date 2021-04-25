<!DOCTYPE html>
<html>
    <head>
        <?php
            session_start();
            include "db_connection.php";
            include 'gvar.php';
        ?>
        <?php
        	function findcar($conn,$numplt)
        	{
        		$sql = "SELECT * FROM `cars` WHERE `numberplate` = '$numplt'";
        		$result = mysqli_query($conn,$sql);
        		$arr=array();
        		while($row = mysqli_fetch_assoc($result))
        		{
        			array_push($arr,$row);
        			//echo $row['numberplate']."<br>";
        		}
        		if(count($arr))
        		{
        			return $arr;
        		}
        		else
        		{
        			echo "No data found";
        			mysqli_error($conn);
        			return null;
        		}
        	}

        	function display_non_rentedcars($conn)
        	{
        		$sql = "SELECT * FROM `cars` WHERE `rented` != 1";
                $result = mysqli_query($conn,$sql);
        		$arr=array();
        		while($row = mysqli_fetch_assoc($result))
        		{
        			array_push($arr,$row);
        			//echo $row['numberplate']."<br>";
        		}
        		if(count($arr))
        		{
        			return $arr;
        		}
        		else
        		{
        			//echo "ALL CARS ARE RENTED NO DATA FOUND<br>";
        			mysqli_error($conn);
        			return null;
        		}
        	}

        	function display_cars($conn)
        	{
        		$sql = "SELECT * FROM `cars` WHERE 1 = 1";
                $result = mysqli_query($conn,$sql);
        		$arr=array();
        		while($row = mysqli_fetch_assoc($result))
        		{
        			array_push($arr,$row);
        			//echo $row['numberplate']."<br>";
        		}
        		if(count($arr))
        		{
        			return $arr;
        		}
        		else
        		{
        			//echo "No data found";
        			mysqli_error($conn);
        			return false;

        		}
        	}
        ?>
        <meta charset="utf-8">
        <title>EMPLOYEE</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');
            body
            {
                margin: 0;
                padding: 0;
                font-family: 'Poppins' ,sans-serif;
                background: #ee6c4d;
            }
            nav
            {
                width: 98%;
                position: absolute;
                padding: 30px;
                left: 14px;
                top: 15px;
                background: #1b1b1b;

            }
            a,a:hover
            {
                color: white;
                text-decoration: none;
            }
            .outer
            {
                padding: 50px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <?php
            if(isset($_SESSION['role'])&&$_SESSION['role']==$employee)
            {
                ?>
                <header>
                    <nav class="navbar navbar-expand-lg navbar-dark rounded-pill">
                        <div class="container-fluid">
                            <a class="navbar-brand mb-0 h1" href="#">RENT-A-CAR</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="./emp.php">HOME</a>
                                    </li>
                                </ul>
                            </div>
                            <form class="container-fluid justify-content-start">
                                <button class="btn btn-sm btn-outline-danger" name='signout' type="submit">LOGOUT</button>
                            </form>
                        </div>
                    </nav>
                </header>
                <div class="outer">
                    <table class="table table-dark table-striped table table-dark table-hover table caption-top ">
                        <caption>
                            <strong><h3 style="color:#BDBDBD;">CAR DATA</h3></strong>
                            <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group me-2" role="group" aria-label="First group">
                                    <form method='post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                                        <input type='submit' name='dis_all' class="btn btn-dark rounded" value="Display All Cars"></input>&nbsp;&nbsp;
                                        <input type='submit' name='dis_rent' class="btn btn-dark rounded" value="Display Non Rented"></input>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                        <input type='text' name='numplt' class="form-control-sm me-2 rounded" placeholder="Enter Numberplate"></input>
                                            <button class="btn btn-secondary btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Operations</button>
                                            <ul class="dropdown-menu" aria-label="dropdownMenuButton1">
                                                <li><input type="submit" name="findcar" class="dropdown-item" value="Find Car"></input></li>
                                                <li><input type="submit" class="dropdown-item" formaction="./billing.php" value="Return Car"></input></li>
                                            </ul>
                                    </form>
                                </div>
                            </div>
                        </caption>
                        <?php
                            $conn=OpenCon();
                            $c=1;
                            $a=display_non_rentedcars($conn);
                            if(isset($_SERVER['REQUEST_METHOD']))
                            {
                                if(isset($_REQUEST['dis_all']))
                                {
                                    $a=display_cars($conn);
                                    $c=0;
                                }
                                else if(isset($_REQUEST['findcar']))
                                {
                                    if(isset($_REQUEST['numplt']))
                                    {
                                        $num=$_REQUEST['numplt'];
                                        $a=findcar($conn,$num);
                                        $c=0;
                                    }
                                    else
                                    {
                                        echo "Please Enter Numberplate<br> ";
                                    }
                                }
                                else if(isset($_REQUEST['dis_rent']))
                                {
                                    $c=1;
                                    $a=display_non_rentedcars($conn);
                                }
                                else if(isset($_REQUEST['signout']))
                                {
                                    session_destroy();
                                    echo "<script> location.replace('./login.php'); </script>";
                                }
                            }
                            if(isset($a))
                            {
                        ?>
                        <thead>
                            <tr>
                              <th scope="col"><strong>Image</strong></th>
                              <th scope="col"><strong>Details</strong></th>
                              <th scope="col"><strong>Functions</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($a as $row)
                                {
                            ?>
                            <div class="inner">
                                <tr>
                                    <td align = "center"><img width = '300px' height='200px' src="./image/<?php echo $row['image'];  ?>">
                                    </td>
                                    <td align = "left">
                                        <strong>Car Name:</strong>&nbsp;<?php echo $row["brandname"]; ?>&nbsp; <br>
                                        <strong>Model Name:</strong>&nbsp;<?php echo $row["modelname"]; ?>&nbsp; <br>
                                        <strong>Number Plate:</strong>&nbsp;<?php echo $row["numberplate"]; ?><br>
                                        <strong>Price:</strong>&nbsp;&#8377;&nbsp;<?php echo $row["price"]; ?><br>
                                        <strong>Description:</strong><br><?php echo $row["description"]; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group me-2" role="group" aria-label="Second group">

                                            <?php
                                                if($c==1 && $row['rented']==0)
                                                {
                                            ?>
                                            <button class="btn btn-primary btn-sm rounded"><a href="./insert_user.php?numplate=<?php echo $row['numberplate'] ;?> ">Book Now</button>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                            </div>
                        </tbody>
                    </table>
                </div>
                        <?php
                            }
                            else
                            {
                                echo "No data available";
                            }
                        ?>
        <?php
            }
           else
                echo "You got unauthorized access!<br>";
        ?>
        <script type='text/javascript'>
            logout()
            {
                window.location.href('./Login.php');
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    </body>
</html>