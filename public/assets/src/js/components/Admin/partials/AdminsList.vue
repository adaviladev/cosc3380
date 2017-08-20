<template>
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
            <AdminUser v-for="admin in admins" :admin="admin"></AdminUser>
        </div>
    </div>
    <!-- /.list-wrapper -->
</template>

<script>
    import AdminUser from './AdminUser.vue';

    export default {
        components: {
            AdminUser
        },
        data: () => ({}),
        created() {
//        this.admin = window.user;
        },
        props: {
            admins: {
                required: true
            }
        },
        ready: () => {
            console.log(this.admins);
        }
    }
</script>

<style scoped>

</style>