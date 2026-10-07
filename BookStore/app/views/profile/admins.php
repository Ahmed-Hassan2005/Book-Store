<?php 
    /**
     * @var array $admins
     */
?>

<div class="container">

    <?php
    if(!empty($admins['data'])){

        $prepareLi = '';
        $pagesNumber = ceil($admins['total'] / 10);
        $NextPageNumber = ($pagesNumber > 2) ? '2' : '';
        $isNextPageDisabled = ($pagesNumber > 2) ? '' : 'disabled';

        for ($i = 1; $i <= $pagesNumber; $i++) {
            $isActive = ($i === 1) ? 'active' : '';
            $prepareLi .= "<li class='page-item $isActive'><a class='page-link' data-page='$i'>$i</a></li>";
        }

        echo "
            <nav aria-label='Page navigation example'>
                <ul class='pagination'>
                    <li class='page-item'><a class='page-link disabled' data-page>Previous</a></li>
                    {$prepareLi}
                    <li class='page-item'><a class='page-link $isNextPageDisabled' data-page='$NextPageNumber'>Next</a></li>
                </ul>
            </nav>
        ";

    }
    ?>



    <div class="row">
        <?php
        if(!empty($admins['data'])){
            $imgUrl = asset('imgs/admin.png');

            foreach ($admins['data'] as $admin) {
                echo "

                    <div class='col-xl-4 col-lg-6'>

                        <div class='card my-1 rounded-4 bg-primary-subtle text-primary-emphasis'>
                            <img src='$imgUrl' class='card-img-top mx-auto mt-3' style='width: 100px;'>

                            <div class='card-body'>
                                <h5 class='card-title text-center'>{$admin['name']}</h5>
                                <p class='card-text' style='overflow-x: auto;'>Email: <span class='ms-2'>{$admin['email']}</span></p>
                                <p class='card-text' style='overflow-x: auto;'>Gender: <span class='ms-2'>{$admin['gender']}</span></p>
                                <p class='card-text' style='overflow-x: auto;'>Phone: <span class='ms-2'>{$admin['phone']}</span></p>
                                <a class='btn btn-primary d-block mx-auto'>Edit</a>

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

