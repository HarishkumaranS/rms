<?php
$con = mysqli_connect("Localhost", "root", "", "rms");
if(!$con)
{
    die("connection Failed: ".mysqli_connect_error());
}
?>