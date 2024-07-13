<?php
$dbcon=mysqli_connect("localhost","root","","student_data");
if(isset($_POST['register'])){
    $sname=$_POST['sname'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $password=$_POST['password'];
	$c_password=$_POST['c_password'];
	
    $input_error=array();
    if(empty($sname)){
        $input_error['sname']="Sname is required!";
    }
    if(empty($username)){
        $input_error['username']="Username is required!";
    }
    if(empty($email)){
        $input_error['email']="Email is required!";
    }
    if(empty($mobile)){
        $input_error['mobile']="Mobile is required!";
    }
    if(empty($password)){
        $input_error['password']="password is required!";
    }
	if(empty($password)){
        $input_error['c_password']="Confirm password is required!";
    }
	        if(count($input_error)==0){
            if(strlen($username)>=5){
                if(strlen($password)>=8 && strlen($c_password)>=8){
                        if($password==$c_password){
                                $user_check=mysqli_query($dbcon,"SELECT * FROM `register_form` WHERE `username`");
                                if(mysqli_num_rows($user_check)==0){
                                    $email_check=mysqli_query($dbcon,"SELECT * FROM `register_form` WHERE `email`='$email'");     
                                        if(mysqli_num_rows($email_check)==0){
											
                                                
												$password = md5($password);
                                                date_default_timezone_set("Asia/Dhaka");
                                                $reg_time=date('m-d-Y,h:i:s a');
												 $query="INSERT INTO `register_form`(`sname`, `username`, `email`, `mobile`, `password`) VALUES ('$sname','$username','$email','$mobile','$password')";
													$query_result=mysqli_query($dbcon,$query);
														if($query_result){
															echo '
															<script>
															alert("Successfully Inserted");
															window.location.href="index.php";
															</script> 
															';
													$username=false;
													$email=false;
													$mobile=false;
													$password=false;
												}
										 
                                                

                                        }else{
                                            $input_error['email_unique']="This email is already exit";
                                        }
                                }else{
                                    $input_error['username_unique']="This username is already exit";
                                }

                        }else{
                            $input_error['dont_match']="Confirm password do not match";
                        }



                }else{
                    $input_error['password_length']="Password field must be 8 character";
                }



            }else{
                $input_error['strlen']="Username must be 5 character";
            }


        }
	
	
}


?>








<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="css/style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
<div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form action=""  method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" placeholder="Enter your name" name="sname" value="<?php if(isset($sname)){echo $sname;}?>">
            <span class="error"><?php if(isset($input_error['sname'])){echo $input_error['sname'];}?></span>
			<span class="error"><?php if(isset($input_error['strlen'])){echo $input_error['strlen'];}?></span>
             <span class="error"><?php if(isset($input_error['sname_unique'])){echo $input_error['sname_unique'];}?></span>
		 </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="Enter your username" name="username" value="<?php if(isset($username)){echo $username;}?>">
            <span class="error"><?php if(isset($input_error['username'])){echo $input_error['username'];}?></span>
         <span class="error"><?php if(isset($input_error['strlen'])){echo $input_error['strlen'];}?></span>
             <span class="error"><?php if(isset($input_error['username_unique'])){echo $input_error['username_unique'];}?></span>
		 </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email" name="email" value="<?php if(isset($email)){echo $email;}?>">
            <span class="error"><?php if(isset($input_error['email'])){echo $input_error['email'];}?></span>
			<span class="error"><?php if(isset($input_error['email_unique'])){echo $input_error['email_unique'];}?></span>
          </div>
		  
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="tel"  placeholder="Enter your number" name="mobile" pattern="01[1|3|4|9|7|8|6|5][0-9]{8}" value="<?php if(isset($mobile)){echo $mobile;}?>">
            <span class="error"><?php if(isset($input_error['mobile'])){echo $input_error['mobile'];}?></span>
			
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your password" name="password" value="<?php if(isset($password)){echo $password;}?>">
            <span class="error"><?php if(isset($input_error['password'])){echo $input_error['password'];}?></span>
			 <span class="error"><?php if(isset( $input_error['password_length'])){echo  $input_error['password_length'];}?></span>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" placeholder="Confirm your password" name="c_password" id="c_password" value="<?php if(isset($c_password)){echo $c_password;}?>" >
			<span class="error"><?php if(isset($input_error['c_password'])){echo $input_error['c_password'];}?></span>
                <span class="error"><?php if(isset($input_error['dont_match'])){echo $input_error['dont_match'];}?></span>
                
          </div>
        </div>
		
		
        
        <div class="button">
          <input type="submit" value="Register" name="register">
        </div>
      </form>
    </div>
  </div>

</body>
</html>