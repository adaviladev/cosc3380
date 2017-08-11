<template >
    <div id="login" >
        <div class="row" >
            <div class="container" >
                <div class="form-wrapper" >
                    <h2 >Sign In!</h2 >
                    <form @submit.prevent="handleLogin" >
                        <div class="field-container validate required" >
                            <label for="email" >Email <span >*</span ></label >
                            <input id="email" type="email" name="email" required v-model="email">
                        </div >
                        <!-- /.field-wrapper -->
                        <div class="field-container required" >
                            <label for="password" >Password <span >*</span ></label >
                            <input id="password" type="password" name="password" required v-model="password">
                        </div >
                        <!-- /.field-wrapper -->
                        <button type="submit" >Submit</button >
                    </form >
                </div >
                <!-- /.form-wrapper -->
            </div >
            <!-- /.container -->
        </div >
        <!-- /.row -->
    </div >
</template >

<script >
  import axios from 'axios';
  import router from '../../router';

  export default {
    name: 'login',
    data: () => ({
      email: 'admin@prostoffice.pro',
      password: 'secret',
      user: {
        email: '',
        password: '',
        roleId: 0,
      },
      errors: [],
    }),
    methods: {
      handleLogin() {
        console.log(this.email, this.password);
        axios.post('/login', {
               email: this.email,
               password: this.password,
             })
             .then(response => {
               let user = response.data;
               window.user = user;
               if (user.roleId === 1) {
                 router.push('/admin', user);
               } else if (user.roleId === 2) {
                 router.go('/dashboard');
               } else if (user.roleId === 3) {
                 router.go('/account');
               } else {
                 console.log("routing failed");
               }
             })
             .catch(errors => {
               this.errors.push(errors);
             });
      },
    },
  };
</script >

<style scoped >

</style >