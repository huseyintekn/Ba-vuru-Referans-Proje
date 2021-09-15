<?php
require_once 'database.php';

if (isset($_GET)){
    $sql = "SELECT * FROM application_reference";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $arr = array();
        while ($rows = $result->fetch_assoc()){
            $arr[] = $rows;
        }
        echo json_encode($arr);
    } else {
        echo "0 sonuç";
    }
}