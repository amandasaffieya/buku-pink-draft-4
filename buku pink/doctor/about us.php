<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../template/patient.css">
    <title>About Us</title>
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
            background: linear-gradient(90deg, #d60d46 0%, #ff4d6d 50%, #ffb3c1 100%);
            width: 100%;
            margin: 0;
            margin-top: 70px;
            opacity: 0.9;
            color: white;
            border: 1px solid white;
            padding: 20px;
            overflow: hidden; 
        }
        .label-box h2{ color: #e91c56;}
        .pic{
            height: 200px;
            width: 200px;
        }
        .white-box{
            border: 2px solid transparent; 
            width: 80%;
            box-shadow: 0 4px 12px rgba(68, 49, 59, 0.14);
            display: flex;
            flex-direction: row;
            padding-bottom: 10px;
            padding-top: 10px;
            margin: 0;
            margin-left: 110px;
            margin-bottom: 15px;
        }
        .white-box:hover{border-color: #d60d46;}
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
        }
        .text-box p {
            margin-top: 15px;    
            margin-bottom: 5px; 
        }
        .vid-wrap {
            position: relative;
            height: 300px;
            width: 100%;
            overflow: hidden;
            background: black; 
        }

        .vid-wrap video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
            

            .vid-wrap .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 400px;
            height: 100%;
            background: rgba(255, 0, 72, 0.8); 
            color: white;
            padding: 30px;
            }
            .vid-wrap .overlay2 {
            position: absolute;
            top: 0;
            right: 0;
            width: 400px;
            height: 100%;
            background: rgba(255, 0, 72, 0.8); 
            color: white;
            padding: 30px;
            }

            .vm-hero {
                position: relative;
                height: 300px;
                width: 100%;
                overflow: hidden;
            }
            .vm-hero video {
                width: 100%; height: 100%;
                object-fit: cover;
                position: absolute; inset: 0;
            }
            .vm-side-box {
                position: absolute;
                top: 0; bottom: 0;
                width: 320px;
                background: #d60d46b3;
                display: flex; flex-direction: column;
                justify-content: center;
                padding: 32px 28px;
                color: white;
                z-index: 2;
            }
            .vm-side-left  { left: 0;  border-radius: 0 20px 20px 0; }
            .vm-side-right { right: 0; border-radius: 20px 0 0 20px; }
            .vm-side-box h2 { font-size: 26px; font-weight: 600; margin: 0 0 8px; }
            .vm-side-box p  { font-size: 14px; line-height: 1.7; color: rgba(255,255,255,0.9); margin: 0; }
            .vm-dots { width: 36px; height: 4px; background: rgba(255,255,255,0.5); border-radius: 999px; margin: 10px 0; }
            .title-box {
                margin-top: 25px;  
                margin-left: 50px;
                margin-bottom: 10px;
            }
            .main-content {
                margin: 0;
                padding: 0;
                padding-top:0;
                
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
    <?php include "header.php"; ?>
    
    <div class="menu-links">
                <a href="dashboard.php">Dashboard</a>
                <a href="patient profile.php">Patient Profile</a>
                <a href="health profile.php">Health Profile</a>
                <a href="fmc.php">Fetal Movement Chart</a>
                <a href="appointment.php">Appointment</a>
                <a href="ultrasound.php">Ultrasound Gallery</a>
                <p style="height: 100px;"></p>
            </div>
        </div>

    <div class="main-content"> 
        <h1 class="title-box"><span class="title">About Us</span></h1>
            
        <div class="vm-hero">
        <video autoplay muted loop>
            <source src="../template/vid1.mp4" type="video/mp4">
        </video>
        <div class="vm-side-box vm-side-left">
            <h1>VISION</h1>
            <div class="vm-dots"></div>
            <p>To become a leading provider of quality healthcare services. It aims to ensure safe, efficient and accessible healthcare for all individuals.</p>
        </div>
        </div>

        <div class="vm-hero">
        <video autoplay muted loop>
            <source src="../template/vid2.mp4" type="video/mp4">
        </video>
        <div class="vm-side-box vm-side-right">
            <h1>MISSION</h1>
            <div class="vm-dots"></div>
            <p>To provide comprehensive and affordable healthcare services to the community with a goal to improve the overall health and quality of life.</p>
        </div>
        </div>



        <h1 class="title-box"><span class="title">Meet The Team</span></h1>
        <div class="white-box">
            <img src="../template/patient-icon/amanda.png" class="pic">
            <div class="text-box">
                <p><i>"Make mothers happy, that's all"</i></p>
                <p style="font-size: 15px; opacity: 0.8;margin-left:15px">- Amanda Saffieya Binti Anis Shirwan</p>
                <p style="font-size: 12px; opacity: 0.5;margin-left:15px">Lead Programmer <br>Contact: 011-11243119 <br>Email: amandasaffieya@gmail.com
                </p>
            </div>
        </div>
        <div class="white-box">
            <img src="../template/patient-icon/amanda.png" class="pic">
            <div class="text-box">
                <p><i>"Make mothers happy, that's all"</i></p>
                <p style="font-size: 15px; opacity: 0.8;margin-left:15px">- Amanda Saffieya Binti Anis Shirwan</p>
                <p style="font-size: 12px; opacity: 0.5;margin-left:15px">Lead Programmer <br>Contact: 011-11243119 <br>Email: amandasaffieya@gmail.com
                </p>
            </div>
        </div>
        <div class="white-box">
            <img src="../template/patient-icon/amanda.png" class="pic">
            <div class="text-box">
                <p><i>"Make mothers happy, that's all"</i></p>
                <p style="font-size: 15px; opacity: 0.8;margin-left:15px">- Amanda Saffieya Binti Anis Shirwan</p>
                <p style="font-size: 12px; opacity: 0.5;margin-left:15px">Lead Programmer <br>Contact: 011-11243119 <br>Email: amandasaffieya@gmail.com
                </p>
            </div>
        </div>
        <div class="white-box">
            <img src="../template/patient-icon/amanda.png" class="pic">
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
