<?php 
    session_start();
    include 'config.php';
    $conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
    if(!$conn)
    {
    die("Connection Failed");
    }
	$errors=array('name'=>'','email'=>'','age'=>'','uname'=>'','voter_id'=>'','password'=>'','cpassword'=>'','flag'=>'');

	if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $age = $_POST['age'];
		$uname=$_POST['uname'];
		$voter_id=$_POST['voter_id'];
		$password=$_POST['password'];
		$cpassword=$_POST['cpassword'];
        $flag = false;
        $active = 0;
		$valid=true;
		$sql="SELECT * FROM voter WHERE uname='$uname'";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0){
			$errors['uname']='*name already taken by another user';
			$valid=false;
        }
        $sql="SELECT * FROM govt_db WHERE voter_id='$voter_id'";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)==0){
			$errors['voter_id']='*voter id is not valid';
			$valid=false;
        }
        else{
            $sql="SELECT * FROM govt_db WHERE voter_id='$voter_id'";
            $res=mysqli_query($conn,$sql);
            $voters=mysqli_fetch_all($res,MYSQLI_ASSOC);
            $email1 = $voters[0]['email'];
            if($email != $email1)
            {
                $errors['email']='*not registered email id';
                $valid=false;
            }
        }
        $sql="SELECT * FROM voter WHERE voter_id='$voter_id'";
		$res=mysqli_query($conn,$sql);
		if(mysqli_num_rows($res)>0){
			$errors['voter_id']='*already exists';
			$valid=false;
        }
        
			for($i=0;$i<strlen($name);$i++){
				if(!ctype_alpha($name[$i])){
                    if(!ctype_space($name[$i])){
                    $errors['name']='*Full Name can contain only alphabets';
					$valid=false;
					break;
                    }
				}
			}
            if($age <= 17)
            {
                $errors['age']='*age cannot be less than 18';
                $valid = false;
            }

			for($i=0;$i<strlen($uname);$i++) {
				if(!ctype_alpha($uname[$i])){
					$errors['uname']='*Username can contain only alphabets and no blank spaces';
					$valid=false;
					break;
				}
			}
		

		if(strlen($password)<8&&strlen($password)>50){
            
			$errors['password']='*Length must be greater than 7 and less than 50';
			$valid=false;
		}

		if($password!=$cpassword){
			$errors['cpassword']='*Passwords not matching';
			$valid=false;
		}
        if($valid)
        {
            if($conn)
            {
                $msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
                $hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
                // Example output: f4552671f8909587cf485ea990207f3b
                $sql="INSERT INTO voter VALUES('$name','$email','$age','$uname','$voter_id','$password','$flag','$hash','$active')";
                $res=mysqli_query($conn,$sql);  
                $message = '
                
                Thanks for signing up!
                Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

                Username: '.$name.'
                
                Please click this link to activate your account:
                http://localhost/onlinevoting/verify.php?email='.$email.'&hash='.$hash.'
                
                ';
                require_once('../PHPMailer/PHPMailer-5.2-stable/PHPMailerAutoload.php');
                $from='erudite.onlinevoting@gmail.com';
                $to=$email;
                $password='eruditeproject';
                $sub='Signup | Verification';
                $body=$message;
                $mail = new PHPMailer(); 
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = '465';
                $mail->isHTML();
                $mail->Username = $from;
                $mail->Password = $password;
                $mail->Subject = $sub;
                $mail->Body = $body;
                $mail->AddAddress($to);
                if($mail->Send()){
                echo "<script>alert('Email Sent Successfully!');</script>";
                }
                else echo "<script>alert('There has been an error, please try again!');</script>";
            
                mysqli_close($conn);
        }
    }
        ##################################################################################################################################
		// if($valid){
		// 	if($conn){
        //         $sql="INSERT INTO voter VALUES('$name','$email','$age','$uname','$voter_id','$password','$flag')";
        //         $res=mysqli_query($conn,$sql);
		// 		if($res) {
		// 			$_SESSION['name'] = $name;
		// 			$_SESSION['age']=$age;
		// 			$_SESSION['email']=$email;
		// 			$_SESSION['uname']=$uname;
		// 			$_SESSION['voter_id']=$voter_id;
        //             $_SESSION['password']=$password;
        //             $_SESSION['flag']=$flag;
		// 			//setcookie("name",$name, time() + 60*60*24,'/');
		// 			header("location: user_profile.php");
		// 		}
		// 	}
		// 	mysqli_close($conn);
		// }
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <style>
      .headerFont{
        font-family: 'Ubuntu', sans-serif;
        font-size: 24px;
      }

      .subFont{
        font-family: 'Raleway', sans-serif;
        font-size: 14px;
        
      }
      
      .specialHead{
        font-family: 'Oswald', sans-serif;
      }

      .normalFont{
        font-family: 'Roboto Condensed', sans-serif;
      }
    </style>
</head>
<body>
<div class="container">
  	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
        <div class="navbar-header">
          <a href="index.html" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
      </div>
    </nav>

    
    <div class="container" style="padding-top:150px;">
    	<div class="row">
    		<div class="col-sm-4"></div>
    		<div class="col-sm-4" style="border:2px solid gray;padding:50px;">
    			
    			<div class="page-header">
    				<h2 class="specialHead">Sign up</h2>
                </div>
                
          <form action="signup.php" method="POST">
      			<div class="form-group">
                      
                      <label>Full Name:</label>
                        <input type="text" name="name" placeholder="Full Name" class="form-control" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>" required>
                        <div style="color: red;"><?php echo $errors['name']; ?></div><br><br>

                        <label>Age:</label>
                        <input type="int" name="age" class="form-control" value="<?php echo isset($_POST["age"]) ? $_POST["age"] : ''; ?>" required>
                        <div style="color: red;"><?php echo $errors['age']; ?></div><br><br>

                        <label>Username:</label>
                        <input type="text" name="uname" class="form-control" placeholder="only alphabets" value="<?php echo isset($_POST["uname"]) ? $_POST["uname"] : ''; ?>" required>
                        <div style="color: red;"><?php echo $errors['uname']; ?></div><br><br>

                        <label>Email Id:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" required>
                        <div style="color: red;"><?php echo $errors['email']; ?></div><br><br>


                        <label>Voter ID:</label>
                        <input type="int" name="voter_id" class="form-control" placeholder="7 digits" value="<?php echo isset($_POST["voter_id"]) ? $_POST["voter_id"] : ''; ?>" pattern="[0-9]{7}" required>
                        <div style="color: red;"><?php echo $errors['voter_id']; ?><br><br></div>   
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" placeholder="8-50 numbers" required>
                        <div style="color: red;"><?php echo $errors['password']; ?></div><br><br>

                        <label>Confirm Password:</label>
                        <input type="password" name="cpassword" class="form-control" required>
                        <div style="color: red;"><?php echo $errors['cpassword']; ?></div><br><br>

      				<button type="submit" name="submit" class="btn btn-block span btn-primary "><span class="glyphicon glyphicon-user"></span> Sign In</button>
                    <br><a class="form-control" href="login.php">Already an user? Log in!</a>
      			</div>

          </form>
          <br>

    		</div>
    		<div class="col-sm-4"></div>
    	</div>
    </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    
    
</body>
</html>