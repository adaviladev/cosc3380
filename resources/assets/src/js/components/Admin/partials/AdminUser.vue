<template>
    <div class="list-item clearfix">
        <div class="list-container clearfix">
            <div class="col-dt-3 col-tb-3 col-mb-3">
                <div class="list-item-content">
                    {{admin.firstName}} {{admin.lastName}}
                    <div>
                        <!--<a :href=`/dashboard/employees/{{admin.id}}`>Edit</a>-->
                    </div>
                </div>
                <!-- /.list-item-content -->
            </div>
            <!-- /.col-dt-3 col-tb-3 col-mb-3 -->
            <div class="col-dt-3 col-tb-3 col-mb-3">
                <div class="list-item-content">
                    {{admin.createdAt}}
                </div>
                <!-- /.list-item-content -->
            </div>
            <!-- /.col-dt-3 col-tb-3 col-mb-3 -->
            <div class="col-dt-3 col-tb-3 col-mb-3">
                <div class="list-item-content">
                    {{admin.addedBy.firstName}} {{admin.addedBy.lastName}}
                </div>
                <!-- /.list-item-content -->
            </div>
            <!-- /.col-dt-3 col-tb-3 col-mb-3 -->
            <div class="col-dt-3 col-tb-3 col-mb-3">
                <div class="list-item-content">
                    <span v-if="admin.active === 1">Active</span>
                    <span v-else="admin.active !== 1">Deleted</span>
                </div>
                <!-- /.list-item-content -->
            </div>
            <!-- /.col-dt-3 col-tb-3 col-mb-3 -->
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({}),
        props: {
            admin: {
                required: true
            }
        },
        created() {
//            console.log(this.admin);
        }
    }
</script>

<style scoped>

</style>