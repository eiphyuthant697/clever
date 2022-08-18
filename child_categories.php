  <?php 
//$requestcountry = $_REQUEST['country'];
//trying to bring this $termName value from JS
//if(isset($_REQUEST['selectedParentName'])) {
    $termName = $_REQUEST['selectedParent'];
    //echo $termName;
    $servername = "localhost";
    $username = "cp557932_estate";
    $password = "LwjIXwY3llM^";
    $dbname = "cp557932_estate";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->set_charset("utf8");

    $sql = "SELECT * FROM wp_terms WHERE term_id IN (SELECT term_id FROM wp_term_taxonomy WHERE taxonomy='property-location' AND parent='".$termName."' )";
    
    
    echo $sql;
    $result = $conn->query($sql);
    //print_r( $result->fetch_assoc());

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        
        ?><option value='<?php echo $row["slug"]; ?>'><?php echo $row["name"]; ?></option>
        <?php }
    } 
    $conn->close();
//}
?>
  