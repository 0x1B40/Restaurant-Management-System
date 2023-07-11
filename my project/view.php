<html>
<header>
  <title> View Item Page</title>
</header>

<body>
<?php
require("head.php");
require("navigation.php");

extract($_POST);
if(!isset($_POST['viewButton']))
die("no id");

$itemID = $_POST['viewButton'];
// using itemID
$sql = "select * from menu where id=$itemID";

$rows = $db->query($sql);
$row = $rows->fetch();

$name = $row['foodname'];
$price = $row['price'];
$description = $row['description'];
$image = $row['image'];

echo "<table class='table table-borderless table-warning table-hover'>";
echo "<tr><td> $name </td> <td>  $price $ </td> ";
echo "<td>";
  echo '<img width="100" height="100" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>';
echo "</td>";
echo "</tr>";

echo "</table>";
echo "</br>";


echo "<table class='table table-borderless table-warning table-hover'>";
echo "<tr> <td> <p> $description </p> </td></tr>";
echo "<tr>";
echo " <td> <form method='post' action='browse.php'> <button type='submit'> back to browse </button> </form> </td> <td> <form method='post' action='index.php'>  <button type='submit'> back to main menu</button> </form> </td> ";
echo "</tr>";
echo "</table>";




$db->conection= null;
?>

</body>


</html>
