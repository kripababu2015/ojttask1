<!DOCTYPE html>
<html>
<head>
	<title>registration form</title>
</head>
<body>
	<h1>Registration Form</h1>
	
	<form method="post" action="<?php echo base_url()?>main1/register">
	<table>
		<tr><td>First Name</td><td><input type="text" name="fname" required="required" maxlength="25" pattern="[a-zA-Z]+"></td></tr>
		<tr><td>Last Name</td><td><input type="text" name="lname"  required="required" maxlength="25" pattern="[a-zA-Z]+"></td></tr>
		<tr><td>Mobile Number</td><td><input type="text" name="phno" required="required" pattern="[7-9]{1}[0-9]{9}"></td></tr>
		<tr><td>EmailId</td><td><input type="email" name="email"></td></tr>
		<tr><td>User Name</td><td><input type="text" name="uname" required="required" maxlength="25" pattern="[a-zA-Z0-9]+"></td></tr>
		<tr><td>Password</td><td><input type="password" name="password"  required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"></td></tr>
		<tr><td></td><td><input type="submit" name="submit"></td></tr>
	</table>
	</form>

</body>
</html>