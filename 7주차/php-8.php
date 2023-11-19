<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP 8</title>
</head>
<body>
    <?php
        $filePath = 'client.txt';

        $lines = file($filePath);

        echo "나이가 30세 이상인 고객<br>";
        foreach ($lines as $line) {
            $fields = explode("\t", $line);

            if (count($fields) == 4 && intval($fields[1]) >= 30) {
                echo "$fields[0], $fields[1]세, $fields[2], $fields[3]<br>";
            }
        }
    ?>
</body>
</html>
