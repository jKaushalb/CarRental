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
            if(isset($_SERVER['REQUEST_METHOD']))
            {
                if(isset($_REQUEST['update']))
                {
                    if(isset($_REQUEST['brand'])||isset($_REQUEST['price'])||isset($_REQUEST['model'])||isset($_REQUEST['numplate'])||isset($_REQUEST['imgpath'])||isset($_REQUEST['desc']))
                    {
                        $brand=$_REQUEST['brand'];
                        $model=$_REQUEST['model'];
                        $numplate=$_REQUEST['numplate'];
                        $radio=$_REQUEST['inimage'];
                        //$path="";
                        if($radio=='checked')
                        {
                            $path=$_REQUEST['image'];
                        }
                        $desc=$_REQUEST['desc'];
                        $price=$_REQUEST['price'];
						$extensions = array("jpeg","jpg","png");
                        $img = $_FILES['image']['name'];
						$conn=OpenCon();
                        if($radio=='checked1')
                        {
							if(in_array(strtolower(pathinfo("D:\\xampp\\htdocs\\CarRental\\image\\$img",PATHINFO_EXTENSION)),$extensions) === true)
							{
								if(file_exists("D:\\xampp\\htdocs\\CarRental\\image\\$img") == false)
								{
									$flag=Updatecarsi($conn,$brand,$model,$numplate,$price,$desc,$_FILES['image']['name']);
									if($flag)
									{
										$Err = "Car with $numplate updated successfully.<br>";
										//$Err = "Image Name: " . $img . "was";	
										move_uploaded_file($_FILES['image']['tmp_name'],"D:\\xampp\\htdocs\\CarRental\\image\\$img");
									}
									else
									{
										//$Err = $img;
										$Err ="Error Occurred.<br>";
										
									}
								}
								else
									echo "<script>alert('A file with the same name already exists, please rename the file you are trying to upload.');</script>";
							}
							else
								echo "<script>alert('Upload a file with an image extension only.');</script>";
                        }
                        else
                        {
                            $flag=Updatecarswi($conn,$brand,$model,$numplate,$price,$desc);
                            if($flag)
                            {
                                $Err = "Car with $numplate updated successfully without image.<br>";
                            }
                            else
                            {
                                $Err = "Error Occurred.<br>";
                            }
                        }
                    }
                    else
                    {
                        $Err = "Enter all the Details.<br>";
                    }
                }
            }
        ?>
        <?php
        	if(isset($_SESSION['role'])&&$_SESSION['role']==$manager)
        	{
        		?>
        		<form class="box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                     <div class="title">Update Car data</div>
                     <div class="form">
                         <div class="inputfield">
                            <label>Brand</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            <input type="text" name="brand" value="<?php if(isset($_REQUEST['brand'])){ echo $_REQUEST['brand'];}?>" class="input">&emsp;&emsp;&emsp;
                            <label>Model Name</label>&emsp;&emsp;
                            <input type="text" name="model" value="<?php if(isset($_REQUEST['model'])){ echo $_REQUEST['model'];}?>"class="input">
                         </div>
                         <div class="inputfield">
                            <label>Number Plate</label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                            <input type="text" name="numplate" value="<?php if(isset($_REQUEST['numplate'])){ echo $_REQUEST['numplate'];}?>" class="input">&emsp;&emsp;&emsp;
                            <label>Price</label>&emsp;&emsp;
                            <input type="number" name="price" value="<?php if(isset($_REQUEST['price'])){ echo $_REQUEST['price'];}?>"class="input">
                         </div>
                         <div class="inputfield">
                            <label>Include Image</label>
                            <div class="custom_select" id="INimage" >
                                <input type="radio" name="inimage" value="checked1" id="yes" onclick="changeStatusYes()">
                                <label for="yes">YES</label>
                                <input type="radio" name="inimage" value="unchecked" id="no" onclick="changeStatusNo()" checked>
                                <label for="no">NO</label>
                            </div>
                         </div>
                         <div class="inputfield" id="imagefield" style="visibility: hidden;">
                            <label>Image</label>
                            <input type="file" name= "image" id="image" class="input" >
                         </div>
                         <div class="inputfield">
                             <label>Description</label>
                             <input type="text" class="input" name="desc" value="<?php if(isset($_REQUEST['desc'])){ echo $_REQUEST['desc'];}?>">
                         </div>
                         <div class="inputfield">
                             <input type="submit" name="update" value="Update" class="btn">
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
                <script type="text/javascript">
                    function changeStatusYes()
                    {
                        document.getElementById("imagefield").style.visibility="visible";
                    }
                    function changeStatusNo()
                    {
                        document.getElementById("imagefield").style.visibility="hidden";
                    }
                </script>
        <?php
            }
            else
                echo "You got unauthorized access!<br>";
        ?>
    </body>
</html>