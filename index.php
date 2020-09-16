<?php

//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions


// SESSION
session_start();

$addEmail = $_SESSION['email'] = $_POST['email'];
$addStreet = $_SESSION['street'] = $_POST['street'];
$addStreetNumber = $_SESSION['streetnumber'] = $_POST['streetnumber'];
$addCity = $_SESSION['city'] = $_POST['city'];
$addZipcode = $_SESSION['zipcode'] = $_POST['zipcode'];

echo "<b>Email: </b>" . $addEmail . "<br />";
echo "<b>Street: </b>" . $addStreet . " ";
echo $addStreetNumber . "<br />";
echo "<b>city: </b>" . $addCity . "<br />";
echo "<b>Zipcode: </b>" . $addZipcode . "<br />";



// DATA FROM FORM + CHECK

$emailErr = $streetErr = $streetNumberErr = $cityErr = $zipcodeErr = $productsErr = "";
$email =  $street = $streetNumber = $city = $zipcode = $products = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {

        $email = test_input($_POST["email"]);


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // street
    if (empty($_POST["street"])) {
        $streetErr = "street is required";
    } else {

        $street = test_input($_POST["street"]);

        if (!preg_match("/^[a-zA-Z-' ]*$/", $street)) {
            $streetErr = "Only letters and whitespace allowed";
        }
    }

    // streetnumber
    if (empty($_POST["streetnumber"])) {
        $streetNumberErr = "streetnumber is required";
    } else {

        $streetNumber = test_input($_POST["streetnumber"]);

        if (!preg_match("/^[1-9][0-9]*$/", $streetNumber)) {
            $streetNumberErr = "Only numbers allowed";
        }
    }

    // city
    if (empty($_POST["city"])) {
        $cityErr = "city is required";
    } else {

        $city = test_input($_POST["city"]);

        if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
            $cityErr = "Only letters allowed";
        }
    }

    // zipcode
    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "zipcode is required";
    } else {

        $zipcode = test_input($_POST["zipcode"]);

        if (!preg_match("/^[1-9][0-9]*$/", $zipcode)) {
            $zipcodeErr = "Only numbers allowed";
        }
    }
}

// TEST IF INPUT IS CORRECT
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



// Switch between drinks and food
// your products with their price
if ($_GET['food'] == 1) {
    $products = [
        ['name' => 'Salty chocolate soup', 'price' => 5],
        ['name' => 'Miso soup', 'price' => 4],
        ['name' => 'Mezze', 'price' => 6],
        ['name' => 'Lebanese fries (olive oil and tahin)', 'price' => 4],
        ['name' => 'Guacamole Burrito', 'price' => 3],
        ['name' => 'Dr Oetker spinach pizza', 'price' => 5],
        ['name' => 'Piece of Cookie coconut pie', 'price' => 4],
        ['name' => 'Whole Pancake pie', 'price' => 15],
        ['name' => 'Single ball of vanilla ice cream', 'price' => 1],
        ['name' => 'Box with 8 homemade pralines', 'price' => 4],
        ['name' => 'Political-philosophical pamphlet of the week', 'price' => 0]
    ];
} else {
    $products = [
        ['name' => 'Tap water', 'price' => 0],
        ['name' => 'A teaspoon of ridiculously hot sauce', 'price' => 1],
        ['name' => 'Hot spicy cinnamon coco', 'price' => 3],
        ['name' => 'Gazpacho', 'price' => 2],
        ['name' => 'Ayran', 'price' => 1],
        ['name' => 'White Russian', 'price' => 5],
        ['name' => 'Tequila shot', 'price' => 1],
        ['name' => 'Hungarian red wine', 'price' => 3],
        ['name' => 'Cara Pils', 'price' => 1],
        ['name' => 'Geuze Boon', 'price' => 3],
        ['name' => 'Tripel Karmeliet', 'price' => 4]
    ];
}


// TOTAL VALUE

$totalValue = 0;
foreach ($_POST['products'] as $i => $product) {
    $totalValue += ($products[$i]['price']);
}


// TOTAL FORM VALIDATION
if (!empty($_POST["email"]) && !empty($_POST["street"]) && !empty($_POST["streetnumber"]) && !empty($_POST["city"]) && !empty($_POST["zipcode"])) {
    $result = '<div class="alert alert-success" role="alert">Your order is submitted, thank you</div>';
} else {
    $result = '<div class="alert alert-danger" role="alert">Please fill in all required fields</div>';
}

//ASSIGNS TOTAL PRICE TO COOKIE

if (isset($_POST['totalValue']))
    setcookie('totalValue', $totalValue, time() + 60 * 60 * 7);


//MAIL STUFF
if (isset($_POST['submit'])) {
    $mailto = "driesdedecker+foodthatcould@gmail.com";
    $subject = "Order #xx from The Food that Could";
    $message = "This is a testmail";
    $header = "From: Food that Could";
    mail($mailto, $subject, $message, $header);
    if (mail($mailto, $subject, $message, $header)) {
        echo "mail sent";
    } else {
        echo "<div class=\"alert alert-warning\" role=\"alert\"> An error has occured, mail not sent! </div>";
    }
}


// CHECK WHATS HAPPENING
function whatshappening()
{
    echo '<h3>$_POST</h3>';
    var_dump($_POST['products']);
    echo '<h3>$_COOKIE</h3>';
    var_dump($_COOKIE);
    echo '<h3>$_SESSION</h3>';
    var_dump($_SESSION);
}
// whatshappening();

// Link to form page
require 'form-view.php';



// if (isset($_POST['submit'])) {
//     echo 123;
// }


// foreach ($_POST as $key => $value) {
//     $_SESSION['POST'][$key] = $value;
// }

// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

// var_dump($_POST["name"]);