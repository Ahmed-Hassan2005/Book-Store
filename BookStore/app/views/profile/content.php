<section id="Profile" class="py-3">

    <div class="container-fluid">

        <div class="row mt-3 px-2">

            <div class="col-lg-3 my-3">

                <div class="item">

                    <div class="card w-100">

                        <img 
                            src="<?= asset('imgs/admin.png') ?>"
                            style="width: 100px;"
                            class="card-img-top mx-auto my-3">

                        <div class="card-body">

                            <div class="title">

                                <h5 class="text-center">
                                    <i class="fa-solid fa-pen-to-square text-primary"></i>
                                    Ahmed Hassan

                                </h5>

                            </div><!--.title-->

                            <div class="the-rest">

                                <div class="row">

                                    <div class="col-lg-4">
                                        <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        Email:
                                    </div>

                                    <div class="col-lg-8">
                                        ahmed@gmail.com
                                    </div>

                                </div><!--email-->

                                <div class="row">
                                    <div class="col-lg-4">
                                        <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        Gender:
                                    </div>

                                    <div class="col-lg-8">
                                        Male
                                    </div>

                                </div><!--gender-->

                                <div class="row">
                                    <div class="col-lg-4">
                                        <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        Phone:
                                    </div>

                                    <div class="col-lg-8">
                                        01143686914
                                    </div>

                                </div><!--phone-->

                                <div class="row">
                                    <div class="col-lg-5">
                                        <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        Password:
                                    </div>

                                </div><!--password-->

                            </div><!--.the-rest-->

                        </div><!--.card-body-->

                    </div><!--.card-->

                </div><!--.item-->

            </div><!--.col-->

            <div class="col-lg-9 bg-white p-2 rounded-2 mx-auto">

                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">

                        <button
                            class="nav-link active"
                            id="Statistics-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#Statistics-tab-pane"
                            type="button"
                            role="tab"
                            aria-controls="Statistics-tab-pane"
                            aria-selected="true">
                            Statistics
                        </button>

                    </li><!--Statistics-->

                    <li class="nav-item" role="presentation">

                        <button
                            class="nav-link"
                            id="Admins-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#Admins-tab-pane"
                            type="button"
                            role="tab"
                            aria-controls="Admins-tab-pane"
                            aria-selected="false">
                            Admins
                        </button>

                    </li><!--Admins-->

                    <li class="nav-item" role="presentation">

                        <button
                            class="nav-link"
                            id="Customers-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#Customers-tab-pane"
                            type="button"
                            role="tab"
                            aria-controls="Customers-tab-pane"
                            aria-selected="false">
                            Customers
                        </button>

                    </li><!--Customers-->

                    <li class="nav-item" role="presentation">

                        <button
                            class="nav-link"
                            id="Authors-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#Authors-tab-pane"
                            type="button"
                            role="tab"
                            aria-controls="Authors-tab-pane"
                            aria-selected="false">
                            Authors
                        </button>

                    </li><!--Authors-->

                    <li class="nav-item" role="presentation">

                        <button
                            class="nav-link"
                            id="Books-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#Books-tab-pane"
                            type="button"
                            role="tab"
                            aria-controls="Books-tab-pane"
                            aria-selected="false">
                            Books
                        </button>

                    </li><!--Books-->

                    <li class="nav-item" role="presentation">

                        <div class="dropdown">

                            <button
                                class="nav-link dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Orders
                            </button>

                            <ul class="dropdown-menu">

                                <li>

                                    <a
                                        class="dropdown-item"
                                        id="Orders_ordered-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#Orders_ordered-tab-pane"
                                        type="button"
                                        role="tab"
                                        aria-controls="Orders_ordered-tab-pane"
                                        aria-selected="false">
                                        Ordered
                                    </a>

                                </li><!--Orders ordered-->

                                <li>

                                    <a
                                        class="dropdown-item"
                                        id="Orders_cancelled-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#Orders_cancelled-tab-pane"
                                        type="button"
                                        role="tab"
                                        aria-controls="Orders_cancelled-tab-pane"
                                        aria-selected="false">
                                        Cancelled
                                    </a>

                                </li><!--Orders cancelled-->

                                <li>

                                    <a
                                        class="dropdown-item"
                                        id="Orders_done-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#Orders_done-tab-pane"
                                        type="button"
                                        role="tab"
                                        aria-controls="Orders_done-tab-pane"
                                        aria-selected="false">
                                        Done
                                    </a>

                                </li><!--Orders done-->

                            </ul><!--dropdown menu-->

                        </div><!--dropdown-->

                    </li><!--Orders-->

                </ul><!--tabs-->

                <div class="tab-content" id="myTabContent" style="background-color: white;">

                    <div
                        class="tab-pane fade p-2 rounded-2 show active"
                        id="Statistics-tab-pane"
                        role="tabpanel"
                        aria-labelledby="Statistics-tab"
                        tabindex="0">
                        <?php include __DIR__ . "/statistics.php"; ?>
                    </div><!--Statistics-->

                    <div
                        class="tab-pane fade p-2 rounded-2"
                        id="Admins-tab-pane"
                        role="tabpanel"
                        aria-labelledby="Admins-tab"
                        tabindex="0">
                        <?php include __DIR__ . "/admins.php"; ?>
                    </div><!--Admins-->

                    <div
                        class="tab-pane fade p-2 rounded-2"
                        id="Customers-tab-pane"
                        role="tabpanel"
                        aria-labelledby="Customers-tab"
                        tabindex="0">
                        <?php include __DIR__ . "/customer.php"; ?>
                    </div><!--Customers-->

                    <div
                        class="tab-pane fade p-2 rounded-2"
                        id="Authors-tab-pane"
                        role="tabpanel"
                        aria-labelledby="Authors-tab"
                        tabindex="0">
                        <?php include __DIR__ . "/authors.php"; ?>
                    </div><!--Authors-->

                    <div
                        class="tab-pane fade p-2 rounded-2"
                        id="Books-tab-pane"
                        role="tabpanel"
                        aria-labelledby="Books-tab"
                        tabindex="0">
                        <?php include __DIR__ . "/books.php"; ?>
                    </div><!--Books-->

                    <div
                        class="tab-pane fade p-2 rounded-2"
                        id="Orders_ordered-tab-pane"
                        role="tabpanel"
                        aria-labelledby="Orders_ordered-tab"
                        tabindex="0">
                        <?php include __DIR__ . "/orderd.php"; ?>
                    </div><!--Orders ordered-->

                    <div
                        class="tab-pane fade p-2 rounded-2"
                        id="Orders_cancelled-tab-pane"
                        role="tabpanel"
                        aria-labelledby="Orders_cancelled-tab"
                        tabindex="0">
                        <?php include __DIR__ . "/cancelled.php"; ?>
                    </div><!--Orders cancelled-->

                    <div
                        class="tab-pane fade p-2 rounded-2"
                        id="Orders_done-tab-pane"
                        role="tabpanel"
                        aria-labelledby="Orders_done-tab"
                        tabindex="0">
                        <?php include __DIR__ . "/done.php"; ?>
                    </div><!--Orders done-->

                </div><!--tab-content-->

            </div><!--.col-->

        </div><!--.row-->

    </div><!--.container-fluid-->

</section><!--#Profile-->