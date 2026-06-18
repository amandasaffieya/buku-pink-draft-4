<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pink Book</title>
    <style>
        html, body {
        margin: 0;
        padding: 0;
        width: 100%;
        }
        header, footer {
            width: 100%;
            margin-left: 0;
            margin-right: 0;
            width: 1600px;
        }
        #moon-logo{
            width: 100px;
            height: 100px;
        }
        .menu-label{
            width: 200px;
            text-align: center;
            color: white;
            margin-left: 30px;
            padding: 15px 0;
        }
        
        .list-box{
            background: linear-gradient(270deg,  rgb(10, 14, 66), #14268c);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(17, 31, 108, 0.22);
            max-width: 90%;
            margin: 0 auto 50px auto;
        }
        .user-list{
            background-color: #ffffff;
            display: flex;
            justify-content: center; 
            align-items: center;
            min-height: 100px;
        }
        table {
            width: 95%;
            text-align: center;
            border-collapse: separate; 
            border-spacing: 0 20px; 
            width: 1200px;
            padding: 0 30px;
        }
        table,th,td{
            border: none;
        }
        .row-border{transition: transform 0.3s ease-in-out;}
        .row-border:hover{transform: translateY(-3px);}
        table th{
            font-size: 20px;
        }
        .row-border td {
            font-size: 18px;
            background-color: #223baa27;
            color: #152684;
            padding: 5px 20px;
        }
        .row-border td:first-child {
            border-radius: 20px 0 0 20px;
        }
        .row-border td:last-child {
            border-radius: 0 20px 20px 0;
        }
      
        .user-list a:hover { opacity: 0.70;}
        .user-list a:active {background-color: #5d73f4;}
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
            height: 45px;
        }
        .search-box select, .search-box option,#button{
            font-size: 17px;
            text-align: center;
            padding: 5px 15px;
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
        .search-box{
            transition: transform 0.3s ease-in-out;
           font-size: 18px;}
        .search-box form{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #dde2ff;
            border-radius: 30px;
            gap: 15px;
            padding: 4px;
            width: 75%;
        }
        #search{
            font-size: 18px;
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
        .user-list a,.role,.blue-button{
            text-decoration: none;
            color: white;
            font-weight: 600;
            padding: 5px 10px;
            height: 40px;
            margin: 0;
            border-radius: 30px;
            display: inline-flex; 
            justify-content: center;
            width: 100px;          
            text-align: center;
            width: 150px;
            transition: opacity 0.2s;
        }
        .user-list a,.blue-button{background: linear-gradient(270deg,  rgb(10, 14, 66), #14268c);}
        .role.patient { background-color: #d6ffe0; border: 2px solid #076219; color: #076219;} 
        .role.doctor  { background-color: #d6f3ff; border: 2px solid #005177; color: #004a86; }
        .role.admin   { background-color: #f8eaff; border: 2px solid #310054; color: #320062;}
        .box-wrap{
        display: flex;
        justify-content: center;
        gap: 20px;
        width: 100%;
}

        #counter{
            width: 230px;
            height: 180px;
            margin: 0 15px 0 20px;
        }
        #subtitle{
        font-size: 20px;
        font-weight: 550;
        opacity: 0.7;
        color: rgb(25, 31, 126);
        text-align: center;
        margin: 0 auto 30px auto;
        width: 100%;}
        .white-box{border: 2.5px solid  rgb(25, 31, 126);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        
        }
        .count-label{
            font-size: 70px;
            font-weight: 600;
            color: #808fe4;
            margin: 0;
            padding: 0;
        }
        .pending-label{
            color: #ff939a;
        }
        .total-label{
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            color: #39489b;
            margin: 0;
            padding: 0;
        }
        dialog::backdrop {
            background: rgba(0, 0, 0, 0.5);
        }
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
        <a href="admin profile.php">Profile</a>
        <a href="about us.php">About Us</a></div>
        <input type="button" value="LOG OUT" onclick="logout()">
    </header>

    <div class="dashboard-container">
        <div class="menu">
            <div class="menu-title-section">
                <h2>Main Menu</h2>
            </div>
            