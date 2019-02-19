<?php
include '../DbConnect.php';
$response = array();

// check for required fields
if (isset($_POST['lat'])&& isset($_POST['lon'])&&isset($_POST['key'])) {

    $Lat = $_POST['lat'];
    $Lon = $_POST['lon'];
    $key = $_POST['key'];

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
