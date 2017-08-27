<template >
    <div id="contact" >
        <div class="row" >
            <div class="container" >
                <div class="form-wrapper" >
                    <h2 >Contact Us</h2 >
                    <!-- Input begins -->
                    <form id="contactForm" @submit.prevent="handleContact">
                        <div class="field-container clearfix required" >
                            <label for="firstName" :class="isFilled(firstName)" >First Name</label >
                            <input id="firstName" name="firstName" class="" v-model="firstName" required >
                        </div >
                        <div class="field-container clearfix required" >
                            <label for="lastName" :class="isFilled(lastName)" >Last Name</label >
                            <input id="lastName" name="lastName" class="" v-model="lastName" required >
                        </div >
                        <div class="field-container validate clearfix required" >
                            <label for="email" :class="isFilled(email)" >Email</label >
                            <input id="email" type="email" name="email" class="" v-model="email" required >
                        </div >
                        <div class="field-container clearfix required" >
                            <label for="postOfficeSelector">Your Local ProstOffice (Optional)</label >
                            <select id="postOfficeSelector" name="postOfficeSelector" v-model="selectedPostOffice" required >
                                <option disabled selected value="" ></option >
                                <option v-for="office in postOffices" v-model="office.name" >{{office.name}}</option >
                            </select >
                        </div >
                        <div class="field-container validate clearfix required" >
                            <!-- Text area -->
                            <label for="message" >What is your question or comment?</label >
                            <textarea id="message" name="message" class="" v-model="message" required></textarea >
                        </div >
                        <button name="submit" value="submit" >Submit</button >
                    </form >
                </div >
            </div >
        </div >
    </div >
</template >

<script >
  import axios from 'axios';

  export default {
    name: 'contact',
    computed: {
    },
    created() {
      axios.get(`/contact`)
           .then(response => {
             this.postOffices = response.data
           })
           .catch(e => {
             this.errors.push(e)
           })
    },
    data: () => ({
      firstName: '',
      lastName: '',
      email: '',
      selectedPostOffice: '',
      message: '',
      errors: [],
      postOffices: [],
    }),
    methods: {
      clearForm() {
        this.firstName = '';
        this.lastName = '';
        this.email = '';
        this.selectedPostOffice = '';
        this.message = '';
      },
      handleContact() {
        console.log(this.firstName, this.lastName, this.email, this.selectedPostOffice, this.message);
//        axios.post(`/contact`, {
//          firstName: this.firstName,
//          lastName: this.lastName,
//          email: this.email,
//          selected
//             })
//             .then(response => {})
//             .catch(e => {
//               this.errors.push(e)
//             });
        console.log('form submitted');
        clearForm();
      },
      isFilled(value) {
        if(value.length !== 0) {
          return 'filled';
        }
      },
    }
  };
</script >

<style scoped >

</style >