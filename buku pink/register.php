<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Pink Book</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            padding: 40px 0; 
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(270deg, #ff5272 0%, rgb(255, 151, 168));
        }

        h1 {
            color: rgb(255, 120, 129);
            font-size: 50px;
            font-weight: 700;
            margin-bottom: 35px;
        }

        .register {
            border: none;
            padding: 40px;
            padding-top: 10px;
            border-radius: 30px;
            background-color: white;
            width: 800px; 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        fieldset {
            border: 1px solid rgba(0, 0, 0, 0.12);
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 20px;
            width: 100%;
        }

        legend {
            font-size: 18px;
            font-weight: 700;
            color: rgb(255, 105, 130);
            padding: 0 10px;
        }

        .form {
            margin-bottom: 18px;
            width: 100%;
        }

        label.field-label {
            display: block;
            font-size: 15px;
            font-weight: 600;
            color: rgb(70, 70, 70);
            margin-bottom: 7px;
        }

        .input-field {
            font-size: 15px;
            border-radius: 10px;
            border: 1px solid rgb(190, 190, 190);
            width: 75%;
            height: 42px;
            padding: 10px 12px;
            color: rgb(50, 50, 50);
            transition: border-color 0.2s;
            margin-bottom: 12px;
        }

        textarea.input-field {
            height: auto;
            resize: vertical;
        }

        .input-field:focus {
            border: 1.5px solid rgb(255, 105, 130);
            outline: none;
        }

        .radio {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 5px;
        }

        .radio-label {
            display: inline-flex;
            align-items: center;
            font-size: 15px;
            font-weight: 500;
            color: rgb(80, 80, 80);
            cursor: pointer;
        }

        input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            background-color: #fff;
            margin: 0 8px 0 0;
            width: 20px;
            height: 20px;
            border: 1.5px solid rgb(171, 171, 171);
            border-radius: 50%;
            display: inline-grid;
            place-content: center;
            vertical-align: middle;
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="radio"]::before {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 50%;
            transform: scale(0);
            transition: 0.15s transform ease-in-out;
            background-color: rgb(255, 105, 130);
        }

        input[type="radio"]:checked {
            border-color: rgb(255, 105, 130);
            box-shadow: 0 0 0 5px rgba(255, 105, 130, 0.3);
        }

        input[type="radio"]:checked::before {
            transform: scale(1);
        }

        hr {
            border: none;
            height: 1px;
            background-color: rgb(225, 225, 225);
            margin: 15px 0;
        }

        #button {
            font-size: 24px;
            border: none;
            border-radius: 12px;
            background-color: rgb(255, 105, 130);
            color: white;
            width: 100%;
            padding: 12px;
            font-weight: 600;
            margin-top: 10px;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        #button:hover {
            opacity: 0.70;
        }
        
        .center-btn-container {
            text-align: center;
            width: 100%;
        }

        p {
            color: rgb(140, 140, 140);
            text-align: center;
            margin-top: 30px;
        }

        a {
            color: rgb(255, 123, 145);
            font-weight: 500;
        }
        a:hover{ text-decoration: none;}
        #errorMessage{
            color: red;
            margin: 0;
            padding: 0;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

    <div class="register">
        <h1>Sign Up New Account</h1>
        <center><p id = "errorMessage"></p></center>
        <form action="" method="POST">
            
            <fieldset>
                <legend>Personal Information</legend>

                <div class="form-group">
                    <label class="field-label">Full Name:</label>
                    <input type="text" class="input-field" name="fullName"  value="<?php echo isset($_POST['fullName']) ? htmlspecialchars($_POST['fullName']) : ''; ?>" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label class="field-label">Email:</label>
                    <input type="email" class="input-field" name="email"  value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" placeholder="example@gmail.com" required>
                </div>

                <div class="form-group">
                    <label class="field-label">Phone Number:</label>
                    <input type="tel" class="input-field" name="phoneNum"  value="<?php echo isset($_POST['phoneNum']) ? htmlspecialchars($_POST['phoneNum']) : ''; ?>" placeholder="xxx-xxxxxxx" pattern="[0-9]{3}-[0-9]{7,8}" required>
                </div>

                <div class="form-group">
                    <label class="field-label">IC Number:</label>
                    <input type="text" class="input-field" name="icNum" value="<?php echo isset($_POST['icNum']) ? htmlspecialchars($_POST['icNum']) : ''; ?>" placeholder="xxxxxx-xx-xxxx" required>
                </div>

                <div class="form-group">
                    <label class="field-label">Address:</label>
                    <textarea class="input-field" name="address" rows="3" placeholder="Enter your residential address" required><?php
                        echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
                    ?></textarea>
                </div>

                <div class="form-group">
                    <label class="field-label">Password:</label>
                    <input type="password" class="input-field" name="password" placeholder="Create a password" required>
                </div>

                <div class="form-group">
                    <label class="field-label">Confirm Password:</label>
                    <input type="password" class="input-field" name="confirmPassword" placeholder="Retype the password" required>
                </div>

                <div class="form-group">
                    <label class="field-label">Role:</label>
                    <div class="radio">
                        <label class="radio-label">
                            <input type="radio" name="role" value="patient" onclick="showField()" required <?php if (isset($_POST['role']) && $_POST['role'] == 'patient') echo 'checked'; ?>> Patient
                        </label> &ensp;
                        <label class="radio-label">
                            <input type="radio" name="role" value="doctor" onclick="showField()" <?php if (isset($_POST['role']) && $_POST['role'] == 'patient') echo 'checked'; ?>> Doctor
                        </label> &ensp;
                        <label class="radio-label">
                            <input type="radio" name="role" value="admin" onclick="showField()" <?php if (isset($_POST['role']) && $_POST['role'] == 'patient') echo 'checked'; ?>> Admin
                        </label>
                    </div>
                </div>
            </fieldset>

            <div id="patientField" style="display: none;">
                <fieldset>
                    <legend>Health Information</legend>

                    <div class="form">
                        <label class="field-label">Blood Type:</label>
                        <div class="radio-inline-group">
                            <label class="radio-label"><input type="radio" name="bloodType" value="A"> A</label>
                            <label class="radio-label"><input type="radio" name="bloodType" value="B"> B</label>
                            <label class="radio-label"><input type="radio" name="bloodType" value="AB"> AB</label>
                            <label class="radio-label"><input type="radio" name="bloodType" value="O"> O</label>
                        </div>
                    </div>

                    <div class="form">
                        <label class="field-label">HIV Status:</label>
                        <div class="radio-inline-group">
                            <label class="radio-label"><input type="radio" name="hiv" value="reactive"> Reactive</label>
                            <label class="radio-label"><input type="radio" name="hiv" value="non-reactive"> Non-reactive</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="field-label">Last Menstrual Period (LMP):</label>
                        <input type="date" class="input-field" name="lmp">
                    </div>
                </fieldset>
            </div>

            <div id="doctorField" style="display: none;">
                <fieldset>
                    <legend>Doctor's Information</legend>

                    <div class="form">
                        <label class="field-label">Gender:</label>
                        <div class="radio-inline-group">
                            <label class="radio-label"><input type="radio" name="gender" value="Male"> Male</label>&emsp;
                            <label class="radio-label"><input type="radio" name="gender" value="Female"> Female</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="field-label">License Number:</label>
                        <input type="text" class="input-field" name="licenseNo" placeholder="Enter medical license number" value="<?php echo isset($_POST['licenseNo']) ? htmlspecialchars($_POST['licenseNo']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label class="field-label">Specialization:</label>
                        <input type="text" class="input-field" name="specialization" placeholder="e.g. Obstetrics & Gynecology" value="<?php echo isset($_POST['specialization']) ? htmlspecialchars($_POST['specialization']) : ''; ?>">
                    </div>
                </fieldset>
            </div>

            <div id="adminField" style="display: none;">
                <fieldset>
                    <legend>Admin's Information</legend>
                    <div class="form">
                        <label class="field-label">Gender:</label>
                        <div class="radio-inline-group">
                        <label class="radio-label"><input type="radio" name="gender" value="Male"> Male</label> &emsp;
                        <label class="radio-label"><input type="radio" name="gender" value="Female"> Female</label>
                    </div>
                    </div>
                </fieldset>
            </div>
            
            <div class="center-btn-container">
                <input type="submit" id="button" name="submit" value="Create Account">
            </div>
            <center><p>Already have an account? <a href="login.php">Log In</a></p></center>
        </form>
    </div>
    
    <script>
        function showField() {
            const checkedRole = document.querySelector('input[name="role"]:checked');
            if (!checkedRole) return;
            
            let role = checkedRole.value;

            document.getElementById("doctorField").style.display = "none";
            document.getElementById("patientField").style.display = "none";
            document.getElementById("adminField").style.display = "none";

            if (role === "doctor") {
                document.getElementById("doctorField").style.display = "block";
            } else if (role === "patient") {
                document.getElementById("patientField").style.display = "block";
            } else if (role === "admin"){
                document.getElementById("adminField").style.display = "block";
            }
        }
    </script>

    <?php
    include "db_connect.php";

    if(isset($_POST['submit'])){
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $phoneNum = $_POST['phoneNum'];
        $icNum = $_POST['icNum'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $role = $_POST['role'];
        $fullName = strtoupper($fullName);
        $icNum = str_replace('-','',$icNum);

        $sql = "SELECT * FROM user WHERE email = '$email' AND role = '$role'";
        $sendsql = mysqli_query($connect, $sql);

 if ($password !== $confirmPassword) {
        echo "<script>document.getElementById('errorMessage').innerHTML='ERROR: Passwords do not match, please try again.';</script>";
        exit();
    }

    $sql = "SELECT * FROM user WHERE email='$email' AND role='$role'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email registered already, please log in with your registered account.'); window.location.href='login.php';</script>";
        exit();
    }

    $sql = "SELECT * FROM user WHERE icNum='$icNum' AND role='$role'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('IC Number registered already, please log in with your registered account.'); window.location.href='login.php';</script>";
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    if ($role == 'patient'){
        $sql = "INSERT INTO user(fullName,email,phoneNum,icNum,address,password,role,pending)
            VALUES('$fullName','$email','$phoneNum','$icNum','$address','$hashedPassword','$role',0)";
    } else{
        $sql = "INSERT INTO user(fullName,email,phoneNum,icNum,address,password,role,pending)
            VALUES('$fullName','$email','$phoneNum','$icNum','$address','$hashedPassword','$role',1)";
    }
    $result = mysqli_query($connect, $sql);

    if (!$result) {
        die(mysqli_error($connect));
    }

    $userID = mysqli_insert_id($connect);


        if ($role === 'patient'){//PATIENT INFO
            $bloodType = $_POST['bloodType'];
            $hivStatus = $_POST['hiv'];
            $lmpDate = $_POST['lmp'];

            $sql = "INSERT INTO patient(userID,bloodType)
            VALUES('$userID','$bloodType')";
            $sendsql = mysqli_query($connect,$sql);

            if (!$sendsql) {echo mysqli_error($connect);}
            else{

                $patientID = mysqli_insert_id($connect);
                $age = getAge($icNum);
                $riskStatus = 'low';

                //SET PREGNANCY RISK
                if ($hivStatus === 'reactive' || $age < 18 || $age >= 40){
                    $riskStatus = 'high';
                } else if (($age >= 18 && $age <= 19) || ($age >= 35 && $age <= 39)){
                    $riskStatus = 'medium';
                } else if (($age >= 20 && $age <= 34 && $hivStatus === 'non-reactive')){
                    $riskStatus = 'low';
                }

                $sql = "INSERT INTO pregnancy(patientID,pregStatus,hivStatus,riskStatus,lmpDate)
                VALUES ('$patientID','ACTIVE','$hivStatus','$riskStatus','$lmpDate')";
                $sendsql = mysqli_query($connect,$sql);

                if (!$sendsql) {echo mysqli_error($connect);
                }else{echo "<script>alert('Login successful! Start logging in with your new account'); window.location.href = 'login.php';</script>";}
            }

        }else if($role === 'doctor'){ //DOCTOR INFO

            $gender = $_POST['gender'];
            $licenseNo = $_POST['licenseNo'];
            $specialization = $_POST['specialization'];

            $sql = "INSERT INTO doctor(userID,gender,licenseNo,specialization)
            VALUES ('$userID','$gender','$licenseNo','$specialization')";
            $sendsql = mysqli_query($connect,$sql);

            if (!$sendsql) {echo mysqli_error($connect);
            } else {echo "<script>alert('Login successful! Start logging in with your new account'); window.location.href = 'login.php';</script>";}

        }else if($role === 'admin'){ //ADMIN INFO

            $gender = $_POST['gender'];
            $sql = "INSERT INTO admin(userID,gender) 
            VALUES ('$userID','$gender')";
            $sendsql = mysqli_query($connect,$sql);

            if(!$sendsql) {echo mysqli_error($connect);
            }else{echo "<script>alert('Login successful! Start logging in with your new account'); window.location.href = 'login.php';</script>";}
        }
    }

    function getAge($icNum){ //Age derived from IC
        $yy = substr($icNum,0,2);
        $currentYear = (int)date('Y');
        $currentYearShort = (int)date('y');

        if ((int)$yy > $currentYearShort){
            $yyyy = (int)("19" . $yy);
        }else{
            $yyyy = (int)("20" . $yy);
        }
        $age = $currentYear - $yyyy;
        return $age;
    }
    ?>
</body>
</html>