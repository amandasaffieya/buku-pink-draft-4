<?php

session_start();

if (isset($_SESSION["fp_message"])) {
    if ($_SESSION["fp_message"] === "success") {
        $alert_message = "Request sent successfully! Please wait for admin to update your password.";
    } else {
        $alert_message = "No matching account found. Please check your IC Number, Email, and Role.";
    }
    unset($_SESSION["fp_message"]); 
}

if (isset($_POST["login"])) {

    $host = "localhost:3307";
    $user = "root";
    $dbPassword = "";
    $database = "buku_pink";

    $connect = mysqli_connect($host, $user, $dbPassword, $database);

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $icNum = mysqli_real_escape_string($connect, $_POST["icNum"]);
    $password = mysqli_real_escape_string($connect, $_POST["password"]);
    
    if (isset($_POST["role"])) {
        $role = mysqli_real_escape_string($connect, $_POST["role"]);
    } else {
        $role = "patient";
    }

    $sql = "SELECT * FROM user WHERE icNum = '$icNum' AND password = '$password' AND role = '$role'";
    $sendsql = mysqli_query($connect, $sql);

    if (!$sendsql) {
        die("Database Error: " . mysqli_error($connect));
    }

    if (mysqli_num_rows($sendsql) > 0) {

        $user_data = mysqli_fetch_assoc($sendsql);
        $_SESSION["userID"] = $user_data["userID"];
        $pending = $user_data["pending"];

        if ($pending == 1) {
            session_destroy();
            $alert_message = "Your request is currently under review. Please wait while our team processes it..";
        }else{
            if ($role === "admin") {
            header("Location: admin/dashboard.php");
            exit();
            }
            if ($role === "doctor") {
                header("Location: doctor/directory.php");
                exit();
            }
            if ($role === "patient") {
                header("Location: patient/dashboard.php");
                exit();
            }
        }
        

    } else {
        $alert_message = "IC Number, Password, or Role is incorrect.";
    }

    mysqli_close($connect);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pink Book</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(270deg, #ff5272 0%, rgb(255, 151, 168));
        }

        .login {
            border: none;
            padding: 30px;
            border-radius: 25px;
            background-color: white;
            width: 400px; 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .tab-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 20px;
        }

        .roleButton {
            font-size: 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            background-color: rgb(255, 255, 255);
            color: rgb(0, 0, 0);
            transition: background-color 0.2s, color 0.2s;
            width: 49%; 
            padding: 10px;
            font-weight: 600;
        }

        .roleButton.active {
            background-color: rgb(255, 105, 130);
            color: white;
        }

        fieldset {
            border: 1px solid rgba(0, 0, 0, 0.12);
            border-radius: 14px;
            padding: 25px 20px;
            margin: 0;
            width: 100%;
        }

        #staffRole {
            text-align: center;
            font-size: 16px;
            color: rgb(91, 91, 91);
            margin-bottom: 15px;
        }

        .radio-label {
            display: inline-flex;
            align-items: center;
            font-size: 16px;
            font-weight: normal;
            color: #333;
            cursor: pointer;
            margin: 0 12px;
        }

        input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            background-color: #fff;
            margin: 0 6px 0 0;
            width: 18px;
            height: 18px;
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
            width: 9px;
            height: 9px;
            border-radius: 50%;
            transform: scale(0);
            transition: 0.15s transform ease-in-out;
            background-color: rgb(255, 105, 130);
        }

        input[type="radio"]:checked {
            border-color: rgb(255, 105, 130);
            box-shadow: 0 0 0 4px rgba(255, 105, 130, 0.3);
        }

        input[type="radio"]:checked::before {
            transform: scale(1);
        }

        label.field-label {
            display: block;
            font-size: 16px;
            font-weight: 600;
            color: rgb(40, 40, 40);
            margin-bottom: 5px;
        }

        #textfield {
            font-size: 15px;
            border-radius: 8px;
            border: 1px solid rgb(190, 190, 190);
            width: 100%;
            height: 40px;
            padding: 8px 10px;
            margin-bottom: 15px;
            color: rgb(50, 50, 50);
            transition: border-color 0.2s;
        }

        #textfield:focus {
            border: 1.5px solid rgb(255, 105, 130);
            outline: none;
        }

        #button,button {
            font-size: 20px;
            border: none;
            border-radius: 8px;
            background-color: rgb(255, 105, 130);
            color: white;
            width: 100%;
            padding: 10px;
            font-weight: 600;
            margin-top: 10px;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        #button:hover {
            opacity: 0.95;
        }

        p {
            color: rgb(140, 140, 140);
            text-align: center;
            margin: 0;
        }

        hr {
            border: none;
            height: 1px;
            background-color: rgb(225, 225, 225);
            margin: 15px 0 10px 0;
        }

        a {
            color: rgb(255, 123, 145);
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }
        .card-title {
            font-size: 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
            margin: 0;
            color: white;
            padding: 15px 30px 15px 30px;
            background-color: rgb(255, 105, 130);
        }
        
        .card-body {
            background-color: #ffffff;
            color: #9b001c;
            font-weight: 600;
            min-height: 50px;
            padding: 20px;
        }
        .card{
            background-color: white;
        }
        dialog {
            border: none;
            border-radius: 20px;
            padding: 0;
            background: transparent;
        }

        dialog::backdrop {
            background: rgba(0, 0, 0, 0.5);
        }
        .radio-box{
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            margin-top: 20px;
        }
        .input-wrap{
            margin-bottom: 10px;
            margin-left: 20px;
        }
       
    </style>
</head>
<body>

    <?php if (isset($alert_message)): ?>
        <script>alert("<?php echo $alert_message; ?>");</script>
    <?php endif; ?>

    <div class="login">
        <form action="" method="POST">

            <div class="tab-container">
                <button type="button" class="roleButton active" onclick="showRole('patient', this)">
                    Patient
                </button>
                <button type="button" class="roleButton" onclick="showRole('staff', this)">
                    Staff
                </button>
            </div>

            <fieldset>
                <input type="hidden" name="role" id="selectedRole" value="patient">

                <div id="staffRole" style="display:none;">
                    <label class="radio-label">
                        <input type="radio" name="staffRole" value="doctor" id="radioDoctor">
                        Doctor
                    </label>

                    <label class="radio-label">
                        <input type="radio" name="staffRole" value="admin" id="radioAdmin">
                        Admin
                    </label>
                    <hr>
                </div>

                <label class="field-label">IC Number:</label>
                <input type="text" name="icNum" id="textfield" required>

                <label class="field-label">Password:</label>
                <input type="password" name="password" id="textfield" required>

                <p style="font-size:13px;">
                    <a href="#" onclick="document.getElementById('editCard').showModal()">Forgot your password?</a>
                </p>

                <input type="submit" id="button" value="Log In" name="login">
            </fieldset>

            <p style="margin-top:20px; font-size:14px;">
                First time signing in?
                <a href="register.php">Create your account</a>
            </p>
        </form>
    </div>
  
        <dialog id="editCard">
    <div class="card">
        <div class="card-title">Request Password Change?</div>

        <div class="card-body" style="border-radius:30px">
            <form action="admin/manage password.php" method="POST">
                <input type="hidden" name="forgot_password" value="1">

                <div class="input-wrap">
                    IC Number &emsp;&emsp;&ensp; :
                    <input type="text" name="icNum" placeholder="Enter IC Number" required> 
                </div>
                <div class="input-wrap">
                    Email address &emsp; :
                    <input type="email" name="email" placeholder="example@gmail.com" required> 
                </div>
               
                <div class="radio-box">
                <input type="radio" name="role" value="patient" checked> <label>Patient</label> &emsp;
                <input type="radio" name="role" value="doctor"> <label>Doctor</label>&emsp;
                <input type="radio" name="role" value="admin"> <label>Admin</label>&emsp;
                </div>

                <center>
                    <button type="submit" name="forgotPassword" class="blue-button" style="font-size:20px;padding:10px;width:150px;">Send</button> &emsp;&emsp;
                    <button type="button" class="blue-button cancelBtn" style="font-size:20px;padding:10px;width:150px;">Cancel</button>
                </center>
            </form>
        </div>
    </div>
</dialog>
    
    <script>
    function showRole(role, clickedButton) {
        const buttons = document.querySelectorAll('.roleButton');
        buttons.forEach(btn => {
            btn.classList.remove('active');
        });

        clickedButton.classList.add('active');

        const staffSection = document.getElementById("staffRole");
        const selectedRole = document.getElementById("selectedRole");

        if (role === 'patient') {
            staffSection.style.display = "none";
            selectedRole.value = "patient";
            
            document.querySelectorAll('input[name="staffRole"]').forEach(radio => {
                radio.checked = false;
                radio.removeAttribute('required');
            });
        } else {
            staffSection.style.display = "block";
            if(!document.getElementById("radioDoctor").checked && !document.getElementById("radioAdmin").checked){
                document.getElementById("radioDoctor").checked = true;
                selectedRole.value = "doctor";
            }
        }
    }

    const roleRadios = document.querySelectorAll('input[name="staffRole"]');
    roleRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            document.getElementById("selectedRole").value = this.value;
        });
    });
  
    document.querySelectorAll(".editBtn").forEach(button => {
        button.addEventListener("click", function () {
            const userID = this.dataset.id;

            document.getElementById("editUserID").value = userID;
            document.getElementById("editCard").showModal();
        });
    });

    document.querySelectorAll(".cancelBtn").forEach(button => {
    button.addEventListener("click", function () {
        document.getElementById("editCard").close();
        window.location.href = "login.php";
    });
});
     
    </script>
</body>
</html>