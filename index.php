<html>

<body>
<?php
session_start();
session_destroy();
?>
<form name="f1" method="POST" action="show.php">
Username : <input type="text" name="uname"><br/>
Password : <input type="password" name="pword"></br>
<input type="submit" value="Submit"><input type="reset" value="Reset">
</form>
</body>
</html>