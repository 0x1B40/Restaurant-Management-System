<?php
// and it will do session_start()
require("head.php");
require("navigation.php");



// validation should be Client side

?>

<html>

<head>
  <title>
    Welcome To Registeration
  </title>
  <script>
    var nameFlag=dobFlag=usernameFlag=passwordFlag=emailFlag= false;
    //var m,c;

    function checkName(n){
      var nameExp=/^[a-z]{3,18}$/i;
      if (n.length==0){
        m="Field empty";
        c="red";
        nameFlag=false;
      }
      else if (!nameExp.test(n)){
          m=" Name unaccepted";
          c="red";
          nameFlag=false;
        }
      else{
          m=" Name accepted";
          c="green";
          nameFlag=true;
        }
      document.getElementById('validName').style.color=c;
      document.getElementById('validName').innerHTML=m;
    }

    function checkLastName(n){
      var nameExp=/^[a-z]{3,18}$/i;
      if (n.length==0){
        m="Field empty";
        c="red";
        nameFlag=false;
      }
      else if (!nameExp.test(n)){
          m=" Name unaccepted";
          c="red";
          nameFlag=false;
        }
      else{
          m=" Name accepted";
          c="green";
          nameFlag=true;
        }
      document.getElementById('validLastName').style.color=c;
      document.getElementById('validLastName').innerHTML=m;
    }

    function checkPassword(ps)
    {
      var passExp= /.{8,50}/i;
      if(!passExp.test(ps))
      {
        m=" password is too weak";
        c="red";
        passwordFlag=false;
      }
      else if(ps != document.getElementById('confirmPassword').value)
      {
        m="passwords do not match";
        c="red";
        passwordFlag=false;
      }
      else
      {
        m="password is good";
        c="green";
        passwordFlag=true;
      }

      document.getElementById('validPassword').style.color=c;
      document.getElementById('validPassword').innerHTML=m;
    }

    function checkUsername(un){
      var unameExp=/^[a-z]\w{3,9}$/i;
      if (un.length==0){
        m="field empty";
        c="red";
        usernameFlag=false;
      }
      else if (!unameExp.test(un)){
          m="Invalid Username";
          c="red";
          usernameFlag=false;
        }
      else{
          m="Valid Username";
          c="green";
          usernameFlag=true;
        }
      document.getElementById('validUsername').style.color=c;
      document.getElementById('validUsername').innerHTML=m;
    }

    function checkDOB(dob)
    {
      var dobExp =/[1|2][9|0][0-9][0-9]\-[0|1][0-9]\-[0-3][0-9]/i;
      if(dob.length=0)
      {
        m="field empty";
        c="red";
        dobFlag = false;
      }
      else if(!dobExp.test(dob))
      {
        m="invalid date";
        c="red";
        dobFlag=false;
      }
      else {
        m="valid date";
        c="green";
        dobFlag=true;

      }
      document.getElementById('validDOB').style.color=c;
      document.getElementById('validDOB').innerHTML=m;

    }

    function checkEmail(email){
      var emailExp=/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i;
      if (email.length==0){
        m="field empty";
        c="red";
        emailFlag=false;
      }
      else if (!emailExp.test(email)){
          m="Invalid Email";
          c="red";
          emailFlag=false;
        }
      else{
          m="Valid Email";
          c="green";
          emailFlag=true;
        }
      document.getElementById('validEmail').style.color=c;
      document.getElementById('validEmail').innerHTML=m;
    }

    function checkUserInputs(){
      document.forms[0].JSEnabled.value="TRUE";
      return (nameFlag && dobFlag && usernameFlag && passwordFlag && emailFlag );

    }

  </script>
</head>



<body>

<form onSubmit="return checkUserInputs();" method ='post' action='register.php'>
<table class='table table-borderless table-warning table-hover'>
  <tr> <td>First Name: </td> <td>   <input type ='text' name='firstName' onkeyup="checkName(this.value)" > </td> <td> <span id='validName'> </span>  </td> </tr>
  <tr> <td>Last Name: </td> <td>   <input type ='text' name='lastName' onkeyup="checkLastName(this.value)"> </td> <td> <span id='validLastName'> </span>  </td>  </tr>
  <tr> <td>Date Of Birth: </td> <td>   <input type ='date' name='dob' onkeyup="checkDOB(this.value)" > </td> <td> <span id='validDOB'> </span>  </td> </tr>
  <tr> <td>username: </td> <td>   <input type ='text' name='username'onkeyup="checkUsername(this.value)"  > </td> <td> <span id='validUsername'> </span>  </td>  </tr>
  <tr> <td>password: </td> <td>   <input type ='password' name='password' onkeyup="checkPassword(this.value)" > </td> <td> <span id='validPassword'> </span>  </td> </tr>
  <tr> <td>confirm password: </td> <td>   <input type ='password' onkeyup="checkPassword(this.value)" name='confirmPassword' id="confirmPassword" > </td>  </tr>
  <tr> <td>email: </td> <td>   <input type ='text' name='email' onkeyup="checkEmail(this.value)" > </td> <td> <span id='validEmail'> </span>  </td> </tr>
  <tr> <td>male</td> <td>   <input type ='radio' name='gender' value ='male' > </td>  </tr>
  <tr> <td>female</td> <td>   <input type ='radio' name='gender' value ='female' > </td>  </tr>
  <input type='hidden' name='JSEnabled' value='FALSE' />
  <tr> <td> <input type='submit' name='submit'>  </td> <td><input type='reset' name='reset' value='clear' > </td> <td> </form> <form method='post' action='index.php'><button  type='submit'> back to homepage </button> </td>  </tr>
</table>
</form>

<?php
extract($_POST);
if(!isset($JSEnabled))
die();

if ($JSEnabled=="FALSE")
  {
    echo "You should validate again using PHP";
  }

if(isset($submit))
{
  if($JSEnabled =="FALSE")
{
echo "<p class='red'> invalid field(s).</p>";
}

else {
  $securePassword = md5($password);
  $sql = "INSERT INTO users (id , firstname , lastname , dob , username , password , email , gender , authority ) VALUES (?,?,?,?,?,?,?,?,?) ";
$statement = $db->prepare($sql);
$userType = 'customer';
$statement->execute(array(NULL,$firstName,$lastName,$dob,$username,$securePassword,$email,$gender,$userType));
echo "<p class='green'> User Successfully Registered <p>";
}

}


$db->connection =null;
?>

</body>



</html>
