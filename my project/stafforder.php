<?php
// and it will do session_start()
require("head.php");
require("navigation.php");

if(!isset($_SESSION['logged']))
die("you need to login to access this page");
else {
$userid = $_SESSION['logged'];
$sql = "select * from users where id=$userid";
$rows = $db->query($sql);
$row = $rows->fetch();
if($row['authority'] !='staff')
die("your are not authorized to access this page, only staff users can.");
}

// validation should be Client side

?>


<html>
<header>
  <title>
    Staff Order Page
  </title>
</header>

<body>


  <?php

  // orders  , an orderid, basketid,userid

  $sql ="select * from menuorder where orderStatus!='complete'"; // access the basket
  $rows = $db->query($sql);

 // use these two


  echo "<table class='table table-borderless table-warning table-hover'>";
  echo "<th> Order ID </th>  <th> Status  </th> <th> acknowledge button </th> <th> in-process button </th> <th> in-transit button </th>";
  foreach($rows as $row)
  {
    $orderID = $row['orderid'];
    $orderStatus=$row['orderstatus'];

echo "<form method ='post' action='stafforder.php'>";
  echo "<tr> <td> $orderID </td>";
  echo "<td> $orderStatus </td>" ;
  echo "<td> <button type='submit' name='acknowledgeButton' value='$orderID'> Acknowledge </button> </td>";
  echo "<td> <button type='submit' name='inprocessButton' value='$orderID'> In-Process </button> </td>";
  echo "<td> <button type='submit' name='intransitButton' value='$orderID'> In-Transit </button> </td>";
  echo "<td> <button type='submit' name='completeButton' value='$orderID'> Complete </button> </td>";


  echo "</form>";
  echo "  </tr>";

  }

echo "<tr>";
echo "<form method='post' action='index.php'>";
echo "<td>";
echo "<button type='submit'> main menu </button>";
echo "</td>";
echo "</form>";
echo "</tr>";
  echo "</table>";


  extract($_POST);

  if(isset($acknowledgeButton))
  {

    $sql = "UPDATE menuorder set orderstatus='acknowledged'  where orderid=$acknowledgeButton";

     $db->query($sql);




  }

  if(isset($inprocessButton))
  {
    $sql = "UPDATE menuorder set orderstatus='in-process' where orderid=$inprocessButton";

     $db->query($sql);




  }

  if(isset($intransitButton))
  {
    $sql = "UPDATE menuorder set orderstatus='in-transit'  where orderid=$intransitButton";

     $db->query($sql);




  }

  if(isset($completeButton))
  {
    $sql = "UPDATE  menuorder set orderstatus='complete'  where orderid=$completeButton";

     $db->query($sql);




  }
if(isset($acknowledgeButton)|| isset($inprocessButton) || isset($intransitButton) || isset($completeButton))
{
echo "<table class='table table-borderless table-warning table-hover'>";
echo "<tr><td> <p class='green'> order updated </p> </td> <td> <form action='stafforder.php'> <button type='submit'> Refresh </button></form> </td></tr>";
echo "</table>";
}




  $db->connection =null;

  ?>








</body>




</html>
