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
            echo "The record has been inserted successfully!<br>";
        }
        else
        {
            echo "The record was not inserted successfully.<br>";
            mysqli_error($conn);
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
            
            mysqli_error($conn);
			return False;
        }
    }

    // To update password of any employee in the list
    function Updateemployees($conn,$empid,$pass)
         {
             $sql = "UPDATE `employees` set `password`='$pass' WHERE `empid`='$empid'";
             $result = mysqli_query($conn,$sql);
             if($result)
             {
                 echo "The record has been updated successfully!<br>";
             }
             else
             {
                 echo "The record was not updated successfully.<br>";
                 mysqli_error($conn);
             }
         }

    // To change position of an employee in the list (Only accessible by Manager/Admin)
    function Promoteemployees($conn,$empid,$position)
    {
        $sql = "UPDATE `employees` set `role`='$position' WHERE `empid`='$empid'";
        $result = mysqli_query($conn,$sql);
        if($result)
        {
            echo "The record has been updated successfully!<br>";
        }
        else
        {
            echo "The record was not updated successfully.<br>";
            mysqli_error($conn);
        }
    }

    function Login($conn,$uname,$pass)
    {
        $sql = "SELECT `role` FROM `employees` WHERE `username`='$uname' AND `password` = '$pass'";  //updated
        $result = mysqli_query($conn,$sql);
        if($result)
        {
            echo "Login Successful!<br>";
			return (int)$result; // returning the role;      //updated
        }
        else
        {
            echo "Please check the login details again.<br>";
           echo  mysqli_error($conn);
			return -1; //if connection fails
        }
    }

    // To add to users to the database
    function Newusers($conn,$custname,$custmobno,$custlicno)
    {

    }

    //
    function ()
    {

    }
?>