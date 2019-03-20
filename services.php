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
    //   error(3);
    $text = readFromFile("needItText.txt");
    $title = getUrl($_POST);
    $data = sortPost($_POST);
    $fileTmpName = "";
} else if (isset($_POST["search"])) {
    if ($_POST["search"] != "!!!") {
        $data = search($_POST["search"]);
    }else{
    $data ="";
    $title = "Search Engine";}
} else if (isset($_POST["getDatabase"])) {
    $title = "All Data";
    $data = getInformation();
} else if (isset($_GET["saveData"])) {
    $title = "Saved ";
    $data = "Data has been saved success";
    writeIntoFile($_GET["pathName"],$_GET["data"]);
} else if (isset($_POST["upload"])) {
    $title = "Data From File";
    $data = getDataFromUploadedFile($_POST);
    $fileTmpName =getFilePath($_POST);
} else {
    $title = "Add Your Company";
    $data = "<h1>NO DATA!!!</h1>";

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
            <li><h4>C. Name</h4></li>
        </ul>
    </div>

    <div class="inputFields">

        <form action="services.php?name=<?php echo $title ?>" method="post">
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
                    <form action="services.php?name=<?php echo $title ?>" method="post">
                        <input type="submit" name="getDatabase" value="GetDataBase">
                    </form>
                </li>
                <li>
                    <form action="services.php?name=<?php echo $title ?>" method="post">
                        <ul class="secondUl ">
                            <li>
                                <input class="search_input" type="text" name="search" onfocus="this.value =''"
                                       value="!!!">
                            </li>
                            <li>
                                <input type="submit" name="Submit_Search" value="Search">
                            </li>
                        </ul>
                    </form>
                </li>
                <li>
                    <form action="services.php?name=<?php echo $title ?>" method="post" enctype="multipart/form-data">
                        Upload a File:<br/>
                        <input type="file" name="myfile" id="fileToUpload">
                        <input type="submit" name="upload" value="Upload File Now">
                    </form>
                </li>
            </ul>
        </form>
    </div>

    <div class="textAreaBlock">
        <div id="product_list" class="textArea" contenteditable="true"><br>
            <?php echo $data;
            ?>
        </div>
        <div><br/>
            <form action="EditData.php?name=<?php echo $title ?>" method="get">
                <input type="hidden" name="varName" value='<?php echo $data ?>'>
                <input type="hidden" name="pathName" value='<?php echo $fileTmpName ?>'>
                <input type="submit" name="saveData" value="save"/>
            </form>
        </div>
    </div>

</div>


</body>
</html>
