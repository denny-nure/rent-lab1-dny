<?php
	include '../connect.php';

	$date = $_POST['date'];		// Pass the date value through POST

	// Prepare SQL query
	$sql = 'SELECT * FROM cars WHERE ID_Cars NOT IN (SELECT FID_Car FROM rent WHERE Date_start <= :date AND Date_end >= :date)';

	$sth = $dbh->prepare($sql);	// Initialize prepared statement
	$sth->bindValue(':date', $date); // Bind the value to :date parameter	
	$sth->execute(); // Execute the prepared statement
	$res = $sth->fetchAll(PDO::FETCH_ASSOC); // Store the result as an array of associative arrays

	// Output the result
	echo '<h4>Available cars as of '.$date.':</h4>';
	echo '<table border="1">';
	echo '<tr><th>ID</th><th>Name</th><th>Release Date</th><th>Race</th><th>State</th><th>Vendor ID</th><th>Price</th></tr>';
	foreach($res as $row) {
		echo '<tr><td>'.$row['ID_Cars'].'</td><td>'.$row['Name'].'</td><td>'.$row['Release_date'].'</td><td>'.$row['Race'].'</td><td>'.$row['State(new,old)'].'</td><td>'.$row['FID_Vendors'].'</td><td>'.$row['Price'].'</td></tr>';
	}
	echo '</table>';

	// Close the database connection
	$dbh = null;
?> 
