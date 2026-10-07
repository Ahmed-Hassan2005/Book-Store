<?php 
    /**
     * @var array $books
     */
?>

<div class="container">

    <?php
    if(!empty($books['data'])){

        $prepareLi = '';
        $pagesNumber = ceil($books['total'] / 10);
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
        if(!empty($books['data'])){
            $imgUrl = asset('imgs/book.png');

            foreach ($books['data'] as $book) {
                $shortDescription = substr($book['description'], 0, 100);
                echo "

                    <div class='col-xl-4 col-lg-6'>

                        <div class='card my-1 rounded-4 bg-primary-subtle text-primary-emphasis'>
                            <img src='$imgUrl' class='card-img-top mx-auto mt-3' style='width: 100px;'>

                            <div class='card-body'>
                                <h5 class='card-title text-center'>{$book['name']}</h5>
                                <p class='card-text' style='overflow-x: auto;'>Description: <span class='ms-2'>{$shortDescription}...</span></p>
                                <a class='btn btn-primary d-block mx-auto'>Edit</a>

                            </div>

                        </div>
                        <div class='card-body'>
                            <p class='card-text' style='overflow-x: auto;'>Author: <span class='ms-2'>{$book['author']}</span></p>
                            <p class='card-text' style='overflow-x: auto;'>Description: <span class='ms-2'>
                                {$shortDescription}
                            </span></p>
                            <p class='card-text' style='overflow-x: auto;'>Price: <span class='ms-2'>{$book['price']}</span></p>
                            <p class='card-text' style='overflow-x: auto;'>Stock: <span class='ms-2'>{$book['stock']}</span></p>

                        </div>

                    </div><!--total Books-->

                ";
            }
        }
        else{
            echo"<div class='alert alert-warning w-75 mx-auto text-center' role='alert'>No Books Found!</div>";
        }
        ?>



    </div><!--row-->

</div><!--container-->