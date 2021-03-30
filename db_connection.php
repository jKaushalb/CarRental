<?php

    function OpenCon()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "lamp";

        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
        return $conn;
    }

    function CloseCon($conn)
     {
        $conn -> close();
     }

    // To add an employee to the list (Only accessible by Manager/Admin)
    function Insertemployees($conn,$user,$pass,$position)
    {
        $sql = "INSERT INTO `employees` (`empid`, `username`, `password`, `role`) VALUES (NULL,'$user','$pass','$position')";
        $result = mysqli_query($conn,$sql);
        if($result)
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

    // To delete an employee from the list (Only accessible by Manager/Admin)
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

    // To update password of any employee in the list
    function Updateemployees($conn,$empid,$pass)
         {
             $sql = "UPDATE `employees` set `password`='$pass' WHERE `empid`='$empid'";
             $result = mysqli_query($conn,$sql);
			 $r=mysqli_affected_rows($conn);
             if($r==1)
             {
				 return True;
                 echo "The record has been updated successfully!<br>";
             }
             else
             {
                 //echo "The record was not updated successfully.<br>";
                 echo mysqli_error($conn);
				 return False;
             }
         }

    // To change position of an employee in the list (Only accessible by Manager/Admin)
    function Promoteemployees($conn,$empid,$position)
    {
        $sql = "UPDATE `employees` set `role`='$position' WHERE `empid`='$empid'";
        $result = mysqli_query($conn,$sql);
		 $r=mysqli_affected_rows($conn);
        if($r==1)
        {
			return True;
            echo "The record has been updated successfully!<br>";
        }
        else
        {
            //echo "The record was not updated successfully.<br>";
			
            echo mysqli_error($conn);
			return False;
        }
    }
	function eid($conn,$uname,$pass)
	{
		$sql = "SELECT `empid` FROM `employees` WHERE `username`='$uname' AND `password` = '$pass'";  //updated
        $result = mysqli_query($conn,$sql);
		$flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
			return (int)mysqli_fetch_array($result)[0];
            echo "The record has been inserted successfully!<br>";
        }
        else
        {
            //echo "The record was not inserted successfully.<br>";
            echo mysqli_error($conn);
			return False;
        }
	}
    function Login($conn,$uname,$pass)
    {
        $sql = "SELECT `role` FROM `employees` WHERE `username`='$uname' AND `password` = '$pass'";  //updated
        $result = mysqli_query($conn,$sql);
        if($result)
        {
            echo "Login Successful!<br>";
			return (int)mysqli_fetch_array($result)[0]; // returning the role;      //updated
        }
        else
        {
            echo "Please check the login details again.<br>";
           echo  mysqli_error($conn);
			return -1; //if connection fails
        }
    }
	/////////////////////////////////////////////////////////////////////////
	
	 function Insertcars($conn,$brand,$model,$numplate,$price,$desc,$img)
    {
        $sql = "INSERT INTO `cars` ( `brandname`, `modelname`,  `numberplate`,  `price`, `description`, `image`, `rented`) VALUES ('$brand','$model','$numplate','$price', '$desc', '$img',0)";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
			return True;
            echo "The record has been inserted successfully!<br>";
        }
        else
        {
            //echo "The record was not inserted successfully.<br>";
            echo mysqli_error($conn);
			return False;
        }
    }

    // To delete a car from the database
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

    // To find the car details
    function Findcars($conn,$numplate)
    {
        $sql = "SELECT * FROM `cars` WHERE `rented` != 1 AND `numberplate` = '$numplate'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
			return $result;
            echo "Data fetched successfully!<br>";
        }
        else
        {
            //echo "Data could not be fetched, either the car is on rent or does not exist.<br>";
            echo mysqli_error($conn);
			return null;
        }
    }

    // To update car details without image
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

    // To update car details with image
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

    // To insert new user database
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
    // To find the users data
    function Findusers($conn,$clientlicense)
    {
        $sql = "SELECT * FROM `users` WHERE `clientlicense` = '$clientlicense'";
        $result = mysqli_query($conn,$sql);
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
			return null;
        }
    }


    // To update the user data
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
	
	
	
	
	
	////////////////////////////////////////////////////////////////////////
	function Insertcardata($conn,$numberplate,$carname,$mileage,$kms)
    {
        $sql = "INSERT INTO `carsadd` ( `numberplate`, `carname`, `mileage`, `kms`) VALUES ('$numberplate','$carname','$mileage','$kms')";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            return True;
            echo "The record has been inserted successfully!<br>";
        }
        else
        {
            return False;
            echo "The record was not inserted successfully.<br>";
            echo mysqli_error($conn);
        }
    }

    // TO update car data for addcars
    function Updatecardata($conn,$numberplate,$kms,$stars,$served)
    {
        $sql = "UPDATE  `carsadd` set `kms` = '$kms', `stars` = '$stars', `served` = '$served' WHERE `numberplate` = '$numberplate'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            //return True;
            echo "The record has been updated successfully!<br>";
        }
        else
        {
            //return False;
            echo "The record was not updated successfully.<br>";
            echo mysqli_error($conn);
        }
    }

    // To fetch car data for addcars
    function Displaycardata($conn,$numberplate)
    {
        $sql = "SELECT * FROM `carsadd` WHERE `numberplate` = '$numberplate'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
		//echo mysqli_fetch_array($result)[0];
		
        if($flag == 1)
        {
            return $result;
            echo "Data fetched successfully!<br>";
        }
        else
        {
            //
           // echo "Data could not be fetched, either the car is on rent or does not exist.<br>";
            echo mysqli_error($conn);
			return null;
        }
    }
	
	############################################################################################
	
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

    // To update the car rental data in rentals table (Only accessible by Manager/Admin)
    function Overwriterentals($conn,$empid,$billno,$kms,$dorental,$doreturn,$advance,$total)
    {
        $sql = "UPDATE `rentals` set `empid` = '$empid', `kms` = '$kms', `dorental` = '$dorental', `doreturn` = '$doreturn', `advance` = '$advance', `total` = '$total' WHERE `billno` = '$billno'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            return True;
            echo "The record has been updated successfully!<br>";
        }
        else
        {
            //
           // echo "The record was not updated successfully.<br>";
            echo mysqli_error($conn);
			return False;
        }
    }

    // To create final bill for rental in billing database
    function Bill($conn,$billno,$rentername,$rentermobile,$renterlicense,$numberplate,$rentalempid,$returnempid,$rentalkms,$returnkms,$dorental,$doreturn,$doreturnact,$advance,$total,$damage,$finaltotal)
    {
        $sql = "INSERT INTO `billing` (`billno`, `rentername`, `rentermobile`, `renterlicense`, `numberplate`, `rentalempid`, `returnempid`, `rentalkms`, `returnkms`, `dorental`, `doreturn`, `doreturnact`, `advance`, `total`, `damage`, `finaltotal`) VALUES ('$billno','$rentername','$rentermobile','$renterlicense','$numberplate','$rentalempid','$returnempid','$rentalkms','$returnkms','$dorental','$doreturn','$doreturnact','$advance','$total','$damage','$finaltotal')";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        $sql = "UPDATE `cars` set `rented` = 0 WHERE `numberplate` = '$numberplate'";
        $result2 = mysqli_query($conn,$sql);
        $flag2 = mysqli_affected_rows($conn);
        if($flag == 1 && $flag2 == 1)
        {
            return True;
            echo "The record has been inserted successfully!<br>";
        }
        else
        {
            //return False;
            //echo "The record was not inserted successfully.<br>";
            echo mysqli_error($conn);
			return False;
        }
    }

    // To update final bill (Only accessible by Manager/Admin)
    function Updatebill($conn,$billno,$returnempid,$returnkms,$doreturnact,$damage,$finaltotal)
    {
        $sql = "UPDATE `billing` set `returnempid` = '$returnempid', `returnkms` = '$returnkms', `doreturnact` = '$doreturnact', `damage` = '$damage', `finaltotal` = '$finaltotal' WHERE `billno` = '$billno'";
        $result = mysqli_query($conn,$sql);
        $flag = mysqli_affected_rows($conn);
        if($flag == 1)
        {
            return True;
            echo "The record has been updated successfully!<br>";
        }
        else
        {
            //return False;
            //echo "The record was not updated successfully.<br>";
            echo mysqli_error($conn);
			return False;
        }
    }
	
	
	
	##############################################################################################
	
	
?>