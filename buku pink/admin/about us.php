<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../template/staff.css">
    <title>About Us</title>
    <?php include "header.php"; ?>
    <style>
        .main-content {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start; 
            margin-bottom: 0; 
        }

        .contact-us {
            background: linear-gradient(90deg,  rgb(10, 14, 66), #152684);            width: 100%;
            margin: 0;
            margin-top: 70px;
            opacity: 0.9;
            color: white;
            border: 1px solid white;
            padding: 20px;
            overflow: hidden; 
        }
        .contact-us a{color: white;}
        .label-box h2{ color: #1d2a9f;}
        .pic{
            height: 200px;
            width: 200px;
        }
        .white-box{
            border: 2px solid transparent; 
            width: 80%;
            box-shadow: 0 4px 12px rgba(49, 50, 68, 0.14);
            display: flex;
            flex-direction: row;
            padding-bottom: 10px;
            padding-top: 10px;
            margin: 0;
            margin-left: 110px;
            margin-bottom: 15px;
        }
        .white-box:hover{border-color: #02136f;}
        .contact-us,.contact-content,.title-box,.white-box,.white-box img,.contact-content p{transition: border-color 0.3s ease, transform 0.3s ease-in-out;}
        .contact-us:hover,.contact-content:hover,.title-box:hover,.white-box:hover,.white-box img:hover,.contact-content p:hover{ transform:translateY(-4px);}
        .text-box{
            font-size: 35px;
            font-weight: 600;
            margin-top: 0;
            margin-left: 30px;
        }
        .title-box{
            margin-top: 60px;
            margin-left: 50px;
            margin-bottom: 25px;
        }
        .contact-content{
            padding-left: 110px;
            padding-bottom: 70px;
        }
        footer {
        margin-top: 0;
        padding: 10px 0;
        width: 1400px;
        }
        header{
            max-width: 1400px;
        }
        .text-box p {
            margin-top: 15px;    
            margin-bottom: 5px; 
        }

    
    </style>
    <script>
        function logout (){
            var choice = confirm("Leave the website?");
            if (choice){
                alert("See you again!");
                window.location.href = "../index.php";
            }
        }
    </script>
</head>
<body>
    
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
        </div>

    <div class="main-content"> 
        <h1 class="title-box"><span class="title">Meet The Team</span></h1>
        <div class="white-box">
            <img src="../template/doctor-icon/amanda.png" class="pic">
            <div class="text-box">
                <p><i>"Make mothers happy, that's all"</i></p>
                <p style="font-size: 15px; opacity: 0.8;margin-left:15px">- Amanda Saffieya Binti Anis Shirwan</p>
                <p style="font-size: 12px; opacity: 0.5;margin-left:15px">Lead Programmer <br>Contact: 011-11243119 <br>Email: amandasaffieya@gmail.com
                </p>
            </div>
        </div>
        <div class="white-box">
            <img src="../template/amanda-staff.png" class="pic">
            <div class="text-box">
                <p><i>"Make mothers happy, that's all"</i></p>
                <p style="font-size: 15px; opacity: 0.8;margin-left:15px">- Amanda Saffieya Binti Anis Shirwan</p>
                <p style="font-size: 12px; opacity: 0.5;margin-left:15px">Lead Programmer <br>Contact: 011-11243119 <br>Email: amandasaffieya@gmail.com
                </p>
            </div>
        </div>
        <div class="white-box">
            <img src="../template/amanda-staff.png" class="pic">
            <div class="text-box">
                <p><i>"Make mothers happy, that's all"</i></p>
                <p style="font-size: 15px; opacity: 0.8;margin-left:15px">- Amanda Saffieya Binti Anis Shirwan</p>
                <p style="font-size: 12px; opacity: 0.5;margin-left:15px">Lead Programmer <br>Contact: 011-11243119 <br>Email: amandasaffieya@gmail.com
                </p>
            </div>
        </div>
        <div class="white-box">
            <img src="../template/amanda-staff.png" class="pic">
            <div class="text-box">
                <p><i>"Make mothers happy, that's all"</i></p>
                <p style="font-size: 15px; opacity: 0.8;margin-left:15px">- Amanda Saffieya Binti Anis Shirwan</p>
                <p style="font-size: 12px; opacity: 0.5;margin-left:15px">Lead Programmer <br>Contact: 011-11243119 <br>Email: amandasaffieya@gmail.com
                </p>
            </div>
        </div>

        <div class="contact-us">
            <h1 class="title-box"><span style="font-size: 70px; color:white; margin-left:0">Contact Us</span></h1>
            <div class="contact-content">
                <p>Connect with us through phone calls or email and we'll be right back at you!</p>
                <p>Tel: +6011-11243119</p>
                <p>Fax: +6011-11243119</p>
                <a href="mailto:amandasaffieya@gmail.com">Email Us Here</a>
            </div>
        </div>


    </div>
</div>
  
    <footer>
        <center><p>&copy 2026 Klinik Kesihatan Chendering. All rights reserved.</p></center>
    </footer>
    </body>
</html>