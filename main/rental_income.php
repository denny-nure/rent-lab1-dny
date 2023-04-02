<?php
require_once '../connect.php';

if(isset($_POST['date'])){
  $date = $_POST['date']; // Get the selected date from POST

  // Prepare SQL query to get rental income as of selected date
  $sql = "SELECT SUM(Cost) AS total_rental_income FROM rent WHERE Date_start <= :date AND Date_end >= :date";

  $stmt = $dbh->prepare($sql); // Initialize prepared statement
  $stmt->bindParam(':date', $date, PDO::PARAM_STR); // Bind the value to :date parameter
  $stmt->execute(); // Execute the prepared statement
  $result = $stmt->fetch(PDO::FETCH_ASSOC); // Store the result as an associative array

  if($result['total_rental_income']){
    // Output the total rental income received as of the selected date
    echo "<h4>Rental income received as of $date: $" . $result['total_rental_income'] . "</h4>";
  } else {
    // If there is no rental income received as of the selected date
    echo "<h4>No rental income received as of $date</h4>";
  }
}

$dbh = null; // Close the database connection
?>
