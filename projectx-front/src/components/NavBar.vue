<template>
  <div class="hello">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <router-link :to="{name: 'Welcome'}">{{ $t('MenuWelcome') }}</router-link>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<localeChanger/>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li v-if="this.$store.state.UserData.id != undefined" class="nav-item active">
        <router-link :to="{name: 'Home'}" >{{ $t('MenuHome') }}</router-link>
        <router-link to="/MyProfile">{{ $t('MenuProfile') }}</router-link>

      </li>

      <li v-if="this.$store.state.UserData.id != undefined" class="nav-item dropdown">
         <router-link :to="{name: 'logout'}" >{{ $t('MenuLogout') }}</router-link>
      </li>
       <li v-if="this.$store.state.UserData.role > 0" class="nav-item dropdown">
      <router-link to="/createtuto">{{ $t('MenuCreateTuto') }} </router-link>
      </li>
       <li v-if="this.$store.state.UserData.role > 1" class="nav-item dropdown">
      <router-link to="/adminUsers">{{ $t('MenuAdminUsers') }} </router-link>
      <router-link to="/adminTutos">{{ $t('MenuAdminTutos') }} </router-link>
       <router-link to="/adminLangages">{{ $t('MenuAdminLangages') }} </router-link>
      </li>

      <li v-if="this.$store.state.UserData.id == undefined" class="nav-item">
        <router-link to="/login">{{ $t('MenuLogin') }}</router-link>
        <router-link to="/register">{{ $t('MenuRegister') }}</router-link>

      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" @input="search"
                                                                                 v-model="value">
    </form>
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
          fetch(`/api/tutos`)
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
            header:{
              'Authorization': 'Bearer '+this.$store.state.token,
              'Accept': 'application/json',
            },
            redirect: 'follow'
          };
          fetch('/api/tutos/search')
          .then(response => response.json())
          .then(response => {
            this.$parent.lists = response.result;
          })          
        }
      },


    }
}
</script>
