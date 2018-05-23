<?php
getHeader();
$titles = array('User Id', 'First Name', 'Last Name', 'Email', 'Address ID');
?>
    <!-- /customers page displays all the customers assigned to the currently
     logged in user's post office location. It displays the users' id, first name, last name
     and email address, with a link to single user's view -->
    <div class="row">
        <div class="container">
            <div class="group-wrapper card-2 clearfix">
                <h3>Customers</h3>
                <?php getPartial('customersList', compact('customers')); ?>
            </div>
        </div>
    </div>


<?php getFooter(); ?>