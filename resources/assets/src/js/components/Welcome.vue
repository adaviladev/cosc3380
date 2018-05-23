<template>
    <div id="welcome">
        <div class="container">
            <div class="">
                <div class="heading text-center">
                    <h1>Welcome to ProstOffice.pro</h1>
                    <h3>Please <router-link to="/login">Login</router-link> or <router-link to="/register">Register</router-link></h3>
                </div>
                <!-- /.heading text-center -->
                <p class="text-center">
                    Customer satisfaction is one of our priority to us here at Prostoffice.pro, so if you have any issues please <router-link to="/contact">contact us</router-link>.
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      name: 'welcome',
      data() {
        return {
          message: 'hello'
        }
      }
    }
</script>

<style>

</style>