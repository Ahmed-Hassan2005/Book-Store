<?php 
    /**
     * @var array $customers
     */
?>

<div class="container">

    <?php preparePagination($customers, 'customers'); ?>



    <div class="row">
        <?php
        if(!empty($customers['data'])){
            $imgUrl = asset('imgs/customer.png');

            foreach ($customers['data'] as $customer) {
                $badge = ($customer['is_banned'])
                ? "<span class='badge text-bg-danger position-absolute top-0 end-0 mt-2 me-2'>Banned</span>"
                : '';

                $buttonBan = ($customer['is_banned'])
                ? "<a class='btn btn-danger d-block mx-auto'>Unban</a>"
                : '<a class="btn btn-danger d-block mx-auto">Ban</a>';
                echo "

                    <div class='col-xl-4 col-lg-6'>

                        <div class='card my-1 rounded-4 bg-primary-subtle text-primary-emphasis'>
                            {$badge}
                            <img src='$imgUrl' class='card-img-top mx-auto mt-3' style='width: 100px;'>
                            <div class='card-body'>
                                <h5 class='card-title text-center'>{$customer['name']}</h5>
                                <p class='card-text' style='overflow-x: auto;'>Email: <span class='ms-2'>{$customer['email']}</span></p>
                                <p class='card-text' style='overflow-x: auto;'>Gender: <span class='ms-2'>{$customer['gender']}</span></p>
                                <p class='card-text' style='overflow-x: auto;'>Phone: <span class='ms-2'>{$customer['phone']}</span></p>
                                {$buttonBan}

                            </div>

                        </div>

                    </div><!--total admins-->

                ";
            }
        }
        else{
            echo"<div class='alert alert-warning w-75 mx-auto text-center' role='alert'>No Admins Found!</div>";
        }
        ?>



    </div><!--row-->

</div><!--container-->