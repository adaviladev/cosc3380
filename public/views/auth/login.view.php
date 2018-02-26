<?php getHeader(); ?>

    <div class="row">
        <div class="container">
            <div class="form-wrapper">
                <h2>Sign In!</h2>
                <form action="/login" method="post">
                    <div class="field-container validate required">
                        <div class="field-container">
                            <label for="email">Email <span>*</span></label>
                            <select name="email" id="email">
                                <option disabled selected value=""></option>
                                <option value="customer@prostoffice.pro">customer@prostoffice.pro</option>
                                <option value="employee@prostoffice.pro">employee@prostoffice.pro</option>
                                <option value="admin@prostoffice.pro">admin@prostoffice.pro</option>
                            </select>
                            <!-- /#packageStatusSelector -->
                        </div>
                        <!-- /.field-container -->
                        <!--						<input type="email" name="email" required>-->
                    </div>
                    <!-- /.field-wrapper -->
                    <div class="field-container required">
                        <label for="password">Password <span>*</span></label>
                        <input id="password" type="password" name="password" value="secret" class="valid" required>
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
                    <button type="submit">Submit</button>
                </form>
            </div>
            <!-- /.form-wrapper -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.row -->

<?php getFooter(); ?>