<?php use App\Core\Auth; ?>
<div class="list-wrapper card-2">
    <div class="list-header primary-bg clearfix">
        <div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
            <div class="list-item-content">
                <strong>Name</strong>
            </div>
            <!-- /.list-item-content -->
        </div>
        <!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
        <div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
            <div class="list-item-content">
                <strong>Date Added</strong>
            </div>
            <!-- /.list-item-content -->
        </div>
        <!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
        <div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
            <div class="list-item-content">
                <strong>Added By</strong>
            </div>
            <!-- /.list-item-content -->
        </div>
        <!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
        <div class="col-dt-3 col-tb-3 col-mb-3 no-margin">
            <div class="list-item-content">
                <strong>Status</strong>
            </div>
            <!-- /.list-item-content -->
        </div>
        <!-- /.col-dt-3 col-tb-3 col-mb-3  no-margin -->
    </div>
    <!-- /.container -->
    <div>
        <?php foreach ($employees as $employee) { ?>
            <div class="list-item clearfix">
                <div class="list-container clearfix">
                    <div class="col-dt-3 col-tb-3 col-mb-3">
                        <div class="list-item-content">
                            <?= $employee->firstName ?> <?= $employee->lastName ?>
                            <div>
                                <?php if (Auth::user()->roleId === 1) { ?>
                                    <a href="/admin/employees/<?= $employee->id; ?>">Edit</a>
                                <?php } else { ?>
                                    <a href="/dashboard/employees/<?= $employee->id; ?>">Edit</a>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- /.list-item-content -->
                    </div>
                    <!-- /.col-dt-3 col-tb-3 col-mb-3 -->
                    <div class="col-dt-3 col-tb-3 col-mb-3">
                        <div class="list-item-content">
                            <?php
                            $date = new DateTime($employee->createdAt);
                            echo $date->format('M j, Y');
                            ?>
                        </div>
                        <!-- /.list-item-content -->
                    </div>
                    <!-- /.col-dt-3 col-tb-3 col-mb-3 -->
                    <div class="col-dt-3 col-tb-3 col-mb-3">
                        <div class="list-item-content">
                            <?php
                            if (!empty($employee->addedBy)) {
                                echo $employee->addedBy->firstName . ' ' . $employee->addedBy->lastName;
                            }
                            ?>
                        </div>
                        <!-- /.list-item-content -->
                    </div>
                    <!-- /.col-dt-3 col-tb-3 col-mb-3 -->
                    <div class="col-dt-3 col-tb-3 col-mb-3">
                        <div class="list-item-content">
                            <?php if ($employee->active == 1) { ?>
                                Active
                            <?php } else { ?>
                                Deleted
                            <?php } ?>
                        </div>
                        <!-- /.list-item-content -->
                    </div>
                    <!-- /.col-dt-3 col-tb-3 col-mb-3 -->
                </div>
                <!-- /.list-content -->
            </div>
        <?php } ?>
    </div>
</div>
<!-- /.list-wrapper -->