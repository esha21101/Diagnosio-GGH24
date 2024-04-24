<html>
<head>
    <title>Doctor page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
session_start();
include 'dbconn.php';
$id=$_GET['id'];
$_SESSION['doctor_id'] = $id;
$query = "select * from doctor_info where id = '$id'";
$run = mysqli_query($conn,$query);
$row=mysqli_fetch_array($run);
?>
<div id = 'heading'>
<h1>Doctor Details<h1>
</div>
<div class='dotor-details'>
<img src='images/<?php echo $row['image']; ?>' width='270' height='200' >
<h3>Name - <?php echo $row['name'] ?><h3>
<h3>Age - <?php echo $row['age'] ?><h3>
<h3>Qualifications - <?php echo $row['qualifications'] ?><h3>
<h3>Specialist - <?php echo $row['specialist'] ?><h3>
<form action = "action.php" method = "POST">
<label for ='appointment'>Make A Appontment on </label>
<input type = 'date' name = 'date' required>
<input type = 'time' name = 'time'required>
<button class = 'button' type = 'submit' name = 'appointment'>Get Appontment</button>
</form>
</div>
</body>
</html>

