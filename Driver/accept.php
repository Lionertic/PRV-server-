<?php
include '../DbConnect.php';

if (isset($_POST['ans'])&&isset($_POST['key'])) {
  $ans=$_POST['ans'];
  $key=$_POST['key'];
  $sql="update driver set noDrive='$ans' where uiKey='$key'";
  $result = mysqli_query($con,$sql);
  if($result){
    $response["success"] = 1;
    $response["message"] = "Success";
  }
  else {
    $response["success"] = 0;
    $response["message"] = "Error";
  }
    echo json_encode($response);
}
else {
  $response["success"] = 0;
  $response["message"] = "Required field(s) is missing";
  echo json_encode($response);
}
?>
