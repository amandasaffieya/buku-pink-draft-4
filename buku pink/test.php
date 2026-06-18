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

        // Handle confirm changes POST
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["confirm_userID"])) {
            require __DIR__ . "/../db_connect.php";

            $updateID  = mysqli_real_escape_string($connect, $_POST["confirm_userID"]);
            $newRole    = mysqli_real_escape_string($connect, $_POST["new_role"]);
            $newPending = mysqli_real_escape_string($connect, $_POST["new_pending"]);

            $allowedRoles   = ["doctor", "patient", "admin"];
            $allowedPending = ["0", "1"];

            if (in_array($newRole, $allowedRoles) && in_array($newPending, $allowedPending)) {
                $sql = "UPDATE user SET role = '$newRole', pending = '$newPending' WHERE userID = '$updateID'";
                $result = mysqli_query($connect, $sql);
                if (!$result) {
                    echo "<script>alert('Update failed: " . mysqli_error($connect) . "');</script>";
                }
            }

            // Redirect to clear POST and keep any active search params
            $redirect = "dashboard.php";
            if (!empty($_POST["redirect_query"])) {
                $redirect .= "?" . $_POST["redirect_query"];
            }
            header("Location: $redirect");
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
            $sendsql = mysqli_query($connect, $sql);	
            if (!$sendsql) { echo mysqli_error($connect); }
            $row = mysqli_fetch_assoc($sendsql);
            $pending = $row["pending"];

            if ($pending === 1) {
                $sql = "SELECT COUNT(*) AS total FROM user WHERE pending = 1";
            } else if ($role === "user") {
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

    <style>
        /* --- inline dropdowns: match the search-box <select> style --- */
        .inline-select {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: #1a1252;
            background-color: #ffffff;
            border: 1.5px solid rgb(18, 26, 135);
            border-radius: 20px;
            padding: 5px 14px;
            cursor: pointer;
            transition: transform 0.2s ease-in-out, opacity 0.2s ease-in-out;
            appearance: none;
            -webkit-appearance: none;
        }
        .inline-select:hover {
            transform: translateY(-2px);
            opacity: 0.85;
        }
        .inline-select:focus {
            outline: none;
            border-color: rgb(10, 14, 66);
        }

        /* --- confirm button: mirrors header <input> style --- */
        .confirm-btn {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #ffffff;
            background: linear-gradient(270deg, rgb(10, 14, 66), #152684);
            border: none;
            border-radius: 20px;
            padding: 6px 18px;
            cursor: pointer;
            white-space: nowrap;
            transition: transform 0.3s ease-in, opacity 0.3s ease-in-out;
        }
        .confirm-btn:hover {
            transform: translateY(-3px);
            opacity: 0.8;
        }

        td.controls-cell {
            white-space: nowrap;
            padding: 6px 10px;
            vertical-align: middle;
        }
    </style>
</head>
<body>

    <?php include "header.php"; ?>
    <div class="menu-links" style="width: 280px;">
        <div class="menu-label">
            <img src="moon.png" alt="crescent" id="moon-logo">
            <p style="font-weight: 500; font-size:larger">Klinik Kesihatan Chendering</p>
        </div>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="manage user.php">Manage User</a>
        <a href="report.php">Generate Report</a>
        <p style="height: 100px;"></p>
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
                <p class="total-label">Total User</p>
                <?php countUser('user'); ?>
            </div>
            <div class="white-box" id="counter">
                <p class="total-label">Total Patient</p>
                <?php countUser('patient'); ?>
            </div>
            <div class="white-box" id="counter">
                <p class="total-label">Total Doctor</p>
                <?php countUser('doctor'); ?>
            </div>
            <div class="white-box" id="counter">
                <p class="total-label">Pending Request</p>
                <?php countPending(); ?>
            </div>
        </div>

        <div class="list-box" style="width: 1300px; margin-top: 20px;">

            <div class="search-box">
                <form action="" method="GET">
                    <select name="category">
                        <option value="">Search by</option>
                        <option value="name" <?php if (isset($_GET['category']) && $_GET['category'] === 'name') echo 'selected'; ?>>NAME</option>
                        <option value="ic" <?php if (isset($_GET['category']) && $_GET['category'] === 'ic') echo 'selected'; ?>>IC NUMBER</option>
                    </select>
                    <input type="text" name="search" id="search" placeholder="Search a patient here..."
                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <input type="submit" name="submit" value="🔎" id="button">
                </form><br><br>
                <input type="button" name="return" value="Back" id="button" onclick="window.location.href='dashboard.php';">
            </div>

            <div class="user-list">
                <?php
                // Build the redirect query string to preserve search after POST
                $redirectQuery = http_build_query(array_filter([
                    'category' => $_GET['category'] ?? '',
                    'search'   => $_GET['search'] ?? '',
                    'submit'   => isset($_GET['submit']) ? '1' : '',
                ]));

                $sql = "SELECT userID, fullName, icNum, role, pending FROM user";
                $show = true;

                if (isset($_GET["submit"])) {
                    $category = $_GET["category"];
                    $search   = $_GET["search"];

                    if ($search === "") {
                        echo "<p id='error'>Please enter a value to search.</p>";
                        $show = false;
                    } else {
                        if ($category === "name") {
                            $sql .= " WHERE fullName LIKE '%$search%'";
                        } else if ($category === "ic") {
                            $sql .= " WHERE icNum LIKE '$search'";
                        } else {
                            echo "<p id='error'>Please choose a category to search patient.</p>";
                            $show = false;
                        }
                    }
                }
                $sql .= " ORDER BY role ASC";
                if ($show === true) { showTable($sql, $redirectQuery); }

                function showTable($sql, $redirectQuery) {
                    require __DIR__ . "/../db_connect.php";
                    $sendsql = mysqli_query($connect, $sql);

                    if ($sendsql) {
                        if (mysqli_num_rows($sendsql) > 0) {
                            echo "<table border='1px'>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>IC Number</th>
                                <th>Role</th>
                                <th>Pending</th>
                                <th>Action</th>
                                <th>Profile</th>
                            </tr>";

                            foreach ($sendsql as $row) {
                                $uid     = htmlspecialchars($row["userID"]);
                                $role    = strtolower($row["role"]);
                                $pending = $row["pending"];

                                echo "<tr class='row-border'>";
                                echo "<td>" . $uid . "</td>";
                                echo "<td style='text-align: left; padding-left: 30px; width:500px'>" . htmlspecialchars($row["fullName"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["icNum"]) . "</td>";

                                // Role dropdown
                                echo "<td class='controls-cell'>
                                    <form method='POST' action='dashboard.php' id='form_$uid' style='display:inline'>
                                    <input type='hidden' name='confirm_userID' value='$uid'>
                                    <input type='hidden' name='redirect_query' value='" . htmlspecialchars($redirectQuery) . "'>
                                    <select name='new_role' class='inline-select'>
                                        <option value='doctor'" . ($role === 'doctor' ? ' selected' : '') . ">DOCTOR</option>
                                        <option value='patient'" . ($role === 'patient' ? ' selected' : '') . ">PATIENT</option>
                                        <option value='admin'" . ($role === 'admin' ? ' selected' : '') . ">ADMIN</option>
                                    </select>
                                </td>";

                                // Pending dropdown (same form, continued)
                                echo "<td class='controls-cell'>
                                    <select name='new_pending' class='inline-select'>
                                        <option value='1'" . ($pending == 1 ? ' selected' : '') . ">PENDING</option>
                                        <option value='0'" . ($pending == 0 ? ' selected' : '') . ">APPROVED</option>
                                    </select>
                                </td>";

                                // Confirm button (closes form)
                                echo "<td class='controls-cell'>
                                    <button type='submit' class='confirm-btn' form='form_$uid'>Confirm Changes</button>
                                    </form>
                                </td>";

                                // View profile link (untouched)
                                linkProfile($row["role"], $row["userID"]);

                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<p id='error'>No matching patient records found.</p>";
                        }
                    } else {
                        echo mysqli_error($connect);
                    }
                }

                function linkProfile($role, $userID) {
                    if ($role === "patient") {
                        echo "<td><a id='view' href='../patient/patient profile.php?userID=$userID'>View</a></td>";
                    } else if ($role === "doctor") {
                        echo "<td><a id='view' href='../doctor/doctor profile.php?userID=$userID'>View</a></td>";
                    } else if ($role === "admin") {
                        echo "<td><a id='view' href='../admin/admin profile.php?userID=$userID'>View</a></td>";
                    } else {
                        echo "<td>-</td>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <footer>
        <center><p>&copy 2026 Klinik Kesihatan Chendering. All rights reserved.</p></center>
    </footer>
</body>
</html>
