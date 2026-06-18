<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pink Book</title>
    <script>
        function logout (){
            var choice = confirm("Leave the website?");
            if (choice){
                alert("See you again!");
                window.location.href = "../login.php";
            }
        }
    </script>
</head>
<body>
    <header>
        <img src="../template/logo-kkm.png" alt="logo">
        <span>Klinik Kesihatan Chendering</span>
        <div class="link">
        <a href="doctor profile.php">Profile</a>
        <a href="about us.php">About Us</a></div>
        <input type="button" value="LOG OUT" onclick="logout()">
    </header>

    <div class="dashboard-container">
        <div class="menu">
            <div class="menu-title-section">
                <h2>Main Menu</h2>
            </div>
            