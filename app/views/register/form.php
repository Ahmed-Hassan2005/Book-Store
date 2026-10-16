<?php require_once __DIR__ . "/../../helpers/Helpers.php" ?>
<?php //pr($_SESSION);?>
<section id="Register">

    <div class="container">

        <div class="row p-3">

            <div class="col-3 m-auto">

                <form method="POST" action="<?= route('register') ?>">
                    <h1 class="text-center my-4 text-success">Register</h1>
                    <?= getSseeionMsg('_correct', false) ?>
                    <?= getSseeionMsg('_invalid', true) ?>

                    <?php
                    if(isAuth('admin')){
                        $select1 = oldSelect('role', '');
                        $select2 = oldSelect('role', 'customer');
                        $select3 = oldSelect('role', 'admin', true);
                        echo  "
                            <div class='mb-3'>
                                <label for='Role' class='form-label'>Role :</label>
                                
                                <select class='form-control' id='Role' name='role'>
                                    <option value=' $select1 disabled hidden></option>
                                    <option value='customer' $select2 >Customer</option>
                                    <option value='admin' $select3 >Admin</option>

                                </select>
                                <?= getError('role') ?>

                            </div><!--Role-->
                        ";
                    }
                    else{
                        echo "<input type='hidden' name='role' value='customer'>";
                    }
                    ?>


                    <div class="mb-3">
                        <label for="Name" class="form-label">Name :</label>
                        <input type="text" class="form-control" id="Name" aria-describedby="emailHelp" name="name" value="<?= old('name', true) ?>">
                        <?= getError('name') ?>

                    </div><!--Name-->
                    
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email :</label>
                        <input type="text" class="form-control" id="Email" aria-describedby="emailHelp" name="email" value="<?= old('email', true) ?>">
                        <?= getError('email') ?>

                    </div><!--Email-->

                    <div class="mb-3">
                        <label for="Password" class="form-label">Password :</label>
                        <input type="password" class="form-control" id="Password" name="password" value="<?= old('password', true) ?>">
                        <?= getError('password') ?>

                    </div><!--Password-->

                    <div class="mb-3">
                        <label for="Phone" class="form-label">Phone :</label>
                        <input type="text" class="form-control" id="Phone" aria-describedby="emailHelp" name="phone" value="<?= old('phone', true) ?>">
                        <?= getError('phone') ?>

                    </div><!--Phone-->

                    <div class="mb-3">
                        <label for="Gender" class="form-label">Gender :</label>

                        <select class="form-control" id="Gender" name="gender">
                            <option value="" <?= oldSelect('gender', '') ?> disabled hidden></option>
                            <option value="male" <?= oldSelect('gender', 'male') ?>>Male</option>
                            <option value="female" <?= oldSelect('gender', 'female', true) ?>>Female</option>

                        </select>
                        <?= getError('gender') ?>

                    </div><!--Gender-->
                    <button type="submit" class="btn btn-success w-100">Register</button>

                </form>

            </div><!--col-->

        </div><!--row-->

    </div><!--container-->

</section><!--Register-->

