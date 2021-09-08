<?php
$con = mysqli_connect("localhost", "mollerso", "goodhen60", "mollerso_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

if(isset($_GET['special'])){
    $id = $_GET['special'];
}else {
    $id = 1;
}
/* Specials Query */

$this_specials_query = "SELECT specials.Weekday, specials.FoodID, food.Fitem , food.FoodID, specials.DrinkID, drinks.Ditem , drinks.DrinkID, specials.Special
FROM specials, food, drinks
WHERE specials.FoodID = drinks.DrinkID
AND specials.DrinkID = food.FoodID
AND specials.Weekday = '" .$id."'";
$this_specials_result = mysqli_query($con, $this_specials_query);
$this_specials_record = mysqli_fetch_assoc($this_specials_result);

/* Order Query */
/*SELECT OrderID, DrinkName FROM drinks */
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
    <h2> Specials Information</h2>

    <?php

    echo "<p> Weekday: " . $this_specials_record['Weekday'] . "<br>";
    echo "<p> Food Item: " . $this_specials_record['Fitem'] . "<br>";
    echo "<p> Drink Item: " . $this_specials_record['Ditem'] . "<br>";
    echo "<p> Special: " . $this_specials_record['Special'] . "<br>";

    ?>

    <h2> Select Another Special</h2>

    <!--Specials form-->
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
</html>
