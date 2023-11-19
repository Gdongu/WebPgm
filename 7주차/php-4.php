<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP 4</title>
</head>
<body>
    <?php
        $a = array("A", "B", "C", "D", "E");
        for($i = 0; $i < count($a); $i++) {
			for($j = 0; $j <= $i; $j++) {
				echo $a[$j]." ";
			}
			echo "<br>";
        }
		for($i = count($a)-1; $i > 0; $i--) {
			for($j = 0; $j < $i; $j++) {
				echo $a[$j]." ";
			}
			echo "<br>";
        }
    ?>
</body>
</html>