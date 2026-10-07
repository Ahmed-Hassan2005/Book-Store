<nav class="navbar navbar-expand-lg bg-body-tertiary">

    <div class="container">

        <a class="navbar-brand">
            <img src="<?= asset('imgs/logo.png') ?>" class="img-fluid">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= route('/') ?>">Home</a>
                </li>

                <?php
                if(isAuth('admin')){
                    $username = auth('name');
                    $profileRoute = route('/profile');
                    $registerRoute = route('/register');
                    $logoutRoute = route('/logout');
                    echo "
                        <li class='nav-item dropdown'>

                            <a 
                                class='nav-link dropdown-toggle' 
                                role='button' 
                                data-bs-toggle='dropdown' 
                                aria-expanded='false'>
                                $username
                            </a>

                            <ul class='dropdown-menu'>
                                <li><a class='dropdown-item' href='$profileRoute'>Profile</a></li>
                                <li><a class='dropdown-item' href='$registerRoute'>Create New Admin</a></li>
                                <li><a class='dropdown-item' href='$logoutRoute'>Logout</a></li>
                            </ul>

                        </li>
                    ";
                }
                else if(isAuth('customer')){
                    $username = auth('name');
                    $profileRoute = route('/profile');
                    $logoutRoute = route('/logout');
                    echo "
                        <li class='nav-item dropdown'>

                            <a 
                                class='nav-link dropdown-toggle' 
                                role='button' 
                                data-bs-toggle='dropdown' 
                                aria-expanded='false'>
                                $username
                            </a>

                            <ul class='dropdown-menu'>
                                <li><a class='dropdown-item' href='$profileRoute'>Profile</a></li>
                                <li><a class='dropdown-item' href='$logoutRoute'>Logout</a></li>
                            </ul>

                        </li>
                    ";
                }
                else{
                    $loginRoute = route('/login');
                    $registerRoute = route('/register');
                    echo "
                        <li class='nav-item dropdown'>

                            <a 
                                class='nav-link dropdown-toggle' 
                                role='button' 
                                data-bs-toggle='dropdown' 
                                aria-expanded='false'>
                                Account
                            </a>

                            <ul class='dropdown-menu'>
                                <li><a class='dropdown-item' href='$loginRoute'>Login</a></li>
                                <li><a class='dropdown-item' href='$registerRoute'>Register</a></li>
                            </ul>

                        </li>
                    ";
                }
                
                ?>
                


            </ul><!--navbar-nav-->

        </div><!--nav-->

    </div><!--container-->

</nav><!--navbar-->