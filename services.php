<?php
/**
 * Created by PhpStorm.
 * User: ziadelsarrih
 * Date: 2019-03-07
 * Time: 10:20
 */


require("tools.php");
$fileTmpName = "";
if (!empty($_POST["name"])) {

$title = checkSpelling($_POST);
}else {
    $title = "Add Your Data";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Services</title>
    <link rel="stylesheet" href="services.css">
</head>
<body>
<h1><?php echo $title ?> </h1>

<div class="flexBox">

    <div class="labelFields">
        <ul>
            <li>Name:</li>
            <li>Address:</li>
            <li>Phone:</li>
            <li>Email:</li>
        </ul>
    </div>

    <div class="inputFields">

        <form action="services.php?name=<?php echo $title ?>" method="post">
            <ul>
                <li>
                    <input type="text" name="name" onfocus="this.value =''" value="Ziad Sarrih" >
                </li>
                <li>
                    <input type="text" name="address" onfocus="this.value =''" value="Country Town Street 345">
                </li>
                <li>
                    <input type="text" name="phone" onfocus="this.value =''" value="+375444722956">
                </li>
                <li>
                    <input type="text" name="email" onfocus="this.value =''" value="zio@info.com">
                </li>
                <li>
                    <input type="submit" name="Submit">
                </li>

            </ul>
        </form>
    </div>

</div>


</body>
</html>
