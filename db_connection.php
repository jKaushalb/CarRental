<?php

    // To open connection to the database
    function OpenCon()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "lamp";
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
        return $conn;
    }

    // To close connection to the database
    function CloseCon($conn)
    {
        $conn -> close();
    }

    // To insert new employees into the database
    function Insertemployees($conn,$user,$pass,$position)
    {
        $sql = "INSERT INTO `employees` (`empid`, `username`, `password`, `role`) VALUES (NULL,'$user','$pass','$position')";
        $result = mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn))
        {
            //echo "The record has been inserted successfully!<br>";
            return True;
        }
        else
        {
            //  echo "The record was not inserted successfully.<br>";
			return False;
        }
    }

    // To delete employees from the database
    function Deleteemployees($conn,$empid,$uname)
    {
        $sql = "DELETE FROM `employees` WHERE `empid`='$empid' && `username`='$uname' "; //updated
        $result = mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn))
        {
            return True;
        }
        else
        {
            return False;
        }
    }

    // To update employee password (Only accessible by manager)
    function Updateemployees($conn,$empid,$pass)
    {
        $sql = "UPDATE `employees` set `password`='$pass' WHERE `empid`='$empid'";
        $result = mysqli_query($conn,$sql);
        $r=mysqli_affected_rows($conn);
        if($r==1)
        {
            return True;
            //echo "The record has been updated successfully!<br>";
        }
        else
        {
            //echo "The record was not updated successfully.<br>";
            echo mysqli_error($conn);
            return False;
        }
    }

    // To promote employees (Only accessible by manager)
    function Promoteemployees($conn,$empid,$position)
    {
        $sql = "UPDATE `employees` set `role`='$position' WHERE `empid`='$empid'";
        $result = mysqli_query($conn,$sql);
        $r=mysqli_affected_rows($conn);
        if($r==1)
        {
            return True;
            //echo "The record has been updated successfully!<br>";
        }
        else
        {
            //echo "The record was not updated successfully.<br>";
            echo mysqli_error($conn);
            return False;
        }
    }

    // To fetch employee id from the database
    function eid($conn,$uname,$pass)
    {
        $sql = "SELECT `eid` FROM `employees` WHERE `username`='$uname' AND `password` = '$pass'";  //updated
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            return (int)mysqli_fetch_array($result)[0];
            //echo "The record has been inserted successfully!<br>";
        }
        else
        {
            //echo "The record was not inserted successfully.<br>";
            echo mysqli_error($conn);
            return False;
        }
    }

    // To find the price of a vehicle by its number numberplate
    function pricenum($conn,$numplt)
    {
        $sql = "SELECT `price` FROM `cars` WHERE `numberplate`='$numplt'";  //updated
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            return (int)mysqli_fetch_array($result)[0];
            //echo "The record has been inserted successfully!<br>";
        }
        else
        {
            //echo "The record was not inserted successfully.<br>";
            echo mysqli_error($conn);
            return False;
        }
    }

    // To fetch the role of the employee from the database during login
    function Login($conn,$uname,$pass)
    {
        $sql = "SELECT `role` FROM `employees` WHERE `username`='$uname' AND `password` = '$pass'";  //updated
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag)
        {
            //echo "Login Successful!<br>";
            $flag=mysqli_fetch_array($result);
            $noid = $flag[0];
            echo $flag[0];
            return $noid ; // returning the role;      //updated
        }
        else
        {
            //echo "Please check the login details again.<br>";
            echo  mysqli_error($conn);
            return -1; //if connection fails
        }
    }

    // To insert into rentals table when giving a car on rent
    function Givenrentals($conn,$clientname,$clientmobile,$clientlicense,$numberplate,$empid,$kms,$dorental,$doreturn,$advance,$total)
    {
        $sql = "INSERT INTO `rentals` (`rentername`, `rentermobile`, `renterlicense`, `numberplate`, `empid`, `kms`, `dorental`, `doreturn`, `advance`, `total`) VALUES ('$clientname', '$clientmobile', '$clientlicense', '$numberplate', '$empid', '$kms', '$dorental', '$doreturn', '$advance', '$total')";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        $sql = "UPDATE `cars` set `rented` = 1 WHERE `numberplate` = '$numberplate'";
        $result2 = mysqli_query($conn,$sql);
        $flag2 = mysqli_affected_rows($conn);
        if($flag == 1 && $flag2 == 1)
        {
            return True;
            echo "The record has been inserted successfully!<br>";
        }
        else
        {

           // echo "The record was not inserted successfully.<br>";
            echo mysqli_error($conn);
            return False;
        }
    }

    // To insert new cars into the database (Only accessible by manager)
    function Insertcars($conn,$brand,$model,$numplate,$price,$desc,$img)
    {
        $sql = "INSERT INTO `cars` ( `brandname`, `modelname`,  `numberplate`,  `price`, `description`, `image`, `rented`) VALUES ('$brand','$model','$numplate','$price', '$desc', '$img',0)";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            return True;
            //echo "The record has been inserted successfully!<br>";
        }
        else
        {
            //echo "The record was not inserted successfully.<br>";
            //echo mysqli_error($conn);
            return False;
        }
    }

    // To delete a car from the database (Only accessible by manager)
    function Deletecars($conn,$numplate)
    {
        $sql = "DELETE FROM `cars` WHERE `rented` != 1 AND `numberplate` = '$numplate'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
           // echo "The record has been deleted successfully!<br>";
           return True;
        }
        else
        {
           // echo "The record was not deleted successfully.<br>";
            echo mysqli_error($conn);
            return False;
        }
    }

    // To find a car from the database
    function Findcars($conn,$numplate)
    {
        $sql = "SELECT * FROM `cars` WHERE `rented` != 1 AND `numberplate` = '$numplate'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            return $result;
            //echo "Data fetched successfully!<br>";
        }
        else
        {
            //echo "Data could not be fetched, either the car is on rent or does not exist.<br>";
            echo mysqli_error($conn);
            return null;
        }
    }

    // To update cars in the database without updating the image
    function Updatecarswi($conn,$brand,$model,$numplate,$price,$desc)
    {
        $sql = "UPDATE  `cars` set `brandname` = '$brand', `modelname` = '$model', `price` = '$price', `description` = '$desc' WHERE `rented` != 1 AND `numberplate` = '$numplate'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            //echo "The record has been updated successfully!<br>";
            return true;
        }
        else
        {
            // echo "The record was not updated successfully.<br>";
            echo mysqli_error($conn);
            return false;
        }
    }

    // To update cars in the database with image
    function Updatecarsi($conn,$brand,$model,$numplate,$price,$desc,$img)
    {
        $sql = "UPDATE  `cars` set `brandname` = '$brand', `modelname` = '$model', `price` = '$price', `description` = '$desc', `image` = '$img' WHERE `rented` != 1 AND `numberplate` = '$numplate'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            //echo "The record has been updated successfully!<br>";
            return true;
        }
        else
        {
           // echo "The record was not updated successfully.<br>";
            echo mysqli_error($conn);
            return false;
        }
    }

    // To insert a new client into the database
    function Insertusers($conn,$clientname,$clientmobile,$clientlicense)
    {
        $sql = "INSERT INTO `users` ( `clientname`, `clientmobile`,  `clientlicense`) VALUES ('$clientname', '$clientmobile', '$clientlicense')";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            //echo "The record has been inserted successfully!<br>";
            return true;
        }
        else
        {
           // echo "The record was not inserted successfully.<br>";
            echo  mysqli_error($conn);
            return false;
        }
    }

    // To fetch client data from the database
    function Checkusers($conn,$clientlicense)
    {
        $sql = "SELECT * FROM `users` WHERE `clientlicense` = '$clientlicense'";
        $result = mysqli_query($conn,$sql);
        //echo mysqli_fetch_assoc($result)[0];
        $flag = mysqli_affected_rows($conn);
        if($flag==1)
        {
            // echo "Data fetched successfully!<br>";
            return True;
        }
        else
        {
            //  echo "Data could not be fetched, either the car is on rent or does not exist.<br>";
            echo mysqli_error($conn);
            return False;
        }
    }

    // To fetch client data from the database
    function Findusers($conn,$clientlicense)
    {
        $sql = "SELECT * FROM `users` WHERE `clientlicense` = '$clientlicense'";
        $result = mysqli_query($conn,$sql);
        //echo mysqli_fetch_assoc($result)[0];
        $flag = mysqli_affected_rows($conn);
        if($flag==1)
        {
            // echo "Data fetched successfully!<br>";
            return $result;
        }
        else
        {
            //  echo "Data could not be fetched, either the car is on rent or does not exist.<br>";
            echo mysqli_error($conn);
            return False;
        }
    }

    // To update user data into the database
    function Updateusers($conn,$clientname,$clientmobile,$clientlicense)
    {
        $sql = "UPDATE `users` set `clientname` = '$clientname', `clientmobile` = '$clientmobile' WHERE `clientlicense` = '$clientlicense'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            // echo "The record has been inserted successfully!<br>";
            return True;
        }
        else
        {
            //  echo "The record was not inserted successfully.<br>";
            echo mysqli_error($conn);
            return False;
        }
    }

    // To insert additional car data into the database (Only accessible by manager)
    function Insertcardata($conn,$numberplate,$carname,$mileage,$kms)
    {
        $sql = "INSERT INTO `carsadd` ( `numberplate`, `carname`, `mileage`, `kms`) VALUES ('$numberplate','$carname','$mileage','$kms')";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            return True;
            //echo "The record has been inserted successfully!<br>";
        }
        else
        {
            //echo mysqli_error($conn);
            return False;
            //echo "The record was not inserted successfully.<br>";

        }
    }

    // To get car add data
    function getcardata($conn,$numplt)
    	{
    		$sql="SELECT * FROM `carsadd` WHERE `numberplate` = '$numplt' ";
    		$result = mysqli_query($conn,$sql);
            $flag = mysqli_affected_rows($conn);
            if($flag == 1)
            {
                return $result;
                echo "The record has been updated successfully!<br>";
            }
            else
            {
    			echo mysqli_error($conn);
                return null;
                echo "The record was not updated successfully.<br>";

            }
    	}

    // TO update car data for addcars
    function Updatecardata($conn,$numberplate,$kms,$stars)
    {
        $d=getcardata($conn,$numberplate);
        if(isset($d))
        {
            $d=mysqli_fetch_assoc($d);
            $s=$d['served']+1;
            $st=($d['stars']+$stars)/2;
            $sql = "UPDATE  `carsadd` set `kms` = '$kms', `stars` = '$st', `served` = '$s' WHERE `numberplate` = '$numberplate'";
            $result = mysqli_query($conn,$sql);
            $flag = mysqli_affected_rows($conn);
            if($flag == 1)
            {
                return True;
                echo "The record has been updated successfully!<br>";
            }
            else
            {
                return False;
                echo "The record was not updated successfully.<br>";
                echo mysqli_error($conn);
            }
        }
        else
        {
            return False;
        }
    }

    // To fetch additional car data from the database
    function Displaycardata($conn,$numberplate)
    {
        $sql = "SELECT * FROM `carsadd` WHERE `numberplate` = '$numberplate'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        //echo mysqli_fetch_array($result)[0];
        if($flag == 1)
        {
            return $result;
            //echo "Data fetched successfully!<br>";
        }
        else
        {
            // echo "Data could not be fetched, either the car is on rent or does not exist.<br>";
            echo mysqli_error($conn);
            return null;
        }
    }

    // To fetch data from the rentals database
    function getrentaldata($conn,$numplt)
    {
        $sql = "SELECT * FROM `rentals` WHERE `numberplate` = '$numplt'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        //echo mysqli_fetch_array($result)[0];
        if($flag == 1)
        {
            return $result;
            //echo "Data fetched successfully!<br>";
        }
        else
        {
            // echo "Data could not be fetched, either the car is on rent or does not exist.<br>";
            echo mysqli_error($conn);
            return null;
        }
    }

    // To delete data from the rentals database
    function Deleterentals($conn,$numplate)
    {
         $sql = "DELETE FROM `rentals` WHERE `numberplate` = '$numplate'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);

        if($flag == 1)
        {
            return True;
            //echo "The record has been inserted successfully!<br>";
        }
        else
        {

            // echo "The record was not inserted successfully.<br>";
            echo mysqli_error($conn);
            return False;
        }
    }

    // To update the data into the rentals database
    function Overwriterentals($conn,$empid,$billno,$kms,$dorental,$doreturn,$advance,$total)
    {
        $sql = "UPDATE `rentals` set `empid` = '$empid', `kms` = '$kms', `dorental` = '$dorental', `doreturn` = '$doreturn', `advance` = '$advance', `total` = '$total' WHERE `billno` = '$billno'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            return True;
            //echo "The record has been updated successfully!<br>";
        }
        else
        {
            //echo "The record was not updated successfully.<br>";
            echo mysqli_error($conn);
            return False;
        }
    }

    // To insert data into the billing table
    function Bill($conn,$rentername,$rentermobile,$renterlicense,$numberplate,$rentalempid,$returnempid,$rentalkms,$returnkms,$dorental,$doreturn,$doreturnact,$advance,$total,$damage,$finaltotal)
    {
        $sql = "INSERT INTO `billing` (`rentername`, `rentermobile`, `renterlicense`, `numberplate`, `rentalempid`, `returnempid`, `rentalkms`, `returnkms`, `dorental`, `doreturn`, `doreturnact`, `advance`, `total`, `damage`, `finaltotal`) VALUES ('$rentername','$rentermobile','$renterlicense','$numberplate','$rentalempid','$returnempid','$rentalkms','$returnkms','$dorental','$doreturn','$doreturnact','$advance','$total','$damage','$finaltotal')";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        echo mysqli_error($conn);
        $sql = "UPDATE `cars` set `rented` = 0 WHERE `numberplate` = '$numberplate'";
        $result2 = mysqli_query($conn,$sql);
        $flag2 = mysqli_affected_rows($conn);
        //echo $flag . "<br>" . $flag2;
        if($flag == 1  &&  $flag2 == 1)
        {
            return True;
            //echo "The record has been inserted successfully!<br>";
        }
        else
        {
            return False;
            //echo "The record was not inserted successfully.<br>";
            //echo mysqli_error($conn);
            //return False;
        }
    }

    // To update data in the billing table
    function Updatebill($conn,$billno,$returnempid,$returnkms,$doreturnact,$damage,$finaltotal)
    {
        $sql = "UPDATE `billing` set `returnempid` = '$returnempid', `returnkms` = '$returnkms', `doreturnact` = '$doreturnact', `damage` = '$damage', `finaltotal` = '$finaltotal' WHERE `billno` = '$billno'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            return True;
            //echo "The record has been updated successfully!<br>";
        }
        else
        {
            //return False;
            //echo "The record was not updated successfully.<br>";
            echo mysqli_error($conn);
            return False;
        }
    }
?>