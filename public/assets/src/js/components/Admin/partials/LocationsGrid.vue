<template>
    <div class="list-wrapper clearfix">
        <Location v-for="postOffice in postOffices" :postOffice="postOffice"></Location>
    </div>
</template>

<script>
    import Location from './Location.vue';

    export default {
        components: {
            Location
        },
        data: () => ({}),
        created() {
//        this.admin = window.user;
        },
        props: {
            postOffices: {
                required: true
            }
        },
        ready: () => {
            console.log(this.postOffices);
        }
    }
</script>

<style scoped>

</style>