<template>
  <div class="login">
    <navbar/>
    <div class="card w-50 mx-auto my-3">
    <div class="card-header text-center">{{ $t('sign.logintitle') }}</div>
    <form
    id='loginForm'
    @submit="checkForm"
    method="post"
    >

      <div class="m-3" v-if="errors.length">
        <b>Please correct the following error(s):</b>
        <ul>
          <li v-for="error in errors" v-bind:key="error.index">{{ error }}</li>
        </ul>
      </div>


      <div class="text-center">
        <label for="email">{{ $t('sign.email') }} :</label>
        <input
          id="email"
          v-model="email"
          type="text"
          name="email"
          class="mx-2 mt-2"
        >
      </div>

      <div class="text-center">
        <label for="password">{{ $t('sign.password') }}  :</label>
        <input
          id="password"
          v-model="password"
          type="password"
          name="password"
          class="mx-2"
        >
      </div>

      <div class="text-right">
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
  name: 'login',
  components: {
    navbar : navbar,
  },
  data(){
    return {
      errors:[],
      email:'',
      password:'',
      follow_tutos:[]
    }
  },
  mounted(){
    if (this.$store.state.UserData.id != undefined){
      this.$router.push({ name: 'Home' })
    }
  },
  methods:{
    checkForm(e){
      e.preventDefault();

      if (this.email && this.password) {
        this.login();
      }
      this.errors = [];
      if (!this.email) {
        this.errors.push('Email required.');
      }
      if (!this.password) {
        this.errors.push('Password required.');
      }
    },
    login(){
      let formdata = new FormData();
      formdata.append("email", this.email);
      formdata.append("password", this.password);
      let requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
      };
      fetch("/api/login", requestOptions)
      .then(response => response.json())
      .then( response => {
        if (response.code === 201){
          this.$store.state.UserData=response.result;
          let date= new Date(Date.now()+60*60*100);
          let expireDate = date.toUTCString();
          this.$store.state.token = response.result.token;
          document.cookie=`token=${response.result.token};path=/;expires=${expireDate};samesite=lax`;
          this.$router.push({ name: 'Home' })
        } else if (response.code === 404){
          throw new Error('User unknow or credentials dont matched')
        }
      })
      .catch((error)=>{
        this.errors.push(error.message)
      })
    },
  }
}
</script>
