<template>
  <div class="home">
        <navbar/>
<div class="m-2">
   <h1>Admin Tutos</h1>
   <router-link v-if="this.$store.state.UserData.role > 0" class="nav-item nav-link btn btn-success w-25" to="/createtuto">{{ $t('MenuCreateTuto') }} </router-link>
   <div v-for="tuto in tutoList" v-bind:key="tuto.id">
      <indexAdminTuto :datas="tuto" v-on:del-tuto="delTuto" v-on:edit-tuto="editTuto"/>
    </div>
     </div>
  </div>
</template>

<script>
import navbar from '@/components/NavBar.vue';
import indexAdminTuto from '../components/indexAdminTuto.vue';
export default {
  name: 'AdminUsers',
  components:{
    'navbar':navbar,
    'indexAdminTuto':indexAdminTuto
  },
  data(){
    return {
      errors:[],
      tutoList:'',

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
    editTuto($id){
      this.$router.push({ name: 'edittuto', params: { id: $id }})

    },
    delTuto($id){
      let requestOptions = {
        method: "DELETE",
        headers:{
          'Authorization': 'Bearer '+this.$store.state.token,
          'Accept': 'application/json',
        },
        redirect: "follow",
      };
      fetch(`/api/tutos/${$id}`,
        requestOptions)
      this.initData();
    },
    initData(){
      let requestOptions = {
        method: "GET",
        headers:{
          'Authorization': 'Bearer '+this.$store.state.token,
          'Accept': 'application/json',
        },
        redirect: "follow",
      };
      fetch(`/api/tutos/all`,requestOptions)
      .then(response=> response.json())
      .then(response =>{
        this.tutoList = response;      });
    }
  }
}
</script>
