<?php 
    /**
     * @var array $admins
     */
?>

<div class="container">

    <?php preparePagination($admins, 'admins'); ?>

    <div class="row">
        <?php
        if(!empty($admins['data'])){
            $imgUrl = asset('imgs/admin.png');

            foreach ($admins['data'] as $admin) {
                $badge = ($admin['is_banned'])
                ? "<span class='badge text-bg-danger position-absolute top-0 end-0 mt-2 me-2'>Banned</span>"
                : '';

                $buttonBan = ($admin['is_banned'])
                ? "<a class='btn btn-danger d-block mx-auto'>Unban</a>"
                : '<a class="btn btn-danger d-block mx-auto">Ban</a>';
                echo "

                    <div class='col-xl-4 col-lg-6'>

                        <div class='card my-1 rounded-4 bg-primary-subtle text-primary-emphasis'>
                            $badge
                            <img src='$imgUrl' class='card-img-top mx-auto mt-3' style='width: 100px;'>

                            <div class='card-body'>
                                <h5 class='card-title text-center'>{$admin['name']}</h5>
                                <p class='card-text' style='overflow-x: auto;'>Email: <span class='ms-2'>{$admin['email']}</span></p>
                                <p class='card-text' style='overflow-x: auto;'>Gender: <span class='ms-2'>{$admin['gender']}</span></p>
                                <p class='card-text' style='overflow-x: auto;'>Phone: <span class='ms-2'>{$admin['phone']}</span></p>
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

