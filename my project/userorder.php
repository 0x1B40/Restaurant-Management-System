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

if($row['authority'] !='customer')
die("your are not authorized to access this page, only normal users can.");
}

// validation should be Client side

?>

<html>
<header>
  <title>
    Order Page
  </title>
</header>


<body>

<?php

// orders  , an orderid, basketid,userid

$sql ="select * from menuorder where userid='$userid'"; // access the basket
$rows = $db->query($sql);



echo "<table class='table table-borderless table-warning table-hover'>";
echo "<th> Order ID </th> View Order <th> Status  </th> <th> Re-Order </th>";
foreach($rows as $row)
{
  $orderID = $row['orderid'];
  $orderStatus=$row['orderstatus'];
  $basketID = $row['basketid'];
echo "<form method='post' action='orderedbasket.php'>";
echo "<tr> <td> $orderID </td>";
echo " <td> <button type='submit' name='viewButton' value='$basketID'> View </button> </td> ";
echo "<td> $orderStatus </td>" ;

echo "</form>";
echo "<form method ='post' action='userorder.php'>";
echo "<td> <button type='submit' name='reorderButton' value='$basketID'> Re-Order </button> </td>";
echo "</form>";
echo "  </tr>";

}
echo "<tr>";
echo " <form method='post' action='index.php'> ";
echo " <td> <button type='submit'> main menu </button> </td> ";
echo "</tr>";
echo "</form>";
echo "</table>";




extract($_POST);

if(isset($reorderButton))
{

  $sql = "INSERT INTO menuorder VALUES (NULL,$reorderButton,$userid,'awaiting')"; // use $userid to select the basket and insert new order

  $db->query($sql);




  echo "<p class='green'> order placed successfully. Refresh page to view. </p>";




}



$db->connection =null;

?>




</body>



</html>
