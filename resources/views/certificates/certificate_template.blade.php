<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate Preview</title>
    
    <style>
        @font-face{
            font-family: 'BeautySalonScript';
            src: url('{{ public_path("assets/font/BeautySalonScriptRegular.ttf") }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        @font-face{
            font-family: 'Poppins';
            src: url('{{ public_path("assets/font/Poppins-Regular.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            background-image: url('{{ public_path("assets/certificate/certificate_template.png") }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            width: 100%; 
            height: 100%;
            position: relative;
            margin: 0;
            
        }

        .container{
            width: 100%;
            height: 100%;
            position: relative;
        }

        .name{
            position: absolute;
            top: 410px; 
            left: 50%;
            transform: translateX(-50%);
            font-family: 'BeautySalonScript', cursive;
            font-size: 100px;
            color: #1b1b1b;
            justify-content: center;
            align-items: center;
            white-space: nowrap;
        }

        .certificate-footer{
            width: 80%;
            position: absolute;
            top: 560px; 
            left: 10%;
            flex-direction: column;
        }

        .course-name{
            margin: 0;
            font-size: 24px; 
            color: #1b1b1b;
            margin-bottom: 30px;
            margin-right: 80px;
            margin-left: 80px;
            font-family: 'Poppins', sans-serif;
        }

        .date{
            margin: 0;
            font-size: 24px; 
            color: #1b1b1b;
            margin-bottom: 40px;
            font-family: 'Poppins', sans-serif;
        }

        .course-id{
            margin: 0;
            font-size: 18px;
            color: #bc9e71;
            font-family: 'Poppins', sans-serif;
        }


       
    </style>
</head>
<body>
    <div class="container">
        <div class="name">{{$studentName}}</div>
    
        <div class="certificate-footer">
            
            <p class="course-name">For successfully completing <strong>{{ $courseName }}</strong></p>
            
            <div class="date">Jakarta, {{ $issuedDate }}</div>
    
            <p class="course-id">{{ $certificateId }}</p>
    
        </div>

    </div>
    
</body>
</html>
