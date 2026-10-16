<?php 
    /**
     * @var array $total
     */
?>

<div class="container">

    <div class="row">

        <div class="col-xl-3 col-md-4 col-sm-6">
            
            <div class="card my-1 rounded-4 bg-primary-subtle text-primary-emphasis" style="border: none;">
            
                <div class="card-body p-2">
                    <div class="w-100 text-center my-2"><i class="fa-solid fa-book"></i></div>
                    <div class="w-100 text-center my-2">Total Books</div>
                    <div class="w-100 text-center my-2 text-success fw-bolder"><?= $total['books'] ?></div>
            
                </div>
                
            </div>
                
        </div><!--total books-->

        <div class="col-xl-3 col-md-4 col-sm-6">
            
            <div class="card my-1 rounded-4 bg-primary-subtle text-primary-emphasis" style="border: none;">
            
                <div class="card-body p-2">
                    <div class="w-100 text-center my-2"><i class="fa-solid fa-user-group"></i></div>
                    <div class="w-100 text-center my-2">Total Authors</div>
                    <div class="w-100 text-center my-2 text-success fw-bolder"><?= $total['authors'] ?></div>
            
                </div>
                
            </div>
                
        </div><!--total Authors-->

        <div class="col-xl-3 col-md-4 col-sm-6">
            
            <div class="card my-1 rounded-4 bg-primary-subtle text-primary-emphasis" style="border: none;">
            
                <div class="card-body p-2">
                    <div class="w-100 text-center my-2"><i class="fa-solid fa-users-line"></i></div>
                    <div class="w-100 text-center my-2">Total Customers</div>
                    <div class="w-100 text-center my-2 text-success fw-bolder"><?= $total['customers'] ?></div>
            
                </div>
                
            </div>
                
        </div><!--total Customers-->

        <div class="col-xl-3 col-md-4 col-sm-6">
            
            <div class="card my-1 rounded-4 bg-primary-subtle text-primary-emphasis" style="border: none;">
            
                <div class="card-body p-2">
                    <div class="w-100 text-center my-2"><i class="fa-solid fa-user-tie"></i></div>
                    <div class="w-100 text-center my-2">Total Admins</div>
                    <div class="w-100 text-center my-2 text-success fw-bolder"><?= $total['admins'] ?></div>
            
                </div>
                
            </div>
                
        </div><!--total Admins-->

        <div class="col-xl-3 col-md-4 col-sm-6">
            
            <div class="card my-1 rounded-4 bg-primary-subtle text-primary-emphasis" style="border: none;">
            
                <div class="card-body p-2">
                    <div class="w-100 text-center my-2"><i class="fa-solid fa-circle-pause"></i></div>
                    <div class="w-100 text-center my-2">Total Ordered Orders</div>
                    <div class="w-100 text-center my-2 text-success fw-bolder"><?= $total['orders']['ordered'] ?></div>
            
                </div>
                
            </div>
                
        </div><!--total Ordered orders-->

        <div class="col-xl-3 col-md-4 col-sm-6">
            
            <div class="card my-1 rounded-4 bg-primary-subtle text-primary-emphasis" style="border: none;">
            
                <div class="card-body p-2">
                    <div class="w-100 text-center my-2"><i class="fa-solid fa-ban"></i></div>
                    <div class="w-100 text-center my-2">Total Canceled Orders</div>
                    <div class="w-100 text-center my-2 text-success fw-bolder"><?= $total['orders']['cancelled'] ?></div>
            
                </div>
                
            </div>
                
        </div><!--total canceled orders-->

        <div class="col-xl-3 col-md-4 col-sm-6">
            
            <div class="card my-1 rounded-4 bg-primary-subtle text-primary-emphasis" style="border: none;">
            
                <div class="card-body p-2">
                    <div class="w-100 text-center my-2"><i class="fa-solid fa-circle-check"></i></div>
                    <div class="w-100 text-center my-2">Total Ordered Books</div>
                    <div class="w-100 text-center my-2 text-success fw-bolder"><?= $total['orders']['done'] ?></div>
            
                </div>
                
            </div>
                
        </div><!--total ordered orders-->

    </div><!--row-->

</div><!--container-->




