<?php
/**
 * Created by PhpStorm.
 * User: ziadelsarrih
 * Date: 2019-03-07
 * Time: 10:20
 */

require("tools.php");
if( !empty($_POST["name"])) {
 //   error(3);
    $text = readFromFile("needItText.txt");
    $title = getUrl($_POST);
    $data = sortPost($_POST);
}else if ( $_POST["search"] !="!!!" ) {
    $title = "Search Engine";
    $data = search($_POST['search']);

}else{
        $title = "Add Your Company";
        $data="<h1>NO DATA!!!</h1>";
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
                <li><h3>Search E.</h3></li>
                <li>C. Name</li>
            </ul>
    </div>

    <div class="inputFields">

    <form  action="services.php?name=<?php echo $title  ?>" method="post">
        <ul>
            <li>
                <input type="text" name="name">
            </li>
            <li>
                <input type="text" name="address">
            </li>
            <li>
                <input type="text" name="phone">
            </li>
            <li>
                <input type="text" name="email">
            </li>
            <li>
                <input type="submit" name="Submit">
            </li>
            <li>
                <form action="services.php?name=<?php echo $title  ?>" method="post">
                    <ul class="secondUl ">
                        <li>
                        <input class="search_input" type="text" name="search" onfocus="this.value =''" value="!!!" >
                       </li>
                        <li>
                            <input type="submit" name="Submit_Search">
                        </li>
                    </ul>

                </form>
            </li>
        </ul>
    </form>
    </div>

    <div class="textAreaBlock">
            <div class="textArea" contenteditable="true"><br>
                <?php echo $data?>
            </div>
    </div>

</div>


</body>
</html>
