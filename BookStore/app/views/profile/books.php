<?php 
    /**
     * @var array $books
     */
?>

<div class="container">

    <?php preparePagination($books, 'books'); ?>

    <div class="row">
        <?php
        if(!empty($books['data'])){
            
            foreach ($books['data'] as $book) {
                $img = $book['image'] ? "uploads/{$book['image']}" : 'book.png';
                $imgUrl = asset("imgs/$img");
                $shortDescription = substr($book['description'], 0, 100);
                $cartButton = '';
                if(isAuth('customer')){
                    $cartButton = "
                        <div class='input-group'>
                            <input 
                                type='number'
                                min='1' 
                                class='form-control' 
                                placeholder='add to cart' 
                                aria-label='Example text with button addon' 
                                aria-describedby='button-addon1'
                                id='input-quantity-{$book['id']}'>
                            <button class='btn btn-outline-success' type='button' onclick='addToCart({$book['id']}, this)'>Add To Cart</button>
                        </div>
                    ";
                }
                echo "

                    <div class='col-xl-4 col-lg-6'>

                        <div class='card my-1 rounded-4 bg-primary-subtle text-primary-emphasis'>
                            <img src='$imgUrl' class='card-img-top mx-auto mt-3' style='width: 100px;'>

                            <div class='card-body'>
                                <h5 class='card-title text-center'>{$book['title']}</h5>
                                <!-- <p class='card-text' style='overflow-x: auto;'>Description: <span class='ms-2'>{$shortDescription}...</span></p> -->
                                <p class='card-text' style='overflow-x: auto;'>Author: <span class='ms-2'>{$book['author_name']}</span></p>
                                <p class='card-text' style='overflow-x: auto;'>Description: <span class='ms-2'>
                                {$shortDescription}
                                </span></p>
                                <p class='card-text' style='overflow-x: auto;'>Price: <span class='ms-2'>{$book['price']}</span></p>
                                <p class='card-text' style='overflow-x: auto;'>Stock: <span class='ms-2'>{$book['stock']}</span></p>
                                $cartButton
                            </div>

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