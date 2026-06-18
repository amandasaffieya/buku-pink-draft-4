<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../template/staff.css">
    <title>Health Profile</title>
    <?php
    ob_start();
        session_start();

        if (!isset($_SESSION["userID"])) {
            header("Location: ../login.php"); 
            exit();
        }

        function countPending() {
            require __DIR__ . "/../db_connect.php";
            $sql = "SELECT COUNT(*) AS total FROM user WHERE pending = 1";
            $sendsql = mysqli_query($connect, $sql); 
            
            if (!$sendsql) {
                echo mysqli_error($connect);
            } else {
                $row = mysqli_fetch_assoc($sendsql);
                echo "<p class='count-label'>" . $row['total'] . "</p>";
            }
        }
        
        function countUser($role) {
        require __DIR__ . "/../db_connect.php";

        $sql = "SELECT pending FROM user";
		$sendsql = mysqli_query($connect,$sql);	
        if (!$sendsql){echo mysqli_error($connect);}
        $row = mysqli_fetch_assoc($sendsql);
        $pending = $row["pending"];


        if ($pending === 1){$sql = "SELECT COUNT(*) AS total FROM user WHERE pending = 1";}
        else if ($role === "user") {
            $sql = "SELECT COUNT(*) AS total FROM user WHERE pending = 0";
        } else {
            $sql = "SELECT COUNT(*) AS total
                    FROM user
                    WHERE role = '$role' AND pending = 0";
        }
        $sendsql = mysqli_query($connect, $sql);
        

        if (!$sendsql) {
            echo mysqli_error($connect);
        } else {
            $row = mysqli_fetch_assoc($sendsql);
            echo "<p class='count-label'>" . $row['total'] . "</p>";
        }
}

        
    ?>
     <?php include "header.php"; ?>
    <style>
    .form-wrap{
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;   
    }
    label{font-size: 20px;}
   
    .card-title{font-size: 30px;}
    input[type="radio"] {
    transform: scale(1.5);
    margin-right: 10px; 
    cursor: pointer;}
    .blue-button{
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
   table {
    width: 100% !important;
    table-layout: fixed;
    border-collapse: separate;
    border-spacing: 0 8px;
    padding: 0 20px;
    }

    .user-list {
        width: 100% !important;
    }

    .list-box {
    width: 90%;
    max-width: 1200px;   /* was hardcoded 1500-1600px */
    margin: 20px auto;
}
    th:first-child,td:first-child {
        text-align: left;
        padding-left: 20px;
    }
    th, td {
    margin: 0;
    padding: 12px 8px;
    text-align: center;
    vertical-align: middle;
}
    .user-list a, .role, .blue-button {
    text-decoration: none;
    color: white;
    font-weight: 600;
    padding: 5px 10px;
    height: 40px;
    margin: 0;
    border-radius: 30px;
    display: inline-flex;
    justify-content: center;
    width: 120px;  
    text-align: center;
    transition: opacity 0.2s;
    }
    .row-border td {
            font-size: 18px;
            background-color: #223baa27;
            color: #152684;
            margin: 20px;
            padding: 5px 20px;
        }
        .row-border td:first-child {
            border-radius: 20px 0 0 20px;
        }
        .row-border td:last-child {
            border-radius: 0 20px 20px 0;
        }
    
    .user-list{margin-top: 100px;}
    table {
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
    border-spacing: 0;
    }
    table {
    width: 100%;
    table-layout: fixed;
    border-collapse: separate;
    border-spacing: 0 20px;  
    padding: 0 20px;
}

th, td {
    margin: 0;
    padding: 12px 8px;
    text-align: center;
    vertical-align: middle;
}

th:first-child, td:first-child {
    text-align: left;
    padding-left: 20px;
}

.row-border td {
    font-size: 18px;
    background-color: #223baa27;
    color: #152684;
    padding: 5px 8px; 
}

.row-border td:first-child {
    border-radius: 20px 0 0 20px;
    padding-left: 20px;
}

.row-border td:last-child {
    border-radius: 0 20px 20px 0;
}

.user-list {
    width: 100%;
    padding: 0px;     
    margin-top: 0; 
    box-sizing: border-box;
    padding-bottom: 20px;
}
.table-wrap{
    margin-left: 20px;
}
button{font-size: 17px;}

</style>
</head>
<body>

   
    <div class="menu-links" style="width: 280px;">
                <div class="menu-label">
                    <img src="moon.png" alt="crescent" id="moon-logo">
                    <p style="font-weight: 500; font-size:larger">Klinik Kesihatan Chendering</p>
                </div>
                <a href="dashboard.php">Dashboard</a>
                <a href="manage user.php" class="active">Manage User</a>
                <a href="manage password.php">Manage Password</a>
                <p style="height: 100px;"></p>
            </div>
        </div>

    <div class="main-content">
    <h1 class="title-box" style="margin:5px 0 7px 15px; text-align: left;">
        <span class="title" style="font-size: 80px;">Manage User</span>
    </h1> 
    <p id="subtitle" style="text-align: left;margin-left:15px;margin-bottom:0">
        To manage user access to the system..
    </p>

    
       <div class="table-wrap">
        <div class="list-box" style="width: 1500px;">

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
            <input type="button" name="return" value="Back" id="button" onclick="window.location.href='manage user.php';">
        </div>

        <div class="user-list">
            <?php
            $sql = "SELECT * FROM user";
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
                } else {echo "<p id = 'error'>Please choose a category to search patient.</p>";$show = false;}
                }
            } 
            $sql .= " ORDER BY pending DESC,role ASC";
            if ($show === true) { showTable($sql);}

            function showTable($sql){
                require __DIR__ . "/../db_connect.php";
                $sendsql = mysqli_query($connect,$sql);

                if ($sendsql){
                    if (mysqli_num_rows($sendsql) > 0){
                        echo "<table>
                        <tr>
                            <th style='width:5%'>ID</th>
                            <th style='width:35%'>User Name</th>
                            <th style='width:12%'>Status</th>
                            <th style='width:12%'>Role</th>
                            <th style='width:12%'>Profile</th>
                            <th style='width:12%'>Approve</th>
                            <th style='width:12%'>Action</th>
                        </tr>";

                        foreach($sendsql as $row){
                            echo "<tr class='row-border'>";
                            echo "<td>" . $row["userID"] . "</td>";
                            echo "<td style='text-align:left; padding-left:10px;'>" . $row["fullName"] . "</td>";
                            displayPending($row["pending"]);
                            echo "<td><span class='role " . strtolower($row["role"]) . "'>" . strtoupper($row["role"]) . "</span></td>";
                            linkProfile($row["role"], $row["userID"]);
                            echo "<td><button class='blue-button editBtn' data-id='" . $row["userID"] . "'>UPDATE</button></td>";
                            echo "<td><button class='blue-button deleteBtn' style='background: linear-gradient(90deg, rgb(204,0,0), #e90000);' data-id='" . $row["userID"] . "'>DELETE</button></td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }else{echo "<p id = 'error'>No matching records found.</p>";}
                }else{echo mysqli_error($connect);}
            }
            function displayPending($pending){
                if ($pending == 1) {echo "<td style = 'color:red'>PENDING</td>";
                }else {echo "<td>APPROVED</td>";}
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
            if (isset($_POST['Edit'])) {
            require __DIR__ . "/../db_connect.php";
            
            $editUserID = mysqli_real_escape_string($connect, $_POST['userID']);
            $newRole = mysqli_real_escape_string($connect, $_POST['role']);
            $newStatus = mysqli_real_escape_string($connect, $_POST['status']);
            
            $sendsql = "UPDATE user SET role = '$newRole', pending = '$newStatus' WHERE userID = '$editUserID'";
            
            if (mysqli_query($connect, $sendsql)) {
                header("Location: manage user.php");
                exit();
            } else {
                echo "<script>alert('Error updating record: " . mysqli_error($connect) . "');</script>";
            }
        }

            ?>
            
           
            
        </div>
       </form>
    </div>
       </div>
        
            <dialog id="deleteCard" class="card">
            <div class="card-title">Confirm Delete?</div>
            <div class="card-body" style="padding: 20px;margin:0;width:100%; border-radius:10px">
                <button class="blue-button"style="font-size: 20px;padding:25px; width:120px; margin-right:10px"><a id="confirmDeleteBtn" href="#" style="text-decoration: none;color:white;">Delete</a></button>
                <button class="blue-button cancelBtn" style="font-size: 20px;padding:25px;width:120px">Cancel</button>
            </div>
            </dialog>
      

   
            <dialog id="editCard" class="card">
        <div class="card-title">Confirm Edit?</div>
        <div class="card-body" style="border-radius:30px">

        <form action="" method="POST">
            <input type="hidden" name="userID" id="editUserID" value="">

            <div class="form-wrap">
                <div class="radio-box">
                <input type="radio" name="role" value="patient" checked> <label>Patient</label> &emsp;
                <input type="radio" name="role" value="doctor"> <label>Doctor</label>&emsp;
                <input type="radio" name="role" value="admin"> <label>Admin</label>&emsp;
                </div>
            
            <select name="status" id="status" style="transform: scale(1.5);margin-top:20px;margin-bottom:30px;width:200px;background-color: #f6f7ff">
                <option value="0">APPROVED</option>
                <option value="1">PENDING</option>
            </select>
            </div>
    
            <center><button type="submit" name="Edit" class="blue-button"style="font-size: 25px;padding:25px;width: 150px;" >Edit</button>&emsp;&emsp;
            <button type="button" class="blue-button cancelBtn" style="font-size: 25px;padding:25px;width: 150px;">Cancel</button></center>
        </form>
        </div>
        </dialog>
    </div>
</div>
  
    <footer>
        <center><p>&copy 2026 Klinik Kesihatan Chendering. All rights reserved.</p></center>
    </footer>

    <script>
            document.querySelectorAll(".editBtn").forEach(button => {
                button.addEventListener("click", function () {
                    const userID = this.dataset.id;

                    document.getElementById("editUserID").value = userID;
                    document.getElementById("editCard").showModal();
                });
            });

            document.querySelectorAll(".deleteBtn").forEach(button => {
                button.addEventListener("click", function () {
                    const userID = this.dataset.id;

                    document.getElementById("confirmDeleteBtn").href =
                        "delete.php?userID=" + userID;

                    document.getElementById("deleteCard").showModal();
                });
            });

            document.querySelectorAll(".cancelBtn").forEach(button => {
                button.addEventListener("click", function () {
                    const deleteDialog = document.getElementById("deleteCard");
                    const editDialog = document.getElementById("editCard");

                    if (deleteDialog.open) {
                        deleteDialog.close();
                    }

                    if (editDialog.open) {
                        editDialog.close();
                    }
                });
            });
        </script>
    </body>
</html>