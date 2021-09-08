<?php
$con = mysqli_connect("localhost", "mollerso", "goodhen60", "mollerso_canteen");
if(mysqli_connect_errno()){
echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
echo "connected to database";
}

if(isset($_GET['drink'])){
    $id = $_GET['drink'];
}else {
    $id = 1;
}

/* Drinks Query */
/*SELECT DrinkID, DrinkName FROM drinks */

$this_drink_query = "SELECT Ditem, Dcost, Dstock FROM drinks WHERE drinks.DrinkID = '" .$id."'";
$this_drink_result = mysqli_query($con, $this_drink_query);
$this_drink_record = mysqli_fetch_assoc($this_drink_result);

$all_drink_query = "SELECT DrinkID, Ditem FROM drinks";
$all_drink_result = mysqli_query($con, $all_drink_query);

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
    <h2> Search drink options </h2>

    <form action =" " method="post">
        <input type="text" name='search'>
        <input type="submit" name="submit" value="search">
    </form>
    <?php
    if(isset($_POST['search'])) {
        $search = $_POST['search'];

        $query1 = "SELECT * FROM drinks WHERE Ditem LIKE '%$search%'";
        $query = mysqli_query($con,$query1);
        $count = mysqli_num_rows($query);

        if($count ==0){
            echo "<p>"."There was no search results";
        }else{

            while ($row = mysqli_fetch_array($query)) {
                echo "<p>".$row ['Ditem'];

            }
        }
    }
    ?>

    <h2> Drink Information </h2>

    <?php

    echo "<p> Item: " . $this_drink_record['Ditem'] . "<br>";
    echo "<p> Cost: " . $this_drink_record['Dcost'] . "<br>";
    echo "<p> In/out of stock: " . $this_drink_record['Dstock'] . "<br>";

    ?>

    <h2> Select Another Drink </h2>
    <!--drink form-->
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
    <div class="footer">
        <p>Footer</p>
    </div>
</main>
</body>