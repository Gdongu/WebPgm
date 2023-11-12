<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP 1</title>
</head>
<body>
<?php
    function num($a) {
        if (($a % 2) == 1) {
            return ++$a;
        } 
        if (($a % 2) == 0) {
            return $a;
        } 
    }
    echo num(1);
    echo "<br>";
    echo num(2);
    echo "<br>";
    echo num(3);
    echo "<br>";
    echo num(4);
?>
</body>
</html>