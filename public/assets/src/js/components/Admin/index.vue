<template>
    <div id="admin">
        <div class="row">
            <div class="container">
                <!--<h1>Welcome, {{admin.firstName}} {{admin.lastName}}</h1>-->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="container">
                <div class="group-wrapper card-2">
                    <h3>Recent Packages</h3>
                    <PackagesGrid :packages="packages"></PackagesGrid>
                    <div class="text-right">
                        <a href="/admin/reports">View Reports</a>
                    </div>
                    <!-- /.text-right -->
                </div>
                <!-- /.group-wrapper -->
            </div>
        </div>

        <div class="row">
            <div class="container">
                <div class="group-wrapper card-2 clearfix">
                    <h3>Users</h3>
                    <AdminsList :admins="users"></AdminsList>
                    <!--<?php getPartial( 'adminsList' , compact( 'admins' ) ) ?>-->
                    <div class="text-right">
                        <a href="/admin/users">View All Users</a>
                    </div>
                </div>
                <!-- /.group-wrapper -->
            </div>
        </div>

        <div class="row">
            <div class="container">
                <div class="group-wrapper card-2">
                    <h3>Post Offices</h3>
                    <LocationsGrid :postOffices="postOffices"></LocationsGrid>
                    <div class="text-right">
                        <a href="/admin/post-offices">View all Post Offices</a>
                    </div>
                    <!-- /.text-right -->
                </div>
                <!-- /.group-wrapper -->
            </div>
        </div>
    </div>
</template>

<script>
    import PackagesGrid from './partials/PackagesGrid.vue';
    import AdminsList from './partials/AdminsList.vue';
    import LocationsGrid from './partials/LocationsGrid.vue';
    import axios from 'axios';

    export default {
        components: {
            PackagesGrid,
            AdminsList,
            LocationsGrid
        },
        data: () => ({
            admin: {},
            packages: [],
            users: [],
            postOffices: [],
            errors: []
        }),
        created() {
//        this.admin = window.user;

            axios.get('/admin')
                .then(response => {
//                    console.log(response);
                    this.packages = response.data.packages;
                    this.users = response.data.admins;
                    this.postOffices = response.data.postOffices;
                })
                .catch(e => {
                    this.errors.push(e);
                })
        }
    }
</script>

<style scoped>

</style>