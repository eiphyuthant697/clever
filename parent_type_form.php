
  <?php 

    $servername = "localhost";
    $username = "cp557932_estate";
    $password = "LwjIXwY3llM^";
    $dbname = "cp557932_estate";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
$conn->set_charset("utf8");

    $sql = "SELECT * FROM wp_terms WHERE term_id IN (SELECT term_id FROM wp_term_taxonomy WHERE taxonomy='property-type')";
    
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { 
        ?>
        <option value="">Select Property Type</option>
        <?php
        while($row = $result->fetch_assoc()) {
        
        ?><option value='<?php echo $row["name"]; ?>'><?php echo $row["name"]; ?></option>
        <?php }
    } 
    $conn->close();
//}
?>
  