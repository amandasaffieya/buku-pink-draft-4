

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../template/patient.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Dashboard</title>
    <?php
        session_start();

        if (!isset($_SESSION["userID"])) {
            header("Location: ../login.php"); 
            exit();
        }
        $userID = $_SESSION["userID"];
    ?>
    <style>
        .card-title {
            font-size: 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0 30px 0 30px;
            background: linear-gradient(270deg,  #d60d46 0%, #ff4d6d 60%, #ff758f 100%);
        }

        .card a,.risk {
            font-weight: 700; width:300px;transition: box-shadow 0.4s ease-in-out;cursor: pointer;
            text-decoration: none;
            margin-left: auto;
            color: white;
            padding: 4px 8px;
            border-radius: 30px;
            display: inline-block;      
            text-align: center;
            transition: box-shadow 0.3s ease-in-out;}
        .risk{border: 2px solid white;}
        .low { background-color: #3fc146; }  
        .low:hover{box-shadow: 0 0 15px #3fc146;}  
        .medium { background-color: #e1d71e; }
        .medium:hover{box-shadow: 0 0 15px #e1d71e}
        .high { background-color: #e52a2a; }
        .high:hover{box-shadow: 0 0 15px  #e52a2a;}
        .main-content {
            margin: 50px;
        }
        
        .card a{background: linear-gradient(270deg,  #d60d46 0%, #ff4d6d 60%, #ff758f 100%);}
        .white-box{
            width:300px;
            height: 250x;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .white-box img,.white-box p,.white-box h1{padding: 0;margin: 4px 0 4px 0; text-align: center;}
        .white-box p{opacity: 0.7;}
        
        .menu{ min-width: 270px;}
        .icon{
            width: 95px;
            height: 95px;
        }
        #progressBar,#tip-box{
            width: 100%;
            height: 200px;
            display: flex;
            align-items: flex-start;
            margin-top: 13px;
        }
        #tip-box{
            background-color: transparent;
        }
        #progressBar progress {
            display: block;
            margin: 20px auto;
        }
        progress {
            width: 900px;
            height: 20px;
            -webkit-appearance: none;  
            -moz-appearance: none;     
            appearance: none;         
            border: none;         }    
        progress::-webkit-progress-bar {
            background-color: #ffdbe1;
            border-radius: 20px;
        }
        progress::-webkit-progress-value {
            background: #ff4d6d;
            border-radius: 30px;
        }
        progress::-moz-progress-bar {
            background-color: #ff4d6d;
            border-radius: 30px;
        }
        .progress-label {
            width: 900px;
            display: flex;
            justify-content: space-between;
            margin: 8px auto 0;
        }

        .progress-label p {
            margin: 0;
            text-align: center;
            font-size: 14px;
        }
        #week-label {
        font-weight: 600;
        font-size: 25px;
        margin-left: 10px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 14px; 
        }
        #button-icon{
            transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;}

        #button-icon:hover{
            transform: translate3d(-4px);
            background-color: #ffd6e4;
            cursor: pointer;}

        /* ── Appointment Banner ── */
        .appt-banner {
            text-decoration: none;
            width: 100%;
            background: linear-gradient(90deg,  #d60d46 0%, #ff4d6d 60%, #ff758f 100%);
            border-radius: 30px;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 12px rgba(43, 45, 60, 0.052);
            justify-content: space-between;
            margin-bottom: 16px;
            box-sizing: border-box;
            color: white;
        }
        .appt-banner .appt-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: 0.85;
            margin-bottom: 4px;
        }
        .appt-banner .appt-time {
            font-size: 22px;
            font-weight: 800;
        }
        .appt-play {
            width: 44px; height: 44px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.6);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; flex-shrink: 0;
            text-decoration: none;
        }
        .appt-play svg { margin-left: 3px; }

        /* ── Welcome + Days row ── */
        .welcome-row {
            display: flex;
            gap: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        /* ── Welcome card ── */
        .welcome-card {
            background: white;
            border-radius: 30px;
            padding: 34px;
            flex: 1;
            min-width: 0;
            box-shadow: 0 4px 12px rgba(43, 45, 60, 0.052);
        }
        .welcome-card .wc-title {
            font-size: 40px;
            font-weight: 900;
            color: #ed2d51;
            line-height: 1.1;
            margin-bottom: 10px;
        }
        .welcome-card .wc-name {
            font-size: 23px;
            font-weight: 700;
            color: #ff5c7a;
            margin-bottom: 22px;
            margin-left: 20px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 32px;
            margin-bottom: 24px;
            margin-left: 20px;
        }
        .info-item .info-label {
            font-size: 11px;
            font-weight: 700;
            color: #cc1638;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 3px;
        }
        .info-item .info-value {
            font-size: 16px;
            font-weight: 700;
            color: #ff748d;
            opacity: 0.8;
        }
        .view-profile-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            background: linear-gradient(90deg,  #d60d46 0%, #ff4d6d 60%, #ff758f 100%);
            color: white;
            border: none;
            border-radius: 15px;
            padding: 14px 20px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            box-sizing: border-box;
        }
        .view-profile-btn .btn-arrow {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: rgba(255,255,255,0.25);
            display: flex; align-items: center; justify-content: center;
        }

        /* ── Days to Go + Mini Calendar card ── */
        .days-card {
            background: white;
            border-radius: 30px;
            padding: 20px 16px;
            width: 200px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 4px 12px rgba(43, 45, 60, 0.052);
        }

        /* Mini calendar */
        .mini-cal { width: 100%; margin-bottom: 14px; }
        .cal-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 6px;
        }
        .cal-month-lbl { font-size: 13px; font-weight: 700; color: #ed2d51; }
        .cal-nav-btn {
            font-size: 18px; color: #ed2d51;
            cursor: pointer; background: none; border: none;
            line-height: 1; padding: 0 2px;
        }
        .cal-table { width: 100%; border-collapse: collapse; }
        .cal-table th {
            font-size: 9px; font-weight: 700; color: #ff4d6d;
            text-align: center; padding: 2px; text-transform: uppercase;
        }
        .cal-table td {
            font-size: 11px; text-align: center; padding: 2px 0;
            color: #555; border-radius: 4px;
        }
        .cal-table td.cal-today {
            background: linear-gradient(135deg, #ff3e62, #ff7f96);
            color: white; font-weight: 700;
            border-radius: 50%; width: 22px; height: 22px; line-height: 22px;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
         .cal-table td.cal-today:hover{
            transform: scale(1.2);
            opacity: 0.8;
         }
        .cal-table td.cal-due {
            background: #fce4ec; color: #e41c40; font-weight: 700; border-radius: 50%;
        }
        .cal-table td.cal-other { color: #ddd; }

        /* Days counter */
        .days-number {
            font-size: 60px; font-weight: 900;
            color: #ff4d6d; line-height: 1;
            margin-top: 30px;
            transition: transform 0.3s ease;
        }
        .days-lbl {
            font-size: 15px; font-weight: 800;
            color: #ff738d; text-align: center; margin-top: 4px;
            transition: transform 0.3s ease;
        }
        .days-number:hover{transform:translateY(-20px) scale(1.5);}
        .days-lbl:hover{transform: translateY(10px) scale(1.5);}

        .button-wrap{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 40px;
            width: 100%;
            margin-top: 13px;
        }
        .welcome-card,.days-card,.white-box,#progressBar{
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.3s ease, transform 0.3s ease-in-out
        }
        .welcome-card:hover,.days-card:hover,.white-box:hover,#progressBar:hover{
            border-color: #e52649;
            transform: translateY(-4px);
        }
        .appt-banner,.view-profile-btn{
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.3s ease, opacity 0.3s ease, transform 0.3s ease-in-out;
        }
        .appt-banner:hover,.view-profile-btn:hover{
            border-color: #ffffff;
            opacity: 0.8;
            transform: scale(0.99);
        }
            

    </style>
</head>
<body>

    <?php include "header.php"; ?>
    <div class="menu-links">
                <a href="dashboard.php" class="active">Dashboard</a>
                <a href="patient profile.php">Patient Profile</a>
                <a href="health profile.php">Health Profile</a>
                <a href="fmc.php">Fetal Movement Chart</a>
                <a href="appointment.php">Appointment</a>
                <a href="ultrasound.php">Ultrasound Gallery</a>
                <p style="height: 100px;"></p>
            </div>
        </div>

    <div class="main-content"> 
       <?php 
        require __DIR__ . "/../db_connect.php";

        $sql = "SELECT *, TIMESTAMPDIFF(YEAR, p.dateOfBirth, CURDATE()) AS age  
                FROM patient p
                INNER JOIN user u ON p.userID = u.userID
                LEFT JOIN pregnancy pr ON p.patientID = pr.patientID
                WHERE u.userID = '$userID'";

        $sendsql = mysqli_query($connect,$sql);
       
        if (!$sendsql){
            echo mysqli_error($connect);

            
        } elseif (mysqli_num_rows($sendsql) > 0){
            
            foreach($sendsql as $row){
                $gestationalAge = $row["gestationalAge"]; 
                $pregStatus = $row["pregStatus"];
                $lmpDate = $row["lmpDate"];
                $dueDate = $row["dueDate"];
                $daysToGo = max(0, (int)ceil((strtotime($dueDate) - time()) / 86400));
                $patientID = $row["patientID"];

                $apptSQL = "SELECT a.apptDate, a.apptTime, a.apptRoom
                FROM appointment a
                JOIN patient p ON a.patientID = p.patientID
                WHERE p.userID = '$userID'
                AND a.apptStatus = 'Scheduled'
                AND TIMESTAMP(a.apptDate, a.apptTime) >= NOW()
                ORDER BY TIMESTAMP(a.apptDate, a.apptTime) ASC
                LIMIT 1
                ";
                $apptResult = mysqli_query($connect, $apptSQL);
                if (!$apptResult) {
                    die(mysqli_error($connect));
                }
                $apptRow = $apptResult ? mysqli_fetch_assoc($apptResult) : null;
                $apptDisplay = $apptRow
                    ? date('d M Y', strtotime($apptRow['apptDate'])) . ' | ' . date('g:i A', strtotime($apptRow['apptTime'])) . ' | Room ' . $apptRow['apptRoom']
                    : 'No upcoming appointments';
                ?>

                <!-- Appointment Banner -->
                <a href="appointment.php" class="appt-banner" title="View your scheduled appointments">
                    <div>
                        <div class="appt-label">Next Appointment</div>
                        <div class="appt-time"><?php echo htmlspecialchars($apptDisplay); ?></div>
                    </div>

                    <div class="appt-play">
                        <svg width="14" height="16" viewBox="0 0 14 16" fill="none">
                            <path d="M2 1.5L12.5 8L2 14.5V1.5Z" fill="white"/>
                        </svg>
                    </div>
                </a>

                <!-- Welcome + Days to Go row -->
                <div class="welcome-row">

                    <!-- Welcome card -->
                    <div class="welcome-card">
                        <div class="wc-title">Welcome</div>
                        <div class="wc-name"><?php echo htmlspecialchars($row["fullName"]); ?>!</div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">IC Number</div>
                                <div class="info-value"><?php echo htmlspecialchars($row["icNum"]); ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Gestational Age</div>
                                <div class="info-value" id="gestAge"></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Age</div>
                                <div class="info-value"><?php echo $row["age"]; ?> years</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Estimated Due Date</div>
                                <div class="info-value" id="dueDate"></div>
                            </div>
                        </div>
                        <a href="patient profile.php?id=<?php echo $row['patientID']; ?>" class="view-profile-btn" title="View or edit your personal information here!">
                            View Full Profile
                            <span class="btn-arrow">
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                                    <path d="M2 6.5h9M7 2l4.5 4.5L7 11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                    </div>

                    <!-- Days to Go + Mini Calendar -->
                    <div class="days-card">
                        <div class="mini-cal">
                            <div class="cal-header">
                                <button class="cal-nav-btn" onclick="changeMonth(-1)">&#8249;</button>
                                <div class="cal-month-lbl" id="cal-month-label"></div>
                                <button class="cal-nav-btn" onclick="changeMonth(1)">&#8250;</button>
                            </div>
                            <table class="cal-table">
                                <thead>
                                    <tr><th>Su</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th></tr>
                                </thead>
                                <tbody id="cal-body"></tbody>
                            </table>
                        </div>
                        <div class="days-number" id="days-number"><?php echo $daysToGo; ?></div>
                        <div class="days-lbl" id="days-lbl">DAYS TO<br>GO!</div>
                    </div>

                </div>

                <script>
                    const dueDateStr = "<?php echo $dueDate; ?>";
                    const dueDate = new Date(dueDateStr);
                    const today = new Date();
                    today.setHours(0,0,0,0);
                    let viewYear = today.getFullYear();
                    let viewMonth = today.getMonth();
                    const monthNames = ['January','February','March','April','May','June','July','August','September','October','November','December'];

                    function renderCal() {
                        document.getElementById('cal-month-label').textContent = monthNames[viewMonth].slice(0,3) + ' ' + viewYear;
                        const firstDay = new Date(viewYear, viewMonth, 1).getDay();
                        const daysInMonth = new Date(viewYear, viewMonth+1, 0).getDate();
                        const prevDays = new Date(viewYear, viewMonth, 0).getDate();
                        let rows = '';
                        let dayCount = 1;
                        let nextDay = 1;
                        for (let r = 0; r < 6; r++) {
                            rows += '<tr>';
                            for (let c = 0; c < 7; c++) {
                                if (r === 0 && c < firstDay) {
                                    rows += `<td class="cal-other">${prevDays - firstDay + c + 1}</td>`;
                                } else if (dayCount > daysInMonth) {
                                    rows += `<td class="cal-other">${nextDay++}</td>`;
                                } else {
                                    const thisDay = new Date(viewYear, viewMonth, dayCount);
                                    const isToday = thisDay.getTime() === today.getTime();
                                    const isDue = dueDate && thisDay.toDateString() === dueDate.toDateString();
                                    let cls = '';
                                    if (isToday) cls = 'cal-today';
                                    else if (isDue) cls = 'cal-due';
                                    rows += `<td class="${cls}">${dayCount}</td>`;
                                    dayCount++;
                                }
                            }
                            rows += '</tr>';
                            if (dayCount > daysInMonth && r >= 4) break;
                        }
                        document.getElementById('cal-body').innerHTML = rows;
                    }

                    function changeMonth(dir) {
                        viewMonth += dir;
                        if (viewMonth < 0) { viewMonth = 11; viewYear--; }
                        if (viewMonth > 11) { viewMonth = 0; viewYear++; }
                        renderCal();
                    }

                    renderCal();
                    
                    function calculateDueDate(lmpDate) {
                        const lmp = new Date(lmpDate);
                        lmp.setDate(lmp.getDate() + 280);

                        return lmp.toLocaleDateString("en-GB", {day: "numeric",month: "long", year: "numeric"});
            
                    }
                    const lmpDate = "<?php echo $lmpDate; ?>";
                    document.getElementById("dueDate").textContent =calculateDueDate(lmpDate);

                    function calcGestAge(days) {
                        days = parseInt(days, 10);

                        const weeks = Math.floor(days / 7);
                        const remainingDays = days % 7;

                        return `${weeks} weeks ${remainingDays} days`;
                    }

                    const gestAge = "<?php echo $gestationalAge; ?>";
                    document.getElementById("gestAge").textContent = calcGestAge(gestAge);

                    if ("<?php echo $pregStatus; ?>" === "DELIVERED") {
                        document.getElementById("days-lbl").innerHTML = "Baby has arrived safely!";
                        document.getElementById("days-number").innerHTML = "Delivered";
                        document.getElementById("days-number").style.fontSize = "30px";
                        document.getElementById("days-number").style.marginBottom = "10px";

                    }
                </script>

                <?php
                $gestationalDays = (int)$gestationalAge;
                $totalPregnancyDays = 280; 
                $gestationalWeeks = floor($gestationalDays / 7) + 1;
                $gestationalWeeks = min($gestationalWeeks, 40);
                $progress = ($gestationalDays / $totalPregnancyDays) * 100;
                $progress = max(0, min(100, $progress));
                $tipLabel = "Week $gestationalWeeks - 1st Trimester";
                $tips = "Start taking 400mcg of folic acid daily to support the baby's early brain and spinal cord development. Listen to your body and rest often since your baby needs some good sleep!";

                if ($pregStatus === "DELIVERED"){
                    $tipLabel = "Congratulations, mummy!";
                    $tips = "Pregnancy milestones completed. Wishing you and your newborn a lifetime of happiness and healthy new beginnings!";
                } elseif ($gestationalWeeks >= 14) {
                    $tipLabel = "Week $gestationalWeeks - 2nd Trimester";
                    $tips = "Start sleeping on your left side to optimize blood and oxygen flow to your baby. Don't forget to boost your iron intake to support your body's increasing blood volume!";
                } else if ($gestationalWeeks === 40){
                    $tipLabel = "Week $gestationalWeeks - Your Due Date!";
                    $tips = "Your baby is ready to meet you!!";
                } else if ($gestationalWeeks >= 28){
                    $tipLabel = "Week $gestationalWeeks - 3rd Trimester";
                    $tips = "Remember to track your baby's movement daily! You should feel at least 10 movements or kicks within a 2-hour window during their active times. If you notice a sudden slowdown, contact your doctor right away!";
                }

                $weekLabel = "Pregnancy Progress - Week $gestationalWeeks out of Week 40";
                
                ?>

        <div class="button-wrap">
            <button class="white-box" onclick="window.location.href='health profile.php'" id="button-icon" title="View your health status!">
            <img src="../template/patient-icon/health.png" alt="" class="icon">
            <h1>Health</h1>
            <p style="font-size: 16px;">View your latest health test results!</p>
        </button>
        <div class="white-box" onclick="window.location.href='fmc.php'" id="button-icon" title="Your baby's waiting..">
            <img src="../template/patient-icon/fmc.png" alt="" class="icon">
            <h1 style="font-size: 28px;">Fetal Kick Count</h1>
            <p>Never forget to log your baby's movement</p>
        </div>
        <div class="white-box" onclick="window.location.href='appointment.php'" id="button-icon" title="You doctor's waiting!">
            <img src="../template/patient-icon/appointment.png" alt="" class="icon">
            <h1>Appointment</h1>
            <p>View your next appointment with your doctor</p>
        </div>
        </div>

        <div class="white-box" id="progressBar">
            <?php echo"<p id='week-label' style='font-weight: 600;font-size:25px; margin-left:10px; opacity:1; margin-bottom: 10px'>" . $weekLabel . "</p>";?>
            <progress value="<?php echo $progress; ?>" max="100" id="progress"></progress>
            <div class="progress-label">
                <p>Week 1</p>
                <p>2nd Trimester</p>
                <p>3rd Trimester</p>
                <p>Week 40</p>
            </div>
        </div>

        <div class="white-box" id="tip-box" style="border: 2px solid #e86c97">
        <p id="week-label">
        <i class="fa-solid fa-clock"></i>
        <span class="label-text">
            <?php echo $tipLabel; ?></span>
        </p>            
        <?php echo"<p style = 'text-align: left; margin-left:50px'>". $tips."</p>"; ?>
        </div>
    
    </div>
</div>
<?php 
            } // End of foreach
        } // End of elseif 
        ?>
  
    <footer>
        <center><p>&copy 2026 Klinik Kesihatan Chendering. All rights reserved.</p></center>
    </footer>
    </body>
</html>