<template >
    <div id="contact" >
        <div class="row" >
            <div class="container" >
                <div class="form-wrapper" >
                    <h2 >Contact Us</h2 >
                    <!-- Input begins -->
                    <form id="contactForm" @submit.prevent="handleForm">
                        <div class="field-container clearfix required" >
                            <label for="firstName" :class="isFilled('firstName')" >First Name</label >
                            <input id="firstName" type="text" name="firstName" class="" v-model="firstName" required >
                        </div >
                        <div class="field-container clearfix required" >
                            <label for="lastName" >Last Name</label >
                            <input id="lastName" type="text" name="lastName" class="" v-model="lastName" required >
                        </div >
                        <div class="field-container validate clearfix required" >
                            <label for="email" >Email</label >
                            <input id="email" type="email" name="email" class="" v-model="email" required >
                        </div >
                        <div class="field-container clearfix required" >
                            <label for="postOfficeSelector" >Your Local ProstOffice (Optional)</label >
                            <select id="postOfficeSelector" name="postOfficeSelector" v-model="selectedPostOffice" required >
                                <option disabled selected value="" ></option >
                                <option v-for="office in postOffices" v-model="office.name" >{{office.name}}</option >
                            </select >
                        </div >
                        <div class="field-container validate clearfix required" >
                            <!-- Text area -->
                            <label for="message" >What is your question or comment?</label >
                            <textarea id="message" type="text" name="message" class="" v-model="message" required></textarea >
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
      isActive() {

      }
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
      title: 'Contact Card'
    }),
    methods: {
      clearForm() {
        this.firstName = '';
        this.lastName = '';
        this.email = '';
        this.selectedPostOffice = '';
        this.message = '';
      },
      handleForm() {
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
      isFilled(field) {
        console.log(field);
      }
    }
  };
</script >

<style scoped >

</style >