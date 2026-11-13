<?php 
    /**
     * @var array $total
     */
?>

<div class="container">

    <div class="row">

        <?php 
            $icon = [
                'books' => 'fa-solid fa-book',
                'boughtBooks' => 'fa-solid fa-book',
                'cartsItems' => 'fa-solid fa-cart-shopping',
                'authors' => 'fa-solid fa-user-group',
                'customers' => 'fa-solid fa-users-line',
                'admins' => 'fa-solid fa-user-tie',
                'ordered' => 'fa-solid fa-circle-pause',
                'cancelled' => 'fa-solid fa-ban',
                'done' => 'fa-solid fa-circle-check',
            ];
            foreach($total as $key => $value) {
                if($key == 'orders'){
                    $order = $total[$key];
                    foreach($order as $key1 => $value1){
                        $number = $order[$key1];
                        $i = $icon[$key1];
                        $word = ucfirst($key1);
                        echo "
                            <div class='col-xl-3 col-md-4 col-sm-6'>
                            
                                <div class='card my-1 rounded-4 bg-primary-subtle text-primary-emphasis' style='border: none;'>
                                
                                    <div class='card-body p-2'>
                                        <div class='w-100 text-center my-2'><i class='{$i}'></i></div>
                                        <div class='w-100 text-center my-2'>Total $word</div>
                                        <div class='w-100 text-center my-2 text-success fw-bolder'>$number</div>

                                    </div>
                            
                                </div>
                            
                            </div><!--total $word-->
                        ";
                    }
                }
                else{
                    $number = $total[$key];
                    $i = $icon[$key];
                    $word = ucfirst($key);
                    echo "
                        <div class='col-xl-3 col-md-4 col-sm-6'>
                        
                            <div class='card my-1 rounded-4 bg-primary-subtle text-primary-emphasis' style='border: none;'>
                            
                                <div class='card-body p-2'>
                                    <div class='w-100 text-center my-2'><i class='{$i}'></i></div>
                                    <div class='w-100 text-center my-2'>Total $word</div>
                                    <div class='w-100 text-center my-2 text-success fw-bolder'>$number</div>

                                </div>
                            
                            </div>
                        
                        </div><!--total $word-->
                    ";
                }
            }
        ?>

    </div><!--row-->

</div><!--container-->



