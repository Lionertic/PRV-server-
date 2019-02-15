<?php
include '../DbConnect.php';
$response = array();

// check for required fields
if (isset($_GET['Lat'])&& isset($_GET['Lon'])&&isset($_GET['key'])) {

    $Lat = $_GET['Lat'];
    $Lon = $_GET['Lon'];
    $key = $_GET['key'];

    $result = mysqli_query($con,"update driver set lat='$Lat', lon='$Lon' where uiKey = '$key'");

    if ($result) {
        $response["success"] = 1;
        $response["message"] = "Product successfully created.";

        echo json_encode($response);
    } else {
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";

        echo json_encode($response);
    }
}
 else {
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    echo json_encode($response);
}

?>
