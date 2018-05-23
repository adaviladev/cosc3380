<?php getHeader(); ?>

    <div class="row">
        <div class="container">
            <div class="form-wrapper">
                <h2>Sign In!</h2>
                <form action="/login" method="post">
                    <div class="field-container validate required">
                        <label for="email">Email <span>*</span></label>
                        <input id="email" type="email" name="email" required>
                    </div>
                    <!-- /.field-wrapper -->
                    <div class="field-container required">
                        <label for="password">Password <span>*</span></label>
                        <input id="password" type="password" name="password" required>
                    </div>
                    <!-- /.field-wrapper -->
                    <?php if (!empty($errors)) { ?>
                        <div class="errors">
                            <?php foreach ($errors as $error) { ?>
                                <?= $error; ?>
                                <!-- /.error -->
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <button>Submit</button>
                </form>
            </div>
            <!-- /.form-wrapper -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.row -->

<?php getFooter(); ?>