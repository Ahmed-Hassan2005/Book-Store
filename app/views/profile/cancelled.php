<?php 
    /**
     * @var array $orders
     */
?>

<?php preparePagination($orders['cancelled'], 'orders_cancelled'); ?>

<table class="table table-striped">

    <thead>

        <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Total Price</th>
            <th>Dstails</th>
            <th>Created_at</th>

        </tr>

    </thead>

    <tbody>

        <?php
            if(!empty($orders['cancelled']['data'])){

                foreach ($orders['cancelled']['data'] as $order) {
                    echo "
                        <tr>
                            <td>{$order['id']}</td>
                            <td>{$order['customer_name']}</td>
                            <td>{$order['total_price']}</td>
                            <td><a href=''>Show</a></td>
                            <td>{$order['created_at']}</td>

                        </tr>

                    ";
                }
            }
            else{
                echo"<div class='alert alert-warning w-75 mx-auto text-center' role='alert'>No Cancelled Orders Found!</div>";
            }
        ?>

    </tbody>

</table>


