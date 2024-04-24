<?php
session_start();
include 'dbconn.php';
if(isset($_POST['signin'])){
    if(!empty($_POST['username']) && !empty($_POST['phone']) && !empty($_POST['mail']) && !empty($_POST['password']) && !empty($_POST['conform'])){
        $name = $_POST['username'];
        $phone = $_POST['phone'];
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $conpass = $_POST['conform'];
        $checkphone = "select * from user_details where phone = '$phone'";
        $checkmail = "select * from user_details where mail = '$mail'";
        $a=mysqli_query($conn,$checkphone);
        $b = mysqli_query($conn,$checkmail);
        if(mysqli_num_rows($a)>0){
            echo "<script>alert('the phone number is already taken'); window.location = 'Signin.html';</script>";
        }
        else if(mysqli_num_rows($b)>0){
            echo "<script>alert('the mail is already taken'); window.location = 'Signin.html';</script>";
        }
        else{
        if($password == $conpass){
            $query = "insert into user_details(username,phone,mail,password) values('$name','$phone','$mail','$password')";
            $run = mysqli_query($conn,$query);
            if($run){
                echo "<script>alert('Your account has been created sucessfully'); window.location = 'index.html';</script>";
            }
        }
        else{
            echo "<script>alert('password and conform password are not matching'); window.location = 'Signin.html';</script>";
        }
        }
    }
    else{
        echo "<script>alert('All feilds are required'); window.location = 'Signin.html';</script>";
    }

}
if(isset($_POST['login-btn'])){
    $name = $_POST['uname'];
    $password = $_POST['pass'];
    $query = "select * from user_details where username = '$name' and password = '$password'";
    $run = mysqli_query($conn,$query);
    if(mysqli_num_rows($run)>0){
        $check = mysqli_fetch_array($run);
        $_SESSION['id']  = $check['id'];
        header('Location:userpage.html');
    }
    else{
        echo "<script>alert('the username or password is incorret please try again'); window.location='index.html'</script>";
    }
}
if(isset($_POST['appointment'])){
    $date = $_POST['date'];
    $time = $_POST['time'];
    $user_id = $_SESSION['id'];
    $id = $_SESSION['doctor_id'];
    echo $id;
    $query = "insert into appointment(user_id,doctor_id,date,time) values('$user_id','$id','$date','$time')";
    $run = mysqli_query($conn,$query);
    if($run){
        echo "<script>alert('your appointment made succesfully'); window.location = 'myappointments.php';</script>";
    }
}
?>