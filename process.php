<?php
session_start();
$username = $_POST['txtUsername'];
$password = $_POST['txtPassword'];

// connect db
//$query3 = "SELECT * FROM Customer WHERE username = '$username' AND password = '$password'";
try {
	$conn = new PDO("sqlsrv:server = tcp:records.database.windows.net,1433; Database = records", "tuanhdse62146", "Hoangtuan357159");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("SELECT * FROM Customer WHERE username = :username AND password = :password ");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
	$row = $stmt->fetch();
	if ($row > 0){
		$_SESSION['logged_in'] = true;
		$_SESSION['customerID'] = $row['customerID'];
        header("Location:menu.php");
	} else {
        header("Location:index.php?msg='Invalid password or username'");
    }
	$conn = NULL;
}
catch (PDOException $e) {
	print("Error connecting to SQL Server.");
}

?>