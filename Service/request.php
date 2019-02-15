<?php
include '../DbConnect.php';
include '../php.php';

function generateKey($con,$user){
  $keyLenght=16;
  $str="1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $randStr = substr(str_shuffle($str),0,$keyLenght);

  $checkKey = checkKeys($con,$randStr);

  while ($checkKey) {
    $randStr = substr(str_shuffle($str),0,$keyLenght);
    $checkKey = checkKeys($con,$randStr);
  }

  $result = mysqli_query($con,"insert into current(id,reqKey,driKey1,driKey2,status) values('$randStr','$user','0','0','On Process')");

  return $randStr;
}

function checkKeys($con,$str){
  $sql = "select id from current where id=''$str'";
  $result = mysqli_query($con,$sql);
  if (!empty($result))
      if (mysqli_num_rows($result) == 0)
        while($row = mysqli_fetch_assoc($result))
          if(strcmp($row['id'],$str)==0)
              return false;
          else
            return true;
}

$response = array();
$distance = array();
$keys=array();
$max;
if (isset($_GET['lat'])&&isset($_GET['lon'])&&isset($_GET['key'])) {
    $lld1 = new LatLng($_GET['lat'], $_GET['lon']);
    $key=$_GET['key'];
    $sql="select lat,lon,uiKey from driver where onDrive='0'";
    $result = mysqli_query($con,$sql);
    if (!empty($result)) {
      $k=generateKey($con,$key);
      if (mysqli_num_rows($result) > 0){
      while ($row=mysqli_fetch_assoc($result)) {
        $distance[$row['uiKey']]=$lld1->distance(new LatLng($row['lat'],$row['lon']));
      }
          $response["success"] = 1;
          $value=$distance;
          sort($distance);
          if(count($distance)>2){
            $max=2;
          }
          else {
            $max=count($distance);
          }
          for($i=0;$i<count($distance);$i++)
            foreach ($value as $key=>$dist)
                if(($distance[$i]==$dist)&&$distance[$i]<6)
                {
                    array_push($keys,$key);
                    break;
                }
                for($i=1;$i<=$max;$i++){
                  $result = mysqli_query($con,"update current set driKey$i where id = '$k'");
                }
                $response["id"]=$k;
          echo json_encode($response);
      }
      else {
        $response["success"] = 0;
        $response["message"] = "No Driver Found";
        echo json_encode($response);
      }
    }
    else {
      $response["success"] = 0;
      $response["message"] = "An error occured";
      echo json_encode($response);
    }
  }
  else {
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
    echo json_encode($response);
}
?>
