<div 
    id="carouselExampleIndicators"
    class="carousel slide vh-100"
    data-bs-ride="carousel"
    data-bs-interval="3000"
    data-bs-pause="hover"
>

    <div class="carousel-indicators">

        <button
            type="button" 
            data-bs-target="#carouselExampleIndicators" 
            data-bs-slide-to="0" 
            class="bg-success active" 
            aria-current="true" 
            aria-label="Slide 1"
            style="
                width: 10px; 
                height: 10px;
                border-radius: 50%;
            "
        ></button>

        <button 
            type="button" 
            data-bs-target="#carouselExampleIndicators" 
            data-bs-slide-to="1" 
            class="bg-success" 
            aria-label="Slide 2"
            style="
                width: 10px; 
                height: 10px;
                border-radius: 50%;
            "
        ></button>

        <button 
            type="button" 
            data-bs-target="#carouselExampleIndicators" 
            data-bs-slide-to="2" 
            class="bg-success" 
            aria-label="Slide 3"
            style="
                width: 10px; 
                height: 10px;
                border-radius: 50%;
            "
        ></button>

    </div><!--carousel-indicators-->

    <div class="carousel-inner">

        <div class="carousel-item active">
            
            <div class="container">

                <div class="row">

                    <div class="col-lg-6 vh-100 d-flex align-items-center">

                        <div class="item">
                            <h5>SEARCH BOOKS EASILY</h5>
                            <h2 class="h1">ISBN Search Feature</h2>
                            <p>Search Books Using ISBN Number or Author names and save your time</p>
                            <button class="btn btn-success">Read More</button>

                        </div><!--item-->

                    </div><!--col-->

                    <div class="col-lg-6 vh-100 d-flex align-items-center">
                        <div class="item">
                            <img src="<?= asset('imgs/slide_1.png') ?>" class="img-fluid">
                        </div><!--item-->
                    </div>

                </div><!--row-->

            </div><!--container-->

        </div><!--carousel-item-1-->

        <div class="carousel-item">
            
            <div class="container">

                <div class="row">

                    <div class="col-lg-6 vh-100 d-flex align-items-center">

                        <div class="item">
                            <h5>SEARCH BOOKS EASILY</h5>
                            <h2 class="h1">ISBN Search Feature</h2>
                            <p>Search Books Using ISBN Number or Author names and save your time</p>
                            <button class="btn btn-success">Read More</button>

                        </div><!--item-->

                    </div><!--col-->

                    <div class="col-lg-6 vh-100 d-flex align-items-center">
                        <div class="item">
                            <img src="<?= asset('imgs/slide_2.png') ?>" class="img-fluid">
                        </div><!--item-->
                    </div>

                </div><!--row-->

            </div><!--container-->

        </div><!--carousel-item-2-->

        <div class="carousel-item">
            
            <div class="container">

                <div class="row">

                    <div class="col-lg-6 vh-100 d-flex align-items-center">

                        <div class="item">
                            <h5>SEARCH BOOKS EASILY</h5>
                            <h2 class="h1">ISBN Search Feature</h2>
                            <p>Search Books Using ISBN Number or Author names and save your time</p>
                            <button class="btn btn-success">Read More</button>

                        </div><!--item-->

                    </div><!--col-->

                    <div class="col-lg-6 vh-100 d-flex align-items-center">
                        <div class="item">
                            <img src="<?= asset('imgs/slide_3.png') ?>" class="img-fluid">
                        </div><!--item-->
                    </div>

                </div><!--row-->

            </div><!--container-->

        </div><!--carousel-item-3-->

    </div><!--carousel-inner-->

</div><!--carouselExampleIndicators-->