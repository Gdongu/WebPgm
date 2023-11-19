<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP 5</title>
</head>
<body>
    <?php
        function revsort($arr) {
            sort($arr);
            $arr = array_reverse($arr);
            return $arr;
        }

        $a = revsort(array(3, 2, 5, 4, 1));

        for($i = 0; $i < count($a); $i++) {
			echo $a[$i]." ";
		}
    ?>
</body>
</html>