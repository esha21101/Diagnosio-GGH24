<?php
session_start();
include 'dbconn.php';
?>

<html>
    <head>
        <title>Registration Page</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div  id ='heading'>
            <h1>Appointment</h1>
            </div>
        <form style="margin: 20px 50px;" action="registration.php" method="POST">
            <label for="search">Enter your disease</label>
            <input type="text" style="width: 20%;" name="disease" id="search" placeholder="Enetr your disease" required>
            <label for="mode">Qualifications</label>
            <select style="width: 20%;" id="mode" name="qualification">
                <option value="MBBS">MBBS</option>
                <option value="Dentist">Dentist</option>
                <option value="Eye Specialist">Eye Specialist</option>
                <option value="Neuro">Neuro Specialist</option>
                <option value="ENT Specialist">ENT Specialist</option>
                <option value="pulmonologist">Pulmonologist</option>
            </select>
            <button style="width: 20%;" class='button' type="submit" name = 'search'>Search</button>
        </form>

<?php
if(isset($_POST['search'])){
    $disease = $_POST['disease'];
    $qualification = $_POST['qualification'];
    $query = "select * from doctor_info where specialist = '$qualification'";
    $run = mysqli_query($conn,$query);
    if($run){
        if(mysqli_num_rows($run)==0){
            echo "There are no doctors avaiable on qualification right now";
        }
        else{
            while($row = mysqli_fetch_array($run)){
                ?>
                    <div class = "order">
                    <div class = "car">
                    <a href="doctor page.php?id=<?php echo $row['id']?>">
                    <img src='images/<?php echo $row['image']; ?>' width='270' height='200' ></a>
                    <p style='text-align:center'>Name - <?php echo $row['name']?></p>
                    <p style='text-align:center'>Age - <?php echo $row['age'] ;?></p>
                    <p style='text-align:center'>Qualifications - <?php echo $row['qualifications'];?></p>
                    <p style='text-align:center'>Specialist in - <?php echo $row['specialist'] ;?><p>
                    </div></div>
                <?php
            }
        }
    }
    else{
        echo 'no';
    }

}

?>
</body>
</html>