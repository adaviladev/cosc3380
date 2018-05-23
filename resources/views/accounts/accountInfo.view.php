<?php //dd($userState);
getHeader();
$emailClass = isset($errors['email']) ? 'invalid' : '';
?>


<div class="row">
    <div class="container">
        <div class="form-wrapper">
            <h2>Account Info</h2>
            <form action="/account/info" method="post">
                <div class="field-container clearfix">
                    <label for="firstName">First Name</label>
                    <input id="firstName" name="firstName" class="valid fade-in"
                           value= <?= $user->firstName; ?> disabled>
                </div>
                <!-- /.field-container -->
                <div class="field-container clearfix">
                    <label for="lastName">Last name</label>
                    <input id="lastName" name="lastName" class="valid fade-in" value="<?= $user->lastName; ?>" disabled>
                </div>
                <!-- /.field-container -->
                <div class="field-container validate clearfix">
                    <label for="email" class="email">Email</label>
                    <input id="email" name="email" value="<?= $user->email ?>" class="<?= $emailClass; ?> valid fade-in"
                           disabled>
                </div>
                <!-- /.field-container -->
                <div class="field-container clearfix">
                    <label for="address">Street</label>
                    <input id="address" name="street" class="valid fade-in" value="<?= $address->street ?>">
                </div>
                <!-- /.field-container -->
                <div class="field-container clearfix">
                    <label for="city">City</label>
                    <input id="city" name="city" class="valid fade-in" value="<?= $address->city ?>">
                </div>
                <!-- /.field-container -->
                <div class="field-container clearfix">
                    <label for="StateSelector" class="filled">State</label>
                    <?php if (!empty($states)) { ?>
                        <select name="stateId" id="StateSelector" class="valid">
                            <?php
                            foreach ($states as $state) {
                                if ($state->id === $userState->id) {
                                    ?>
                                    <option value="<?= $state->id ?>" selected><?= $state->state ?></option>
                                <?php } else { ?>
                                    <option value="<?= $state->id ?>"><?= $state->state ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    <?php } ?>
                </div>
                <!-- /.field-container -->
                <!-- /#StateSelector -->
                <div class="field-container clearfix">
                    <label for="zipCode">Zip Code</label>
                    <input id="zipCode" name="zipCode" class='valid fade-in' value="<?= $address->zipCode ?>">
                </div>
                <!-- /.field-container -->
                <div class="button-hover">
                    <button>Change Address</button>
                    <a href="/account/info/password" class="button">Change Password</a>
                </div>
            </form>
        </div>
        <!-- /.form-wrapper -->
    </div>
    <!-- /.container -->
</div>
<!-- /.row -->

<?php
getFooter();
?>
