<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP 7</title>
</head>
<body>
    <?php
       $array = array(
            "Kim" => "Seoul", 
            "Lee" => "Pusan, Daegu", 
            "Choi" => "Inchon", 
            "Park" => "Suwon, Daejon", 
            "Jung" => "Kwangju, Chunchon, Wonju"
        );

        unset($array["Choi"]);

       foreach ($array as $key => $value) {
            echo $key." &nbsp".$value."<br>";
        }

    ?>
</body>
</html>