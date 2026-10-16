<?php 
    /**
     * @var array $authors
     */
?>

<div class="container">

    <?php preparePagination($authors, 'authors'); ?>

    <div class="row">
        <?php
        if(!empty($authors['data'])){
            $imgUrl = asset('imgs/author.png');

            foreach ($authors['data'] as $author) {
                $shortBio = substr($author['bio'], 0, 100);
                echo "

                    <div class='col-xl-4 col-lg-6'>

                        <div class='card my-1 rounded-4 bg-primary-subtle text-primary-emphasis'>
                            <img src='$imgUrl' class='card-img-top mx-auto mt-3' style='width: 100px;'>

                            <div class='card-body'>
                                <h5 class='card-title text-center'>{$author['name']}</h5>
                                <p class='card-text' style='overflow-x: auto;'>Bio: <span class='ms-2'>{$shortBio}...</span></p>
                                <a class='btn btn-primary d-block mx-auto'>Edit</a>

                            </div>

                        </div>

                    </div><!--total Authors-->

                ";
            }
        }
        else{
            echo"<div class='alert alert-warning w-75 mx-auto text-center' role='alert'>No Authors Found!</div>";
        }
        ?>

    </div><!--row-->

</div><!--container-->