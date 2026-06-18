<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../template/staff.css">
    <title>Health Profile</title>
    <?php
        session_start();

        if (!isset($_SESSION["userID"])) {
            header("Location: ../login.php"); 
            exit();
        }
        if (isset($_GET['id'])) {
            $_SESSION["patientID"] = $_GET['id'];
        }

        function countPending() {
            require __DIR__ . "/../db_connect.php";
            $sql = "SELECT COUNT(*) AS total FROM user WHERE pending = 1";
            $sendsql = mysqli_query($connect, $sql); 
            
            if (!$sendsql) {
                echo mysqli_error($connect);
            } else {
                $row = mysqli_fetch_assoc($sendsql);
                echo "<p class='count-label pending-label'>" . $row['total'] . "</p>";
            }
        }
        function countPassReq(){
            require __DIR__ . "/../db_connect.php";
            $sql = "SELECT COUNT(*) AS total FROM user WHERE forgot_pass = 1";
            $sendsql = mysqli_query($connect, $sql); 
            
            if (!$sendsql) {
                echo mysqli_error($connect);
            } else {
                $row = mysqli_fetch_assoc($sendsql);
                echo "<p class='count-label pending-label' style = 'color:#96df96;'>" . $row['total'] . "</p>";
            }
        }

        function countUser($role) {
            require __DIR__ . "/../db_connect.php";

            $sql = "SELECT COUNT(*) AS total
                    FROM user
                    WHERE role = '$role' AND pending = 0";

            $sendsql = mysqli_query($connect, $sql);

            if (!$sendsql) {
                echo mysqli_error($connect);
            } else {
                $row = mysqli_fetch_assoc($sendsql);
                echo "<p class='count-label'>" . $row['total'] . "</p>";
            }
        }
        
    ?>
 
</head>
<body>
    

    <?php include "header.php";?>
    
    <div class="menu-links" style="width: 280px;">
                <div class="menu-label">
                    <img src="moon.png" alt="crescent" id="moon-logo">
                    <p style="font-weight: 500; font-size:larger">Klinik Kesihatan Chendering</p>
                </div>
                <a href="dashboard.php" class="active">Dashboard</a>
                <a href="manage user.php">Manage User</a>
                <a href="manage password.php">Manage Password</a>
                <p style="height: 100px;"></p>
            </div>
        </div>

    <div class="main-content" style="margin: 0;">
    <h1 class="title-box" style="margin-top: 40px; margin-bottom: 5px; text-align: center;">
        <span class="title" style="font-size: 80px;">Welcome back, Admin!</span>
    </h1> 
    <p id="subtitle">
        Administrative console for the Maternal Health Record System
    </p>

    <div class="box-wrap">
        <div class="white-box" id="counter">
        <p class="total-label">Total Doctor</p>
        <?php countUser('doctor'); ?>
    </div>
    <div class="white-box" id="counter">
        <p class="total-label">Total Patient</p>
        <?php countUser('patient'); ?>
    </div>
    <div class="white-box" id="counter">
        <p class="total-label">Password Reset Request</p>
        <?php countPassReq(); ?>
    </div>
    <div class="white-box" id="counter">
        <p class="total-label">Pending Request</p>
        <?php countPending(); ?>
    </div>
    </div>
       <div class="list-box" style="width: 1300px;margin-top:20px">

        <div class="search-box">
                <form action="" method="GET">
                <select name="category">
                    <option value="">Search by</option>
                    <option value="name">NAME</option>
                    <option value="ic">IC NUMBER</option>
                    <option value="role">ROLE</option>
                </select>
                <input type="text" name="search" id="search" placeholder="Search a patient here...">
                <input type="submit" name="submit" value="🔎" id="button">
                
            </form><br><br>
            <input type="button" name="return" value="Back" id="button" onclick="window.location.href='dashboard.php';">
        </div>

        <div class="user-list">
            <?php
            $sql = "SELECT *
                    FROM user";

            $show = true;

            if (isset($_GET["submit"])){
                $category = $_GET["category"];
                $search = $_GET["search"];
                
                if ($search === "") {echo "<p id = 'error'>Please enter a value to search.</p>";$show = false;}
                else {
                    if ($category === "name"){
                    $sql .= " WHERE fullName LIKE '%$search%'";
                } else if ($category === "ic"){
                    $sql .= " WHERE icNum LIKE '$search'";
                }else if ($category === "role"){
                    $sql .= " WHERE role LIKE '$search'";
                }else {echo "<p id = 'error'>Please choose a category to search patient.</p>";$show = false;}
                }
            } 
            $sql .= " ORDER BY pending DESC,forgot_pass DESC,role ASC";
            if ($show === true) { showTable($sql);}

            function showTable($sql){
                require __DIR__ . "/../db_connect.php";
                $sendsql = mysqli_query($connect,$sql);

                if ($sendsql){
                    if (mysqli_num_rows($sendsql) > 0){
                        echo "<table border = 1px >
                        <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>IC Number</th>
                        <th>Role</th>
                        <th>Profile</th>
                        </tr>";

                        foreach($sendsql as $row){
                            $style = "";

                            if ($row["pending"] == 1) {
                                $style = "style='background-color: #ffd9d9;'";
                            } elseif ($row["forgot_pass"] == 1) {
                                $style = "style='background-color: #d9ffd9;'";
                            }
                            echo "<tr class='row-border' $style>";

                            echo "<td>". $row["userID"]."</td>";
                            echo "<td style='text-align: left; padding-left: 30px; width:600px'>". $row["fullName"]. "</td>";
                            echo "<td>". $row["icNum"]."</td>";
                            echo "<td><p class='role " . strtolower($row["role"]) . "'>" . strtoupper($row["role"]) . "</p></td>";
                                    linkProfile($row["role"], $row["userID"]);
                            echo "</tr>";
                        }
                        echo "</table>";
                    }else{echo "<p id = 'error'>No matching records found.</p>";}
                }else{echo mysqli_error($connect);}
            }

            function linkProfile($role, $userID){
                if ($role === "patient"){
                    echo "<td><a id='view' href='../patient/patient profile.php?userID=$userID'>View</a></td>";
                } else if ($role === "doctor"){
                    echo "<td><a id='view' href='../doctor/doctor profile.php?userID=$userID'>View</a></td>";
                } else if ($role === "admin"){
                    echo "<td><a id='view' href='../admin/admin profile.php?userID=$userID'>View</a></td>";
                } else {
                    echo "<td>-</td>";
                }
            }
 

            ?>
        </div>
    </div>
    </div>
</div>
  
    <footer>
        <center><p>&copy 2026 Klinik Kesihatan Chendering. All rights reserved.</p></center>
    </footer>
    </body>
</html>