<?php
$con = mysqli_connect("localhost", "mollerso", "goodhen60", "mollerso_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";}

if(isset($_GET['food'])){
    $id = $_GET['food'];
}else {
    $id = 1;
}

if(isset($_GET['drink'])){
    $id = $_GET['drink'];
}else {
    $id = 1;
}

if(isset($_GET['special'])){
    $id = $_GET['special'];
}else {
    $id = 1;
}

/* Food Query */
/*SELECT FoodID, Fitem FROM food */

$this_food_query = "SELECT Fitem, Fcost, Fstock FROM food WHERE food.FoodID = '" .$id."'";
$this_food_result = mysqli_query($con, $this_food_query);
$this_food_record = mysqli_fetch_assoc($this_food_result);

$all_food_query = "SELECT FoodID, Fitem FROM food";
$all_food_result = mysqli_query($con, $all_food_query);

/* Drinks Query */
/*SELECT DrinkID, DrinkName FROM drinks */

$this_drink_query = "SELECT Ditem, Dcost, Dstock FROM drinks WHERE drinks.DrinkID = '" .$id."'";
$this_drink_result = mysqli_query($con, $this_drink_query);
$this_drink_record = mysqli_fetch_assoc($this_drink_result);

$all_drink_query = "SELECT DrinkID, Ditem FROM drinks";
$all_drink_result = mysqli_query($con, $all_drink_query);

/* Specials Query */

$this_specials_query = "SELECT specials.Weekday, specials.FoodID, food.Fitem , food.FoodID, specials.DrinkID, drinks.Ditem , drinks.DrinkID, specials.Special
FROM specials, food, drinks
WHERE specials.FoodID = drinks.DrinkID
AND specials.DrinkID = food.FoodID
AND specials.Weekday = '" .$id."'";
$this_specials_result = mysqli_query($con, $this_specials_query);
$this_specials_record = mysqli_fetch_assoc($this_specials_result);

$all_specials_query = "SELECT Weekday FROM specials ";
$all_specials_result = mysqli_query($con, $all_specials_query);

?>

<!DOCTYPE html>

<html lang="eng">

<head>
    <title> WGC CANTEEN </title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>

<body>
<header>
    <h1> WGC CANTEEN </h1>
    <nav>
        <ul>
            <li> <a href="home.php">HOME</a></li>
            <li> <a href="drink.php">DRINKS</a></li>
            <li> <a href="food.php">FOOD</a></li>
            <li> <a href="specials.php">SPECIALS</a></li>
        </ul>
    </nav>
</header>
<main>
    <h2>Food Information</h2>
    <form name='food form' id=food form' method='get' action='food.php'>
    <select id='food' name='food'>
        <!--options-->
        <?php
        while($all_food_record = mysqli_fetch_assoc($all_food_result)){
            echo "<option value = '". $all_food_record['FoodID'] . "'>";
            echo $all_food_record['Fitem'];
            echo "</option>";
        }

        ?>
    </select>
    <input type="submit" name="foods_button" value="Show me the food information">
    </form>
    <!--drink form-->
    <h2>Drink Information</h2>
    <form name='drink form' id=drink form' method='get' action='drink.php'>
    <select id='drink' name='drink'>
        <!--options-->
        <?php
        while($all_drink_record = mysqli_fetch_assoc($all_drink_result)){
            echo "<option value = '". $all_drink_record['DrinkID'] . "'>";
            echo $all_drink_record['Ditem'];
            echo "</option>";
        }

        ?>
    </select>
    <input type="submit" name="drinks_button" value="Show me the drink information">
    </form>
    <!--specials form-->
    <h2>Specials Information</h2>
    <form name="specials form" id="specials form" method="get" action="specials.php">
        <select id="special" name="special">
            <!--options-->

            <?php
            while($all_specials_record = mysqli_fetch_assoc($all_specials_result)){
                echo "<option value = '".$all_specials_record['Weekday'] ."'>";
                echo $all_specials_record['Weekday'];
                echo "</option>";
            }
            ?>
        </select>
        <input type="submit" name="specials_button" value="Show me the specials information">
    </form>
    <div class="footer">
        <p>Footer</p>
    </div>
</main>
</body>

