<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP 6</title>
</head>
<body>
    <?php
        $file = 'exam.txt';

         $exam = file_get_contents($file);

         $lineCount = substr_count($exam, "\n") + 1;

         $wordCount = str_word_count($exam);
          
         $charCount = mb_strlen($exam);

         echo "exam.txt의<br>";
         echo "줄 수 : $lineCount<br>";
         echo "단어 수 : $wordCount<br>";
         echo "글자 수 : $charCount";
    ?>
</body>
</html>