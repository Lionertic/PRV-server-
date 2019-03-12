<?php
include '../DbConnect.php';

$response = array();

function generateKey($con){
  $keyLenght=16;
  $str="1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $randStr = substr(str_shuffle($str),0,$keyLenght);

  $checkKey = checkKeys($con,$randStr);

  while ($checkKey) {
    $randStr = substr(str_shuffle($str),0,$keyLenght);
    $checkKey = checkKeys($con,$randStr);
  }

  $result = mysqli_query($con,"insert into uikeys(uiKey) values('$randStr')");

  return $randStr;
}

function checkKeys($con,$str){
  $sql = "select * from uikeys where uiKey=''$str'";
  $result = mysqli_query($con,$sql);
  if (!empty($result))
      if (mysqli_num_rows($result) == 0)
        while($row = mysqli_fetch_assoc($result))
          if(strcmp($row['uiKey'],$str)==0)
              return false;
          else
            return true;
}


function updateUIkey($con,$str){
	$tempkey = generateKey($con);
	$result = mysqli_query($con,"update user set uiKey = '$tempkey' where id='$str'");
	if($result)
		return $tempkey;
	else
		return 'error';
}


if (isset($_POST['mob'])&& isset($_POST['pass'])) {
    $mob = $_POST['mob'];
    $pass = $_POST['pass'];
    $result = mysqli_query($con,"select * from user where id='$mob'and pass='$pass'");

    if(!empty($result)){
      //$temp = updateUIkey($con,$mob)
       	if($row=mysqli_fetch_assoc($result)){
          $key = updateUIkey($con,$mob);
          $response["success"] = 1	;
          $response["KEY"] = $key;
          $response["ID"] = $mob;
        }
        else{
          $response["success"] = 2;
          $response["message"] = "Something went wrong";
        }
      echo json_encode($response);
    
  }
    else {
      $response["success"] = 0;
      $response["message"] = "No User found";

      echo json_encode($response);
    }
}
 else {
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    echo json_encode($response);
}

?>
