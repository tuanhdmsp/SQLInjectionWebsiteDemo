<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Login Page</title>
	<style>
		body{
			background: #eee;
		}
		#frame{
			border: solid gray 1px;
			width: 20%;
			border-radius: 5px;
			margin: 100px auto;
			background: white;
			padding: 50px;
		}
		#btnLogin{
			color: #fff;
			background: #337ab7;
			padding: 5px;
			margin-left: 45%;
		}
	</style>
</head>
<body>
	<div id="frame">
        <?php
            if (isset($_GET['msg'])){
                $mess = $_GET['msg'];
                print("<font color='red'>Invalid username or password</font>");
            }
        ?>
		<form action="process.php" method="post">
			<p>
				<label>Username:</label>
                <input type="text" name="txtUsername" id="txtUsername" value="" />
			</p>			
			<p>
				<label>Password:</label>
                <input type="password" name="txtPassword" id="txtPassword" value="" />
			</p>
			<p>
                <input type="submit" value="Login" id="btnLogin" />
			</p>			
		</form>
	</div>
</body>
</html>
