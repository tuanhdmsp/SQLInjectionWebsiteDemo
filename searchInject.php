<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search Page</title>
</head>
<body>
    <h2>Search by Records ID</h2>
    <form action="searchInject.php" method="get">
        <input type="text" name="txtSearchValue" size="50" />
        <input type="submit" value="Search" />
    </form>
    <hr />
    <?php
    session_start();
    if (!isset($_SESSION['customerID'])){
        //header("Location:index.php");
    }
    $txtSearchValue = $_GET["txtSearchValue"];
    $customerID = $_SESSION['customerID'];
    //$query = "SELECT * FROM Records WHERE recordID = '$txtSearchValue' AND customerID = '$customerID'";
    try {
        $conn = new PDO("sqlsrv:server = tcp:records.database.windows.net,1433; Database = records", "tuanhdse62146", "Hoangtuan357159");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*
        $stmt = $conn->prepare("SELECT * FROM Records WHERE recordID = :recordID AND customerID = :customerID");
        $stmt->bindParam(":recordID", $txtSearchValue);
        $stmt->bindParam(":customerID", $customerID);
        $stmt->execute();
         */

        $stmt = $conn->query("SELECT * FROM Records WHERE recordID = '$txtSearchValue' AND customerID = '$customerID'");


        $row = $stmt->fetch();
        if ($row > 0){
            $query2 = "SELECT * FROM Type WHERE typeID = '$row[2]'";
            $stmt2 = $conn->query("$query2");
            $row2 = $stmt2->fetch();
            echo '<table style="width:500px;border:1px solid green;">
						<tr>
							<td style="border:1px solid blue">Records ID</td>
							<td style="border:1px solid blue">'.$row[0].'</td>
						</tr>
						<tr>
							<td style="border:1px solid blue">Type Name</td>
							<td style="border:1px solid blue">'.$row2[1].'</td>
						</tr>
						<tr>
							<td style="border:1px solid blue">Details</td>
							<td style="border:1px solid blue">'.$row[3].'</td>
						</tr>
						<tr>
							<td style="border:1px solid blue">Date</td>
							<td style="border:1px solid blue">'.$row[4].'</td>
						</tr>
					</table>';
        } else if ($row == 0 && $txtSearchValue != null) {
            print("<font color='red'>No Record is Matched</font>");
        }
        $conn = NULL;
    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
    }
    ?>
</body>
</html>