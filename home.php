<html>
<style>
div {
  width: 30%;
  height: 30%;
  background-color: skyblue;
 
  position: relative;
  top: 25%;
  left: 30%;
  padding: 50px;
  border-radius:20px;
  
  

}
</style>
<body>
<div>
<form method='POST' action="<?php echo $_SERVER['PHP_SELF'];?>">

<b>Enter Username:</b> <input type='text' name='uname'></input>
<br>
<br>
<b>Enter Password:</b> <input type='text' name='pass'></input>
<br>

<b>Select Your Role: <br>
<input type='radio' value='Employee' name='role' checked >Employee</input><br>
<input type='radio' value='Manager' name='role' >Manager</input><br><br>

<input type='submit' value='login' name='signin'></input>

</form>
</div>
</body>
</html>