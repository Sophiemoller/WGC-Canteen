<?php
$con = mysqli_connect("localhost", "mollerso", "goodhen60", "mollerso_canteen");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

if(isset($_GET['food'])){
    $id = $_GET['food'];
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
    <h1> WGC CANTEEN</h1>
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

    <h2> Search food options </h2>

    <form action =" " method="post">
        <input type="text" name='search'>
        <input type="submit" name="submit" value="search">
    </form>
    <?php
    if(isset($_POST['search'])) {
        $search = $_POST['search'];

        $query1 = "SELECT * FROM food WHERE Fitem LIKE '%$search%'";
        $query = mysqli_query($con,$query1);
        $count = mysqli_num_rows($query);

        if($count ==0){
            echo "<p>"."There was no search results";
        }else{

            while ($row = mysqli_fetch_array($query)) {
                echo "<p>".$row ['Fitem'];

            }
        }
    }
    ?>

    <h2> Food Information </h2>
    <?php

    echo "<p> Item: " . $this_food_record['Fitem'] . "<br>";
    echo "<p> Cost: " . $this_food_record['Fcost'] . "<br>";
    echo "<p> In/out of stock: " . $this_food_record['Fstock'] . "<br>";

    ?>

    <h2> Select Another Food Item </h2>
    <!--Customer form-->
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
    <h2> View all options</h2>

    <form action="food.php" method="post">
        <input type='submit' name='testquery1' value="Food">
    </form>

    <?php
    if(isset($_POST['testquery1'])) {
        $result = mysqli_query($con, "SELECT * FROM food");
        if (mysqli_num_rows($result) != 0) {
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th class='foodColumn'>Item</th>";
            echo "<th class='costColumn'>cost </th>";
            echo "<th class ='stockColumn'>stock</th>";
            echo "</tr>";
            echo "</thead>";
            while ($test = mysqli_fetch_array($result)) {
                $id = $test['FoodID'];

                echo "<tr>";
                echo "<td>" . $test['Fitem'] . "</td>";
                echo "<td>" . $test['Fcost'] . "</td>";
                echo "<td>" . $test['Fstock'] . "</td>";
                echo "</tr>";


            }
            echo "</table>";
        }
    }
    ?>

    <div class="footer">
        <p>Footer</p>
    </div>
</main>
</body>