<template>
  <div class="home">
        <navbar/>

   <h1>Admin User</h1>
   <div v-for="user in userList" v-bind:key="user.id">
      <indexUser :datas="user" v-on:del-user="delUser" v-on:update-user="updateUser"/>
    </div>
  </div>
</template>

<script>
import navbar from '@/components/NavBar.vue';
import indexAdminUser from '../components/indexAdminUser.vue';
export default {
  name: 'AdminUsers',
  components:{
    'navbar':navbar,
    'indexUser':indexAdminUser
  },
  data(){
    return {
      errors:[],
      userList:'',

    }
  },
  created(){
    this.initData();
  },
  mounted(){
    if (this.$store.state.UserData.id == undefined ){
      this.$router.push({ name: 'Welcome' })
    }
    if (this.$store.state.UserData.role != 2 ){
      this.$router.push({ name: 'Home' })
    }
  },
  methods:{
    updateUser($userId, $newRole){
      let formdata = new FormData();
      formdata.append("role", $newRole);
      let requestOptions = {
        method: "POST",
        body: formdata,
        header:{
          'Authorization': 'Bearer '+this.$store.state.token,
          'Accept': 'application/json',
        },
        redirect: "follow",
      };
      fetch(
        `/api/users/${$userId}/update`,
        requestOptions
      );

    },
    delUser($userId){
      let requestOptions = {
        method: "POST",
        redirect: "follow",
      };
      fetch(`/api/users/${$userId}/destroy`,
        requestOptions)
      this.initData();
    },
    initData(){
      fetch(`/api/users`)
      .then(response=> response.json())
      .then(response =>{
        this.userList = response;
      });
    }
  }
}
</script>
