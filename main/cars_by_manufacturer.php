<?php
    include '../connect.php';

    if(isset($_POST['btn'])) {
        $manufacturer_id = $_POST['manufacturer']; // Get selected manufacturer from POST
        
        // Prepare SQL query to get the cars by the selected manufacturer
        $sql = 'SELECT ID_Cars, Name, Release_date, Race, Price FROM cars WHERE FID_Vendors = :manufacturer_id';

        $sth = $dbh->prepare($sql); // Initialize prepared statement
        $sth->bindValue(':manufacturer_id', $manufacturer_id); // Bind the value to :manufacturer_id parameter
        $sth->execute(); // Execute the prepared statement
        $cars = $sth->fetchAll(PDO::FETCH_ASSOC); // Store the result as an associative array

        // Output the result
        echo '<h4>Cars by manufacturer</h4>';
        echo '<table>';
        echo '<tr><th>ID</th><th>Name</th><th>Release Date</th><th>Race</th><th>Price</th></tr>';
        foreach($cars as $car) {
            echo '<tr>';
            echo '<td>'.$car['ID_Cars'].'</td>';
            echo '<td>'.$car['Name'].'</td>';
            echo '<td>'.$car['Release_date'].'</td>';
            echo '<td>'.$car['Race'].'</td>';
            echo '<td>$'.$car['Price'].'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    // Close the database connection
    $dbh = null;
?>
