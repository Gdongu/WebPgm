<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>request</title>
</head>
<body>
    <?php
        $name = $_POST["name"];
        $email = $_POST["email"];

        echo $name."님의 이메일 주소는 ".$email."입니다.";
    ?>
</body>
</html>