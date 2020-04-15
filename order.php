<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Order</title>

    <link rel="stylesheet" href="style.css">
    <?php
        include "classes/Menu.php";
        $menu = new Menu("data/menu.xml");

    ?>
</head>
<body>
    <pre>
        <?php
            // print_r($menu->getData());
        ?>
    </pre>
    <h1>Online Order</h1>
    <h2>Order Page</h2>

    <form action="confirm.php">
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Cost</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($menu->getData() as $item){
            ?>
            <tr>
                <td><?php echo $item['title']; ?></td>
                <td class="number"><span class="currency">$</span><?php echo number_format($item['cost'], 2); ?></td>
                <td><input type="number" name="qty[]" value=0></td>
            </tr>
            <?php } ?>
                             
        </tbody>
    </table>
    <button type="submit" name="submit">submit</button>
    </form>
    
</body>
</html>