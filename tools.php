<?php
/**
 * Created by PhpStorm.
 * User: ziadelsarrih
 * Date: 2019-02-24
 * Time: 11:43
 * @param $arr
 * @return string
 */


/**
 * this function to make initialization for the file and get data so we don't need each time
 * to go into file we get ones the data then we check when we finish our work we will save the data
 * into file
 * @return string
 */
function init()
{
    $fileName = "needItText.txt";

    if (!file_exists($fileName)) {
        $file_name = $fileName;
        fopen($file_name, 'w');
    }
    return $fileName;
}

/**
 * @param $arr
 * @return string
 * this function is the main one
 * it check the input of field and also check if it's empty
 * also the type of entry
 */
function sortPost($arr)
{
    $fileName = init();
    $data = " " . readFromFile($fileName);

    if (checkInput($arr)) {

        if (checkNumeric($arr['name'])) {
            error(1);
            return "Name can't contain any number ";
        } else if (!checkNumeric($arr['phone'])) {
            error(1);
            return "Phone Number should contain only numbers ";
        } else {
            $toSendArr = makItUpper($arr);
            handleSpaces($toSendArr);
            if (!stringContains($toSendArr['name'], $data)) {
                $dataToGo = getValueByString($toSendArr);
                $data = $data . $dataToGo;
                file_put_contents($fileName, $data . "\n");
                return handlePrintMessage($toSendArr);
            } else {
                return '<h1>Company already Exist in databases</h1>';
            }
        }

    } else {
        error(1);
        return "You have to fill all field !! ";
    }

}

/**
 * @param $arr
 * @return bool
 * this function to check
 * if the content are empty
 */
function checkInput($arr)
{
    $emptyArr = true;
    foreach ($arr as $value => $arrayValue) {
        if (empty($arrayValue)) {
            $emptyArr = false;
        }
    }

    return $emptyArr;

}

/**
 * @param $arr
 * it work by reference
 * check if there any space into string will put the string into " string "
 */

function handleSpaces(&$arr)
{
    if (is_array($arr)) {
        foreach ($arr as $value => $arrayValue) {
            if (strpos($arrayValue, ' ')) {
                $arr[$value] = '"' . $arrayValue . '"';
            }
        }
    } else {
        if (strpos($arr, ' ')) {
            $arr = '"' . $arr . '"';
        }
    }


}

/**
 * @param $arr
 * @return string
 * this function split the original array by ',' and it's return
 * the value like string it work by reference
 */

function getValueByString($arr)
{
    $stringValue = "";
    foreach ($arr as $value) {
        $stringValue = $stringValue . $value . ",";
    }
    return $stringValue;

}


/**
 * @param $arr string
 * @return bool
 * this function to check if field contain only number
 *
 */
function checkNumeric($arr)
{
    $numeric = false;
    if (is_numeric($arr)) {
        $numeric = true;
    }
    return $numeric;
}

/**
 * to post a error to the user
 * @param $value
 */
function error($value)
{
    if ($value == 1) {
        echo '<script language="javascript">';
        echo 'alert("Check Your Input ")';
        echo '</script>';
    } else if ($value == 2) {
        echo '<script language="javascript">';
        echo 'alert("no file available!! ")';
        echo '</script>';
    } else if ($value == 3) {
        echo '<script language="javascript">';
        echo 'alert("test")';
        echo '</script>';
    }
}

/**
 * @param $arr
 * @return array
 * this function make all first char upper
 */
function makItUpper($arr)
{
    $temp = $arr;
    array_walk($temp, function (&$value) {
        $value = ucfirst($value);
    });

    return $temp;
}

/**
 * @param string name of file
 * @return string
 * this function read from file
 */
function readFromFile($name)
{
    if ($name != null) {
        return file_get_contents($name);
    } else {
        return "Browse File Or File Not Exist";
    }
}

/**
 * @param $name string name of file
 * @param $data // data to write
 * @return null;
 * this function read from file
 */
function writeIntoFile($name, $data)
{
    if ($name != null) {
        file_put_contents($name, $data);
    } else {
        return "Browse File Or File Not Exist";
    }
}

/**
 * @param array
 * @return array
 * this wil delete the duplication
 */
function deleteRepeat($arr)
{
    $toSendArr = explode(",", $arr["Value"]);
    $toSendArr = makItUpper($toSendArr);

    return array_unique($toSendArr);
}

/**
 * @param $arr
 * @return string
 * this function to any value in the url like id or name ...
 */
function getUrl($arr)
{
    if (isset($arr['name'])) {
        return $arr['name'] . " Company is Set it ";
    } else {
        return "Add Your Company";
    }
}

/**
 * @param $arr
 * @return string
 * this function is to handle the message to add the
 * header of each field like name and address ...
 */
function handlePrintMessage($arr)
{
    $stringToGo = '<h1>Name Of The Company :</h1>';
    $index = 1;
    foreach ($arr as $value) {
        if (($value != "Submit") && ($value != "!!!")) {
            $stringToGo = $stringToGo . $value . printConst($index);
            $index++;
        }
    }
    return $stringToGo;
}

/**
 * @param $index
 * @return string|null
 * this function is to add into string the constant value like name and email ...
 */
function printConst($index)
{
    if ($index == 1) {
        return "<h2>Address :</h2>";
    } else if ($index == 2) {
        return "<h2>Phone :</h2>";
    } else if ($index == 3) {
        return "<h2>Email :</h2>";
    }
    return null;
}

;

/**
 * @param $value // name of the company
 * @param $data //is the main data
 * @return bool
 *this function is to check duplication of companies
 */

function stringContains($value, $data)
{

    if (strpos($data, $value . ",")) {
        return true;
    } else {
        return false;
    }
}

/**
 * @param $temp_or
 * @return string // information of company
 */
function search($temp_or)
{
    $filename = init();
    $data = readFromFile($filename);
    $data = array_map('trim', array_filter(explode(',', $data)));//get all value of string into array and delete all spaces
    $temp = ucfirst($temp_or);
    handleSpaces($temp);
    $arr = array();
    $count = 1;
    if (in_array($temp, $data)) {
        for ($i = 0; $i < sizeof($data); $i++) {
            if (($data[$i] == $temp) && (strlen($data[$i]) == strlen($temp))) {
                $count++;
            }
            if (($count > 1) && ($count <= 5)) {
                array_push($arr, $data[$i]);
                $count++;
            }
        }
        //  print_r($arr);
        return handlePrintMessage($arr);
    } else {
        return "No Data Found ";
    }

}

/**
 * @return string
 * this function return al name of companies ;
 */
function getInformation()
{
    $filename = init();
    $data = readFromFile($filename);
    $data = array_map('trim', array_filter(explode(',', $data)));
    $arr = "<h2> Name Of All Companies </h2>" . "<br>";
    for ($i = 0; $i < sizeof($data); $i++) {
        if (($i == 0) || (($i % 5) == 0)) {
            $arr = $arr . $data[$i] . "<br>";
        }

    }

    return $arr;
}

/**
 * @param  array
 * @return string
 * // this function get all info about the file and upload the data from it
 */
function getDataFromUploadedFile($arr)
{
    $currentDir = getcwd();
    $uploadDirectory = "/";

    $errors = []; // Store all foreseen and unforseen errors here

    $fileExtensions = ['jpeg', 'jpg', 'png', 'xml', 'txt']; // Get all the file extensions

    $fileName = $_FILES['myfile']['name'];
    $fileSize = $_FILES['myfile']['size'];
    $fileTmpName = $_FILES['myfile']['tmp_name'];
    $arrr = explode('.', $fileName);
    $fExtention = end($arrr);
    $fileExtension = strtolower($fExtention);

    $uploadPath = $currentDir . $uploadDirectory . basename($fileName);


    if (isset($arr['submit'])) {

        if (!in_array($fileExtension, $fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                return "The file " . basename($fileName) . " has been uploaded";
            } else {
                return "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                return $error . "These are the errors" . "\n";
            }
        }
    }
    return readFromFile($uploadPath);
}

/**
 *
 * @return  string
 * this function return file path
 */
function getFilePath()
{
    $currentDir = getcwd();
    $uploadDirectory = "/";
    $fileName = $_FILES['myfile']['name'];
    return $uploadPath = $currentDir . $uploadDirectory . basename($fileName);
}



