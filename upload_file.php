<?php
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  }
else
  $allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 200000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload_img/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload_img/" . $_FILES["file"]["name"];
      $filename="upload_img/".$_FILES["file"]["name"];
      list($width, $height) = getimagesize($filename);
      $percent=500/$width;
      $newwidth = $width * $percent;
      $newheight = $height * $percent;
      $rsr_org = imagecreatefromjpeg($filename);
      $rsr_scl = imagescale($rsr_org, $newwidth, $newheight,  IMG_BICUBIC_FIXED);
      imagejpeg($rsr_scl, "upload_img/imagebfb.jpg");
      imagedestroy($rsr_org);
      imagedestroy($rsr_scl);
      }
    }
  }
else
  {
  echo "Invalid file";
  }

?>