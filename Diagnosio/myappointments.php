<?php
include 'dbconn.php';
session_start();
$user_id = $_SESSION['id'];
$query = "select * from appointment where user_id = $user_id";
$run= mysqli_query($conn,$query);
?>
<html>
    <head>
        <title>Appointment Page</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div id = 'heading'>
            <h1>My Appointments</h1>
        </div>
        <?php
        if(mysqli_num_rows($run)==0){
            ?>
            <h3>There are no Appointmenst you made yet!</h3>
            <?php
        }
        else{
            while($row = mysqli_fetch_array($run)){
                $doctorid = $row['doctor_id'];
                $sql = "select * from doctor_info where id = $doctorid";
                $result = mysqli_query($conn,$sql);
                $check = mysqli_fetch_array($result);
                $doctor = $check['name'];
                $specialist = $check['specialist'];
                ?>
                <div class = "order">
                <div class = 'car'>
                <img src='images/<?php echo $check['image']; ?>' width='270' height='200' >
                <p>Doctor name - <?php echo $doctor;?></p>
                <p>Specialist in - <?php echo $specialist;?></p>
                <p>Appointment date - <?php echo $row['date'];?></p>
                <p>Time - <?php echo $row['time'];?></p>
            </div>
            </div>
                <?php
            }
        }
        ?>
    </body>
</html>