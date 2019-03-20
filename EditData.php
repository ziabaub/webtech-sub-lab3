<?php
/**
 * Created by PhpStorm.
 * User: ziadelsarrih
 * Date: 2019-03-20
 * Time: 22:11
 */

if ((isset($_GET["saveData"]))) {
    $data = $_GET["varName"];
    $title = "Send it to file";
    $filePath =$_GET["pathName"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Data </title>
    <link rel="stylesheet" href="services.css">
</head>
<body>
<h1>Edit text </h1>
<div

<div><br/>
    <form action="services.php?name=<?php echo $title ?>" method="get">
        <label for="product_list"></label>
        <textarea name="data" id="product_list" class="textAreaEdit"><?php echo $data ?></textarea><br>
        <input type="hidden" name="pathName" value='<?php echo $filePath ?>'>
        <input type="submit" name="saveData" value="save"/>
    </form>
</div>
</body>
</html>

