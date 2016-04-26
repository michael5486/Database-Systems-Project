<html>
    <body>

        Item ID: <?php
        $id = $_POST["itemID"];
        echo $id;
        ?>
        <br>

        Quantity: <?php
        $quantity = $_POST["quantity"];
        echo $quantity;
        ?>
        <br>

        Price: <?php
        $price = $_POST["price"];
        echo $price * $quantity;
        ?>
        <br>

    </body>
</html>