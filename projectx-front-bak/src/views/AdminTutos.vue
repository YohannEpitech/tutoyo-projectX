<template>
  <div class="home">
        <navbar/>

   <h1>Admin Tutos</h1>
   <div v-for="tuto in tutoList" v-bind:key="tuto.id">
      <indexAdminTuto :datas="tuto" v-on:del-tuto="delTuto" v-on:edit-tuto="editTuto"/>
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
  mounted(){
    this.initData();
  },
  methods:{
    editTuto($id){
      this.$router.push({ name: 'edittuto', params: { id: $id }})

    },
    delTuto($id){
      let requestOptions = {
        method: "POST",
        redirect: "follow",
      };
      fetch(`/api/tutos/${$id}/destroy`,
        requestOptions)
      this.initData();
    },
    initData(){
      fetch(`/api/tutos`)
      .then(response=> response.json())
      .then(response =>{
        this.tutoList = response;      });
    }
  }
}
</script>
