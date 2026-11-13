<?php 
    /**
     * @var array $orders
     */
?>

<?php preparePagination($orders['ordered'], 'orders_ordered'); ?>

<table class="table table-striped">

    <thead>

        <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Total Price</th>
            <th>Dstails</th>
            <th>Created_at</th>
            <?php 
            if(isAuth('admin')){
                echo "<th>Options</th>";
            }
            ?>

        </tr>

    </thead>

    <tbody>

        <?php
            if(!empty($orders['ordered']['data'])){

                // pr($orders['ordered']['data']);
                foreach ($orders['ordered']['data'] as $order) {
                    $options = '';
                    if(isAuth('admin')){
                        $options = "
                            <td>
                                <a class='btn btn-danger'>Cancel</a>
                                <a class='btn btn-success'>Done</a>
                            </td>
                        ";
                    }
                    echo "
                        <tr>
                            <td>{$order['id']}</td>
                            <td>{$order['customer_name']}</td>
                            <td>{$order['total_price']}</td>
                            <td><a onclick='getItemsIntoCarts({$order['id']}, `showOrder`)'>Show</a></td>
                            <td>{$order['created_at']}</td>
                            {$options}
                        </tr>

                    ";
                }
            }
            else{
                echo"<div class='alert alert-warning w-75 mx-auto text-center' role='alert'>No Ordered Orders Found!</div>";
            }
        ?>

    </tbody>

</table>

