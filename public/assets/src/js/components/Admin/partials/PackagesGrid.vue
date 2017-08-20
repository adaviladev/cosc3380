<template>
    <div class="grid-wrapper clearfix">
        <Package v-for="packageItem in packages" :packageItem="packageItem"></Package>
    </div>
</template>

<script>
    import Package from './Package.vue';

    export default {
        components: {
            Package
        },
        data: () => ({}),
        created() {
//        this.admin = window.user;
        },
        props: {
            packages: {
                required: true
            }
        },
        ready: () => {
            console.log(this.packages);
        }
    }
</script>

<style scoped>

</style>