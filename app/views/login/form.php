<?php require_once __DIR__ . "/../../helpers/Helpers.php" ?>
<section id="Login">

    <div class="container">

        <div class="row">

            <div class="col-3 m-auto">

                <form action="<?= route('/login') ?>" method="POST">
                    <h1 class="text-center my-4 text-success">Login</h1>
                    <?= getSseeionMsg('_correct', false) ?>
                    <?= getSseeionMsg('_invalid', true) ?>
                    
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
                    <button type="submit" class="btn btn-success w-100">Login</button>

                </form>

            </div><!--col-->

        </div><!--row-->

    </div><!--container-->

</section><!--Login-->