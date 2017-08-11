<template>
    <div id="admin">
        <div class="row">
            <div class="container">
                <h1>Welcome, {{admin.firstName}} {{admin.lastName}}</h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="container">
                <?php if( ! empty( $packages ) ) { ?>
                <div class="group-wrapper card-2">
                    <h3>Recent Packages</h3>
                    <?php getPartial( "packagesGrid" , compact( 'packages' ) ); ?>
                    <div class="text-right">
                        <a href="/admin/reports">View Reports</a>
                    </div>
                    <!-- /.text-right -->
                </div>
                <!-- /.group-wrapper -->
                <?php } ?>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <?php if( ! empty( $admins ) ) { ?>
                <div class="group-wrapper card-2 clearfix">
                    <h3>Users</h3>
                    <?php getPartial( 'adminsList' , compact( 'admins' ) ); ?>
                    <div class="text-right">
                        <a href="/admin/users">View All Users</a>
                    </div>
                </div>
                <!-- /.group-wrapper -->
                <?php } ?>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <?php if( ! empty( $postOffices ) ) { ?>
                <div class="group-wrapper card-2">

                    <h3>Post Offices</h3>
                    <?php getPartial( 'locationsGrid' , compact( 'postOffices' ) ); ?>
                    <div class="text-right">
                        <a href="/admin/post-offices">View all Post Offices</a>
                    </div>
                    <!-- /.text-right -->
                </div>
                <!-- /.group-wrapper -->
                <?php } ?>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      data: () => ({
        admin: {},
        packages: [],
        users: [],
        postOffices: []
      }),
      created(){
        this.admin = window.user;

        axios.get('/packages?')
      }
    }
</script>

<style scoped>

</style>