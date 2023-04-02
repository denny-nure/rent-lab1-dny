<?php 
	include 'connect.php';	// Подключаем файл connect.php для работы с БД
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Rent</title>
</head>
<body>
	<div class="forms">
		<form action="main/rental_income.php" method="post">
			<p>Select date for rent income:</p>
			<input type="date" name="date">
			<input type="submit" name="btn" value="Submit">
		</form>
        <form action="main/cars_by_manufacturer.php" method="post">
            <p>Select manufacturer:</p>
            <select name="manufacturer">
            <?php
                // Prepare SQL query to get the list of manufacturers
                $sql = "SELECT ID_Vendors, Name FROM vendors";
                $sth = $dbh->prepare($sql); // Initialize prepared statement
                $sth->execute(); // Execute the prepared statement
                $manufacturers = $sth->fetchAll(PDO::FETCH_ASSOC); // Store the result as an associative array
                // Output the dropdown of manufacturers
                foreach($manufacturers as $manufacturer) {
                    echo '<option value="'.$manufacturer["ID_Vendors"].'">'.$manufacturer["Name"].'</option>';
                }
            ?>
        </select>
            <input type="submit" name="btn" value="Submit">
        </form>
		<form action="main/available_cars.php" method="post">
			<p>Select date for rent:</p>
			<input type="date" name="date">
			<input type="submit" name="btn" value="Submit">
		</form>
	</div>
</body>
</html>
