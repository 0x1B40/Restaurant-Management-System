
<?php
// and it will do session_start()
require("head.php");
require("navigation.php");
$userid = $_SESSION["logged"];

// validation should be Client side
// buttons are always client side ( i think)

?>


<html>

<header>
  <title>
    Browse Menu
  </title>
</header>



<body>

<form method='post' action='search.php'>
<table class='table table-borderless table-warning table-hover'>
<tr><td> Select Menu: </td>
   <td> <input type='text' name='search' id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">  </input>  </td>
<td>
</form>


</td>

<td> <form method='post' action='basket.php'  ><input type='submit' value='Go to Basket'> </form> </td>
<td> <form method='post' action='index.php' > <button type='submit'> back to home page</button> </form></td>
  </tr>


</table>




<?php
// menu table
// id, foodname, price,catagory, description




$sql = "select * from menu";
$rows = $db->query($sql);


echo "<table id='myTable' class='table table-borderless table-warning table-hover' >";
echo "<th> Name  </th> <th> Price </th> ";

foreach($rows as $row)
{
echo "<form method= 'post' action='view.php'>";
  $id = $row['id'];
  $foodName = $row['foodname'];
  $price = $row['price'];
  $image = $row['image'];
  $catagory = $row['catagory'];
  echo "<tr> <td> $foodName </td> <td> $price </td> <td> <button type ='submit' name='viewButton' value='$id'   > View </button> </td>  ";
  echo "<td> $catagory </td>";
  echo '<td> <img width="100" height="100" src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>  </td>   ';


  echo "  </tr> ";

}


echo "</table>";

$db->connection = null;
?>


<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>



</body>



</html>
