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

    require __DIR__ . "/../db_connect.php";

    if (isset($_POST["forgotPassword"])) {
        $icNum = mysqli_real_escape_string($connect, $_POST["icNum"]);
        $email = mysqli_real_escape_string($connect, $_POST["email"]);
        $role  = mysqli_real_escape_string($connect, $_POST["role"]);

        $sql     = "SELECT * FROM user WHERE icNum = '$icNum' AND email = '$email' AND role = '$role'";
        $result  = mysqli_query($connect, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $userID  = $user["userID"];

            $update = "UPDATE user SET forgot_pass = 1 WHERE userID = '$userID'";
            mysqli_query($connect, $update);
            $_SESSION["fp_message"] = "success";
            header("Location: ../login.php");
            exit();
        } else {
            $_SESSION["fp_message"] = "error";
            header("Location: ../login.php");
            exit();
        }
    }

    if (isset($_POST["Edit"])) {
        if (!isset($_SESSION["userID"])) {
            header("Location: ../login.php");
            exit();
        }

        $editUserID  = mysqli_real_escape_string($connect, $_POST["userID"]);
        $newPassword = mysqli_real_escape_string($connect, $_POST["password"]);
        $sql = "UPDATE user SET password = '$newPassword' WHERE userID = '$editUserID'";

        if (mysqli_query($connect, $sql)) {
            header("Location: manage password.php?updated=1");
            exit();
        } else {
            echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
        }
    }

    if (!isset($_SESSION["userID"])) {
        header("Location: ../login.php");
        exit();
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
    max-width: 1200px;  
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
.password-wrap{
    transform: scale(1.2);
}
.a{margin: 0;padding: 0;}
td .blue-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}
td{
    overflow: hidden;
}

</style>
</head>
<body>

   
    <div class="menu-links" style="width: 280px;">
                <div class="menu-label">
                    <img src="moon.png" alt="crescent" id="moon-logo">
                    <p style="font-weight: 500; font-size:larger">Klinik Kesihatan Chendering</p>
                </div>
                <a href="dashboard.php">Dashboard</a>
                <a href="manage user.php">Manage User</a>
                <a href="manage password.php" class="active">Manage Password</a>
                <p style="height: 100px;"></p>
            </div>
        </div>

    <div class="main-content">
    <h1 class="title-box" style="margin:5px 0 7px 15px; text-align: left;">
        <span class="title" style="font-size: 80px;">Manage Password</span>
    </h1> 
    <p id="subtitle" style="text-align: left;margin-left:15px;margin-bottom:0">
        To handle requests, start by adding temporary password, notify through email and press done!
    </p>

    
       <div class="table-wrap">
        <div class="list-box" style="width: 1500px;">

        <div class="search-box" style="height: 25px;margin-bottom:0">
                
        </div>

        <div class="user-list">
            <?php
            $sql = "SELECT * FROM user WHERE forgot_pass = 1";
            showTable($sql);

            function showTable($sql){
                require __DIR__ . "/../db_connect.php";
                $sendsql = mysqli_query($connect,$sql);

                if ($sendsql){
                    if (mysqli_num_rows($sendsql) > 0){
                        echo "<table>
                        <tr>
                            <th style='width:5%'>ID</th>
                            <th style='width:33%'>User Name</th>
                            <th style='width:14%'>Password</th>
                            <th style='width:12%'>Role</th>
                            <th style='width:12%'>Manage</th>
                            <th style='width:12%'>Contact</th>
                            <th style='width:12%'>Actions</th>
                        </tr>";

                        foreach($sendsql as $row){
                            echo "<tr class='row-border'>";
                            echo "<td>" . $row["userID"] . "</td>";
                            echo "<td style='text-align:left; padding-left:10px;'>" . $row["fullName"] . "</td>";
                            echo "<td>" . substr($row["password"], 0, 13) . "</td>";
                            echo "<td><span class='role " . strtolower($row["role"]) . "'>" . strtoupper($row["role"]) . "</span></td>";
                            echo "<td><button class='blue-button editBtn' data-id='" . $row["userID"] . "'>UPDATE</button></td>";  
                            echo "<td><a href='mailto:" . $row["email"] . "' class='blue-button'>CONTACT</a></td>";    
                            echo "<td><button class='blue-button doneBtn' style='background: linear-gradient(90deg, rgb(16, 156, 0), #00e92f);' data-id='" . $row["userID"] . "'>DONE</button></td>";                            echo "</tr>";
                        }
                        echo "</table>";
                    }else{echo "<p id = 'error'>No password changing request currently.</p>";}
                }else{echo mysqli_error($connect);}
            }
            if (isset($_GET["updated"])) {
                echo "<script>alert('Password successfully updated. Notify the user through their email.')</script>";
            }
            

            if (isset($_POST['Done'])){
                require __DIR__ . "/../db_connect.php";
            
                $doneUserID = mysqli_real_escape_string($connect, $_POST['userID']);
                $sendsql = "UPDATE user SET forgot_pass = 0 WHERE userID = '$doneUserID'";
            
                if (mysqli_query($connect, $sendsql)) {
                    header("Location: manage password.php");
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
            <dialog id="editCard" class="card">
        <div class="card-title">Confirm Edit?</div>
        <div class="card-body" style="border-radius:30px">

        <form action="" method="POST">
            <input type="hidden" name="userID" id="editUserID" value="">

            <div class="form-wrap">
                <div class="password-wrap" style="margin-bottom: 20px;">
                    <label for="password">New password:</label><br>
                    <input type="password" name="password" required placeholder="Temporary password">
                </div>
            <center><button type="submit" name="Edit" class="blue-button"style="font-size: 25px;padding:25px;width: 150px;" >Edit</button>&emsp;&emsp;
            <button type="button" class="blue-button cancelBtn" style="font-size: 25px;padding:25px;width: 150px;">Cancel</button></center>
        </form>
        </div>
        </dialog>

        <dialog id="doneCard" class="card">
        <div class="card-title">Confirm Set?</div>
        <div class="card-body" style="border-radius:30px">
            <form action="" method="POST">
                <input type="hidden" name="userID" id="doneUserID">
                <center><button type="submit" name="Done" class="blue-button"style="font-size: 25px;padding:25px;width: 150px;">Confirm</button>&emsp;&emsp;
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

            document.querySelectorAll(".doneBtn").forEach(button => {
                button.addEventListener("click", function () {
                    const userID = this.dataset.id;

                    document.getElementById("doneUserID").value = userID;
                    document.getElementById("doneCard").showModal();
                });
            });

            document.querySelectorAll(".cancelBtn").forEach(button => {
                button.addEventListener("click", function () {
                    const doneDialog = document.getElementById("doneCard");
                    const editDialog = document.getElementById("editCard");

                    if (doneDialog.open) {
                        doneDialog.close();
                    }

                    if (editDialog.open) {
                        editDialog.close();
                    }
                });
            });
        </script>
    </body>
</html>