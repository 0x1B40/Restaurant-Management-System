
<?php

require("connection.php");
if(isset($_SESSION["logged"]))
{
$userid =$_SESSION["logged"];
$sql= "select * from users where id=$userid";
$result =$db->query($sql);
$row =$result->fetch();

$authority=$row["authority"];
}


?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
  <div class="container-fluid">
<a class="navbar-brand" href="#"> <img src="halal.png" width='150'> </a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarResponsive">
  <ul class="navbar-nav ml-auto">
<li class ="nav-item active">
  <a class="nav-link" href="index.php"> Home </a>
</li>

<?php
if(isset($userid))
{
  echo "<li class ='nav-item'>";
  echo "<a class='nav-link' href='edit.php'> edit </a>";
  echo "</li>";
  if($authority=="staff")
  {
    echo "<li class='nav-item'>";
    echo "<a class='nav-link' href='stafforder.php'> staff order page </a>";
    echo "</li>";

  }
  else {
    echo "<li class='nav-item'>";
    echo "<a class='nav-link' href='userorder.php'> user order page </a>";
    echo "</li>";
    echo   "<li class ='nav-item'>";

        echo "<a class='nav-link' href='search.php'> search </a>";
      echo "</li>";
      echo   "<li class ='nav-item'>";

          echo "<a class='nav-link' href='browse.php'> browse </a>";
        echo "</li>";
  }
}
?>

  <?php
  if(isset($userid))
  {
  echo "  <a class='nav-link' href='login.php'> Logout </a>";
  echo  "</li>";



  }
  else {
    echo "  <a class='nav-link' href='login.php'> Login </a>";
    echo  "</li>";
    echo "<li>";
    echo "<a class='nav-link' href='register.php'> Register </a>";
    echo "</li>";


  }
  ?>


  </ul>

</div>
</div>
</nav>
