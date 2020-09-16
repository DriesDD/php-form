<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>Order food & drinks</title>
</head>

<body class="bg-dark text-light">

    <div class="container mt-4">
        <?php echo $result; ?>

        <h1>Order food at "The Food that Could"</h1>
        <nav>
            <ul class="nav nav-pills mt-4" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link<?php if ($_GET['food'] == 1) echo ' active'; ?>" id="pills-home-tab" data-toggle="pill" href="?food=1">Order food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if ($_GET['food'] == 0) echo ' active'; ?>" id="pills-home-tab" data-toggle="pill" href="?food=0">Order drinks</a>
                </li>
            </ul>
        </nav>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <!-- EMAIL -->
            <div class="form-row mt-4">
                <div class="form-group col-md-6">
                    <label for="email">E-mail:</label>
                    <input type="text" id="email" name="email" class="form-control" value="<?php echo $email; ?>">
                    <span class="error text-danger">* <?php echo $emailErr; ?></span>
                </div>
                <div></div>
            </div>




            <fieldset>
                <legend>Address</legend>

                <div class="form-row">

                    <!-- STREET -->
                    <div class="form-group col-md-6">
                        <label for="street">Street:</label>
                        <input type="text" name="street" id="street" class="form-control" value="<?php echo $street; ?>">
                        <span class=" error text-danger">* <?php echo $streetErr; ?></span>
                    </div>

                    <!-- STREETNUMBER -->
                    <div class="form-group col-md-6">
                        <label for="streetnumber">Street number:</label>
                        <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?php echo $streetNumber; ?>">
                        <span class=" error text-danger">* <?php echo $streetNumberErr; ?></span>
                    </div>
                </div>

                <div class="form-row">
                    <!-- CITY -->
                    <div class="form-group col-md-6">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" class="form-control" value="<?php echo $city; ?>">
                        <span class=" error text-danger">* <?php echo $cityErr; ?></span>

                    </div>
                    <!-- ZIPCODE -->
                    <div class="form-group col-md-6">
                        <label for="zipcode">Zipcode</label>
                        <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php echo $zipcode; ?>">
                        <span class=" error text-danger">* <?php echo $zipcodeErr; ?></span>

                    </div>
                </div>
            </fieldset>

            <fieldset>
                <!-- PRODUCTS -->
                <legend>Products</legend>
                <span class=" error text-danger">* <?php echo $productsErr; ?></span><br />

                <?php foreach ($products as $i => $product) : ?>

                    <label>
                        <input type="checkbox" value="value1" name="products[<?php echo $i ?>]" /> <?php echo $product['name'] ?> -
                        &euro; <?php echo number_format($product['price'], 2) ?></label><br />
                <?php endforeach; ?>
            </fieldset>



            <button type="submit" name="submit" value="submit" class="btn btn-info mt-4">Order!</button>
        </form>

        <footer class="alert alert-primary mt-4 h3" role="alert">You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
    </div>

    <style>
        footer {
            text-align: center;
        }
    </style>
</body>

</html>