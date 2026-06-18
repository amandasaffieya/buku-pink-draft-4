<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <?php
        session_start();

        if (!isset($_SESSION["userID"])) {
            echo "<script>alert('ERROR: Unable to fetch session, Please Try Again')</script>";
            header("Location: ../login.php"); 
            exit();
        }
        echo "sup " . $_SESSION["userID"];
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #dadef0ce;
            color: #1e293b;
        }
        .title{
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-top: 50px;
            padding-bottom: 40px;
            margin: 0 auto;
            max-width: 90%;            
            padding-left: 20px;
        }
        .welcome-section h1,.welcome-section h5,.appointment-reminder-card,.list-box{transition: transform 0.3s ease-out;}
        .welcome-section h1:hover,.welcome-section h5:hover,.appointment-reminder-card:hover,.list-box:hover{transform:translateY(-6px);}

        .welcome-section h1 {
            font-size: 65px;
            font-weight: 650;
            color: #192a72;
            margin-bottom: 10px;
            text-shadow: 4px 6px 8px rgba(53, 55, 67, 0.13);        }

        .welcome-section h5 {
            font-size: 25px;
            font-weight: 400;
            color: #152684c0;
            font-style: italic;
        }

        .appointment-reminder-card {
            width: 300px;
            background: linear-gradient(270deg,  rgb(10, 14, 66), #152684);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(17, 30, 108, 0.15);
        }

        .card-header-title {
            color: #ffffff;
            font-size: 19px;
            font-weight: 600;
            text-align: center;
            padding: 15px 0;
            letter-spacing: 0.5px;
        }

        .appointment-body {
            background-color: #ffffff;
            padding: 10px 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100px;
        }
        .list-box{
            background: linear-gradient(270deg,  rgb(10, 14, 66), #14268c);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(17, 31, 108, 0.22);
            max-width: 90%;
            margin: 0 auto 50px auto;
        }
        .patient-list{
            background-color: #ffffff;
            display: flex;
            justify-content: center; 
            align-items: center;
            min-height: 100px;
        }
        table{
            margin: 20px auto; 
            width: 95%;
            text-align: center;
            border-collapse: separate; 
            border-spacing: 0 15px;
        }
        table,th,td{
            border: none;
        }
        .row-border{transition: transform 0.3s ease-in-out;}
        .row-border:hover{transform: translateY(-3px);}
        th{
            font-size: 20px;
        }
        .row-border td {
            font-size: 18px;
            background-color: #223baa27;
            color: #152684;
            padding: 6px 8px;
        }
        .row-border td:first-child {
            border-radius: 20px 0 0 20px;
        }
        .row-border td:last-child {
            border-radius: 0 20px 20px 0;
        }
        .patient-list a,.risk{
            text-decoration: none;
            color: white;
            background-color: #152684;
            padding: 4px 8px;
            border-radius: 20px;
            display: inline-block; 
            width: 200px;          
            text-align: center;
            transition: opacity 0.2s;
        }
        .patient-list a:hover { opacity: 0.70;}
        .patient-list a:active {background-color: #5d73f4;}
        .risk {font-weight: 700; width:150px;transition: box-shadow 0.4s ease-in-out;cursor: pointer;}
        .low { background-color: #3fc146; }  
        .low:hover{box-shadow: 0 0 15px #3fc146;}  
        .medium { background-color: #e1d71e; }
        .medium:hover{box-shadow: 0 0 15px #e1d71e}
        .high { background-color: #e52a2a; }
        .high:hover{box-shadow: 0 0 15px  #e52a2a;}
        #error{color: #152684;}
        #error:hover{color: #3b51cf;}
        .search-box {
            margin: 30px auto 10px auto;
            width: 100%;
            display: flex;
            justify-content: center;
            border: none;
            outline: none;
            gap: 5px;
        }
        .search-box select, .search-box option,#button{
            font-size: 18px;
            text-align: center;
            padding: 7px 17px;
            border: none;
            font-weight: 600;
            border-radius: 25px;
            background-color: #475cd2;
            color: white;
            transition: background-color 0.3s;
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .search-box select:hover, #button:hover,.search-box:hover{transform:translateY(-2px);}
        .search-box select option{
            background-color: white;
            color: #152684;
            font-size: 15px;
        }  
        .search-box{transition: transform 0.3s ease-in-out;}
        .search-box form{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #d0d6ff;
            border-radius: 30px;
            gap: 15px;
            padding: 4px;
            width: 75%;
        }
        #search{
            font-size: 20px;
            background-color:transparent;
            padding: 4px 5px;
            border: none;
            outline: none;
            flex-grow: 1;
            color: #152684;
            width: 40%;
        }
        #search::placeholder{color: #1526847a; font-weight: 700;}
        footer{
            background: linear-gradient(270deg,  rgb(10, 14, 66), #14268c);
            color: #ffffff;
            padding: 8px 40px;
            font-weight: 100;
            font-size: 10px;
            border: 0.5px solid white;
            box-shadow: 0 10px 25px rgba(17, 31, 108, 0.177);
            margin: 0 auto;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        header{
        display: flex;
        align-items: center;
        gap: 20px;
        background: linear-gradient(270deg,  rgb(10, 14, 66), #152684);
        color: #ffffff;
        padding: 8px 40px;
        font-weight: 600;
        font-size: 15px;
        border: 0.5px solid white;
        box-shadow: 0 10px 25px rgba(17, 31, 108, 0.177);
        margin: 0 auto;
        }
        header p{
            margin-left: auto;
            margin-top: 0; margin-bottom: 0;
        }
        header .link {
            margin-left: auto;
            display: flex;
            gap: 20px;
        }
        header a {
            color: white;
            text-decoration: none;
            transition: transform 0.3s ease-in-out;
            border: none;
            width: auto;
            background-color: transparent;
        }
        header img {
        width: 45px;
        height: 45px;
        object-fit: contain;
        }
        header input{
            border: none;
            color: #1a1252;
            font-size: 15px;
            font-weight: 600;
            border-radius: 20px;
            padding: 6px 20px;
            transition: transform 0.3s ease-in, opacity 0.3s ease-in-out;
        }
        header input:hover,header a:hover{transform: translateY(-3px);opacity: 0.7; cursor: pointer;text-decoration: underline;}
    </style>
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

    <div class="title">
        
        <div class="welcome-section">
            <h1>Welcome, Dr Hanun</h1>
            <h5>Select patient to begin...</h5>
        </div>

        <div class="appointment-reminder-card">
            <div class="card-header-title">Appointment Reminder</div>
            <div class="appointment-body">
                <div class="appointment-details">
                    01/05/26 &nbsp;9.00AM
                    <div class="patient-name">Siti Sarah Shamina Binti Muhammad</div>
                </div>
            </div>
        </div>

    </div>
    <div class="list-box">

        <div class="search-box">
                <form action="" method="GET">
                <select name="category">
                    <option value="">Search by</option>
                    <option value="name">NAME</option>
                    <option value="ic">IC NUMBER</option>
                </select>
                <input type="text" name="search" id="search" placeholder="Search a patient here...">
                <input type="submit" name="submit" value="🔎" id="button">
            </form><br><br>
            <input type="button" name="return" value="Back" id="button" onclick="window.location.href='directory.php';">
        </div>

        <div class="patient-list">
            <?php
            $sql = "SELECT p.patientID, u.fullName, u.icNum, pr.riskStatus 
                    FROM patient p
                    INNER JOIN user u ON p.userID = u.userID
                    LEFT JOIN pregnancy pr ON p.patientID = pr.patientID";
            $show = true;

            if (isset($_GET["submit"])){
                $category = $_GET["category"];
                $search = $_GET["search"];
                
                if ($search === "") {echo "<p id = 'error'>Please enter a value to search.</p>";$show = false;}
                else {
                    if ($category === "name"){
                    $sql .= " WHERE u.fullName LIKE '%$search%'";
                } else if ($category === "ic"){
                    $sql .= " WHERE u.icNum LIKE '$search'";
                } else {echo "<p id = 'error'>Please choose a category to search patient.</p>";$show = false;}
                }
            } 
            if ($show === true) { showTable($sql);}

            function showTable($sql){
                require __DIR__ . "/../db_connect.php";
                $sendsql = mysqli_query($connect,$sql);

                if ($sendsql){
                    if (mysqli_num_rows($sendsql) > 0){
                        echo "<table border = 1px >
                        <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>IC Number</th>
                        <th>Risk Status</th>
                        <th>User Profile</th>
                        </tr>";

                        foreach($sendsql as $row){
                            
                            echo "<tr class = 'row-border'>";
                            echo "<td>". $row["patientID"]."</td>";
                            echo "<td style='text-align: left; padding-left: 30px;'>". $row["fullName"]. "</td>";
                            echo "<td>". $row["icNum"]."</td>";
                            echo "<td><p class='risk " . strtolower($row["riskStatus"]) . "'>" . strtoupper($row["riskStatus"]) . "</p></td>";
                            
                            echo "<td>
                                    <a href='dashboard.php?id=" . $row["patientID"] . "'>View</a>
                                </td>";
                            echo "</tr>";
                            
                        }
                        echo "</table>";
                    }else{echo "<p id = 'error'>No matching patient records found.</p>";}
                }else{echo mysqli_error($connect);}
            }
            ?>
        </div>
    </div>
    <footer>
        <p>&copy 2026 Klinik Kesihatan Chendering. All rights reserved.</p>
    </footer>
</body>
</html>