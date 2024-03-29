<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Парсер картинок.</title>
</head>
<body>
<p>Введите URL</p>
<form method="post" action="index.php">
    <input type="text" name="url" placeholder="URL">
    <input type="submit" value="Отправить">
</form>

<?php

    if (!empty($_POST['url'])) {

        $ch = curl_init();//'http://localhost/php-developer-base/Module-18/HTMLProcessor.php');

        $data = ($_POST['url']);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_URL, 'http://localhost/php-developer-base/Module-18/HTMLProcessor.php');

        $curl = curl_exec($ch);
        var_dump(curl_error($ch));
        $curlInfo = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);


        if (!empty($curl) && $curlInfo == 200) {
            $images = json_decode($curl, true);
            $tempo = $images ['img'];
            echo "<div>";
            foreach ($images as $image) {
                echo "<img src=\" $image \">";
            }
            echo "</div>";
        } elseif ($curlInfo == 404) {
            echo "Картинки не найдены";
        }
    }
?>

</body>
</html>