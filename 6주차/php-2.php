<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>PHP 2</title>
</head>
<body>
<?php
    function fac($n) {
        $a = 1;
        $i = 1;
        if ($n == 0) return 1;
        while ($i < $n+1) {
            $a = $a * $i;
            $i++;
        }
        return $a;
    }
    echo fac(5);
?>
</body>
</html>