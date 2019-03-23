<?php
include '../DbConnect.php';
$response = array();

function checkKeys($con,$str,$str1){
  global $response;
  $sql = "select uiKey from user where id='$str1'";
  $result = mysqli_query($con,$sql);
  if (!empty($result))
      if (mysqli_num_rows($result) > 0)
        while($row = mysqli_fetch_assoc($result))
          if(strcmp($row['uiKey'],$str)!=0)
            return false;
          else
            return true;
}

if (isset($_POST['key'])&&isset($_POST['id'])) {
    $key = $_POST['key'];
    $iid = $_POST['id'];
    $check=checkKeys($con,$key,$iid);
    if ($check) {
        $response["success"] = 1;
        $response["message"] = "Login";

        echo json_encode($response);
    } else {
        $response["success"] = 0;
        $response["message"] = "Error in login";

        echo json_encode($response);
    }
}
 else {
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    echo json_encode($response);
}

?>
