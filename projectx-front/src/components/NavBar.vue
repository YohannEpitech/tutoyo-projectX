<template>
  <div class="hello">
      <nav class="navbar navbar-expand-lg navbar-light bg-info text-white">
  <router-link class="text-white font-weight-bold " :to="{name: 'Welcome'}">{{ $t('MenuWelcome') }}</router-link>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
   
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav nav-pills w-100 text-white">
     
      <router-link  v-if="this.$store.state.UserData.id != undefined" class="nav-link font-weight-bold "  :to="{name: 'Home'}" >{{ $t('MenuHome') }}</router-link>
      <router-link  v-if="this.$store.state.UserData.id != undefined" class=" nav-link font-weight-bold" to="/MyProfile">{{ $t('MenuProfile') }}</router-link>
      <router-link v-if="this.$store.state.UserData.id != undefined" class="nav-link font-weight-bold" :to="{name: 'logout'}" >{{ $t('MenuLogout') }}</router-link>
       
      <router-link v-if="this.$store.state.UserData.role > 1" class="nav-link font-weight-bold" to="/adminUsers">{{ $t('MenuAdminUsers') }} </router-link></li>
      <router-link v-if="this.$store.state.UserData.role > 1" class="nav-link font-weight-bold" to="/adminTutos">{{ $t('MenuAdminTutos') }} </router-link></li>
      <router-link v-if="this.$store.state.UserData.role > 1" class="nav-link font-weight-bold" to="/adminLangages">{{ $t('MenuAdminLangages') }} </router-link>
      <router-link  v-if="this.$store.state.UserData.id == undefined" class="nav-item nav-link font-weight-bold" to="/login">{{ $t('MenuLogin') }}</router-link>
      <router-link   v-if="this.$store.state.UserData.id == undefined"class="nav-item nav-link font-weight-bold" to="/register">{{ $t('MenuRegister') }}</router-link>
      <router-link v-if="this.$store.state.UserData.role > 0" class="nav-item nav-link btn btn-warning font-weight-bold w-10 ml-auto mr-2" to="/createtuto">{{ $t('MenuCreateTuto') }} </router-link>
      
      <localeChanger class=" ml-auto mr-2"/>
    </ul>
   
  </div>
 
</nav>
  </div>
</template>

<script>
import localeChanger from '@/components/localeChanger.vue';

export default {
  name: 'Navbar',
components:{
  localeChanger : localeChanger
},
  data() {
      return {
        value: ""
      };
    },
    methods: {
      search() {
        if (this.value === "") {
          let requestOptions = {
            method: 'GET',
            headers:{
              'Authorization': 'Bearer '+this.$store.state.token,
              'Accept': 'application/json',
            },
            redirect: 'follow'
          };
          fetch(`/api/tutos`,requestOptions)
          .then(response => response.json())
          .then(response =>{
            this.$parent.lists = response;
          });
        } else {
          let formdata = new FormData();
          formdata.append("searchField", this.value);
          let requestOptions = {
            method: 'POST',
            body: formdata,
            headers:{
              'Authorization': 'Bearer '+this.$store.state.token,
              'Accept': 'application/json',
            },
            redirect: 'follow'
          };
          fetch('/api/tutos/search',requestOptions)
          .then(response => response.json())
          .then(response => {
            this.$parent.lists = response.result;
          })          
        }
      },


    }
}
</script>
<style>
 
 nav router-link-active,
 nav router-link-exact-active {
   background-color: indianred;
   cursor: pointer;
 }
</style>
