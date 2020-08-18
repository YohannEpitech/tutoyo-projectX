<template>
  <div >
    <navbar/>
    <div class="card  w-50 mx-auto  m-2 ">
      <div class="card-header text-center">{{ $t('sign.signuptitle') }}</div>

<form
    id='registerForm'
    @submit="checkForm"
    method="post"
    >
<div class="m-3" v-if="errors.length">
        <b>{{ $t('errors.msgGeneral') }}</b>
        <ul>
          <li v-for="error in errors" v-bind:key="error.index">{{ error }}</li>
        </ul>
      </div>

<div class="text-center">
        <label for="username">{{ $t('sign.username') }} :</label>
        <input
          id="username"
          v-model="username"
          type="text"
          name="username"
          class="mx-2 mt-2"
        >
      </div>

<div class="text-center">
        <label for="email">{{ $t('sign.email') }} :</label>
        <input
          id="email"
          v-model="email"
          type="email"
          name="email"
          class="mx-2 mt-2"
        >
      </div>

      <div class="text-center">
        <label for="password">{{ $t('sign.password') }} :</label>
        <input
          id="password"
          v-model="password"
          type="password"
          name="password"
          class="mx-2"
        >
      </div>

       <div class="text-center">
        <label for="c_password">{{ $t('sign.c_password') }} :</label>
        <input
          id="c_password"
          v-model="c_password"
          type="password"
          name="c_password"
          class="mx-2"
        >
      </div>

<div class="text-right m-2">
        <input
          type="submit"
          :value="$t('sign.login')"
          class="btn btn-primary mx-4"
        >
      </div>
    </form>
    </div>
  </div>
</template>

<script>
import navbar from '@/components/NavBar.vue';
export default {
  name: 'Register',
  components: {
    navbar : navbar,
  },
  data(){
    return {
      errors:[],
      email:null,
      username:null,
      password:null,
      c_password:null
    }
  },
  
  mounted(){
    if (this.$store.state.UserData.id != undefined ){
      this.$router.push({ name: 'Home' })
    }
  },
  methods:{
    checkForm(e){
      e.preventDefault();
      if (this.username && this.email && this.password && (this.password == this.c_password)) {
        this.register();
      }
      this.errors = [];
      if (!this.username) {
        this.errors.push('Username required.');
      }
      if (!this.email) {
        this.errors.push('Email required.');
      }
      if (!this.password) {
        this.errors.push('Password required.');
      }
      
      if (this.password && (this.password != this.c_password)) {
        this.errors.push('Passwords don t match.');
      }
    },
    register(){

      if (this.c_password == this.password){
        let formdata = new FormData();
        formdata.append("username", this.username);
        formdata.append("email", this.email);
        formdata.append("password", this.password);

        let requestOptions = {
          method: 'POST',
          body: formdata,
          
          redirect: 'follow'
        };

        fetch("/api/register", requestOptions)

        fetch("/api/login", requestOptions)
        .then(response => response.json())
        .then(response =>{
          if (response.code === 201){
            this.$store.state.UserData=response.result;
            let date= new Date(Date.now()+60*60*100);
            let expireDate = date.toUTCString();
            document.cookie=`token=${response.token};path=/;expires=${expireDate};samesite=lax`;
            this.$router.push({ name: 'Home' })
          }
        })
      }
    }
  }
}
</script>
