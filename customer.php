<?php
$servername = "localhost";
$username = "root";
$password = "Abhi@1234";
$dbname = "banking";




$conn = new mysqli($servername, $username, $password,$dbname);



if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT uname,Email,Balance FROM customer";
$result = mysqli_query($conn,"SELECT * FROM customer");
$result1 = mysqli_query($conn,"SELECT * FROM customer");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo time(); ?>" />
  <script src="https://kit.fontawesome.com/035b8fb014.js" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body style="background-color:lightcoral">
  <section id="nav-bar ">
    <nav class="navbar navbar-expand-lg navbar-light">
        <img src="https://www.freeiconspng.com/uploads/blue-bank-icon-in-flat-style-with-the-building-facade-with-three--26.png" width="100px" height="100px">
      <a class="navbar-brand" href="index.html">ABS BANK</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="customer.php">View All Customers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="transfer.php">Transfer History</a>
          </li>

          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
      </div>
    </nav>
    
  </section>

  <section id="main">
    <form action="" method="GET" class="form1">
      <h1>TRANSFER MONEY</h1>
      

      
      <h2>FROM : </h2><select class="form1" type="text" name="sender" id="">

        <option value="">Select Account</option>
        <?php
        

        while($tname=mysqli_fetch_array($result)){
          echo "<option value='".$tname['uname']."'>".$tname['uname']."</option>";
        }

        ?>


      </select>

      <h2>TO : </h2><select class="form1" type="text" name="receiver" id="">

        <option value="">Select Account</option>
        <?php
        

        while($tname=mysqli_fetch_array($result1)){
          echo "<option value='".$tname['uname']."'>".$tname['uname']."</option>";
        }

        ?>


      </select>
      <h2>Enter Amount </h2>
        <input type="text" name="amount" id="amount" placeholder="enter amount">
        <input type="submit" value="Transfer" name="Transfer">
    </form>
    

        <?php
          
          if($_GET['Transfer']){
            $u1=$_GET['sender'];
            $u2=$_GET['receiver'];
            $amount=$_GET['amount'];

          if($u1!="" && $u2!="" && $amount!=""){
            $q1="UPDATE  customer SET Balance = Balance + '$amount' WHERE uname='$u2' ";
            $d1=mysqli_query($conn,$q1);

            $q2="UPDATE  customer SET Balance= Balance - '$amount' WHERE uname='$u1' ";
            $d2=mysqli_query($conn,$q2);

            
            $dt = date('Y-m-d h:i:s');
            $tr="INSERT INTO transfer (Sender,Receiver,Amount,Date) VALUES('$u1','$u2','$amount','$dt')";
            $res=mysqli_query($conn,$tr);

                if($res){
                  $user1="SELECT * FROM customer WHERE uname='$u1'";
                  $res2=mysqli_query($conn,$user1);
                  $row_count=mysqli_num_rows($res2);
                }

                

            if($d1 && $d2){
              echo '<script>alert("Transaction Successfull ")</script>';
            }
            else{
              echo '<script>alert("Transaction Failed")</script>';
            }

          }
          }
          ?>

</body>
</html>

    
