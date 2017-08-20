<template>
    <div class="col-dt-4 col-tb-6 col-mb-12 grid-item clearfix">
        <div class="grid-item-container card-2 clearfix">
            <router-link to="admin/packages/" :packageId="packageItem.id">
                <div class="col-dt-12 col-tb-12 col-mb-12 grid-header secondary-bg text-left">
                    <div class="grid-item-content">
                        <h3>Order: #{{packageItem.id}}</h3>
                    </div>
                    <!-- /.grid-item-content -->
                </div>
                <!-- /.col-dt-12 col-tb-12 col-mb-12 -->
                <div class="clearfix grid-item-content">
                    <div class="col-dt-12 col-tb-12 col-mb-12 text-left">
                        <img src="/assets/images/content-box.png" alt="Content Box" class="center">
                    </div>
                    <!-- /.col-dt-12 col-tb-12 col-mb-12 -->
                    <div class="col-dt-12 col-tb-12 col-mb-12">
                        {{packageItem.user.firstName}} {{packageItem.user.lastName}}
                    </div>
                    <!-- /.col-dt-12 col-tb-12 col-mb-12 -->
                    <div class="col-dt-12 col-tb-12 col-mb-12">
                        {{packageItem.returnAddress.street}}, <br/>
                        {{packageItem.returnAddress.city}}, {{packageItem.returnAddress.state}} {{packageItem.returnAddress.zipCode}}
                    </div>
                    <!-- /.col-dt-12 col-tb-12 col-mb-12 -->
                    <div class="col-dt-12 col-tb-12 col-mb-12">
                        {{packageItem.destination.street}}, <br/>
                        {{packageItem.destination.city}}, {{packageItem.destination.state}} {{packageItem.destination.zipCode}}
                    </div>
                    <!-- /.col-dt-12 col-tb-12 col-mb-12 -->
                    <div class="col-dt-12 col-tb-12 col-mb-12 text-left">
                        {{packageItem.status}}
                    </div>
                    <!-- /.col-dt-12 col-tb-12 col-mb-12 -->
                </div>
                <!-- /.grid-item-content -->
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({}),
        props: {
            packageItem: {
                required: true
            }
        },
        created() {
//            console.log(this.packageItem);
        }
    }
</script>

<style scoped>

</style>