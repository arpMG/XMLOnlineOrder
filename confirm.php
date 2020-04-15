<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Ordering</title>

    <link rel="stylesheet" href="style.css">

    <?php
        include "classes/Menu.php";
        $menu = new Menu("data/menu.xml");

        $order = []; //Array title|unit cost|qty|amount
        $subtotal = 0;
        $gst = 0;
        $total = 0;

        if(isset($_GET['submit'])){

            for($i=0; $i<count($_GET['qty']); $i++){

                if($_GET['qty'][$i] > 0){
                    $order_item = [
                        "title"     => $menu->getData()[$i]['title'],
                        "unit_cost" => $menu->getData()[$i]['cost'],
                        "qty"       => $_GET['qty'][$i],
                        "amount"    => ($menu->getData()[$i]['cost'] * $_GET['qty'][$i])
                    ];
    
                    $order[] = $order_item;
                    $subtotal += $order_item['amount'];
                }

            }

            $gst = $subtotal * 0.10;
            $total = $subtotal + $gst;

        }else{
            header("Location: order.php");
        }

    ?>
</head>
<body>
    <h1>Online Order</h1>
    <h2>Order Confirmation</h2>

    <pre>
        <?php 
            // print_r($_GET); 
            // print_r($_GET['qty']);
            // print_r($menu);
            // print_r($order);
            // echo $subtotal."<br>";
            // echo $gst."<br>";
            // echo $total."<br>";
        ?>
    </pre>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Unit Cost</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th scope="row" colspan="3">Sub Total</th>
                <td class="number"><span class="currency">$</span><?php echo number_format($subtotal, 2); ?></td>
            </tr>
            <tr>
                <th scope="row" colspan="3">GST</th>
                <td class="number"><span class="currency">$</span><?php echo number_format($gst, 2); ?></td>
            </tr>            
            <tr>
                <th scope="row" colspan="3">Total (incl. GST)</th>
                <td class="number"><span class="currency">$</span><?php echo number_format($total, 2); ?></td>
            </tr> 
        </tfoot>
        <tbody>
            <?php
                foreach($order as $order_item){
            ?>
            <tr>
                <td><?php echo $order_item['title']; ?></td>
                <td class="number"><?php echo $order_item['qty']; ?></td>
                <td class="number"><span class="currency">$</span><?php echo number_format($order_item['unit_cost'], 2); ?></td>
                <td class="number"><span class="currency">$</span><?php echo number_format($order_item['amount'], 2); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>