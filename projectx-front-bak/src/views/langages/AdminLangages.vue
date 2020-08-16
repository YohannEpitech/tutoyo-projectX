<template>
  <div class="home">
        <navbar/>

   <h1>Admin Langage</h1>
   <div v-for="langage in langageList" v-bind:key="langage.id">
      <indexUser :datas="langage" v-on:update-langage="updateLangage"/>
    </div>
  </div>
</template>

<script>
import navbar from '@/components/NavBar.vue';
import indexAdminLangage from '@/components/indexAdminLangage.vue';
export default {
  name: 'AdminLangages',
  components:{
    'navbar':navbar,
    'indexLangage':indexAdminLangage
  },
  data(){
    return {
      errors:[],
      langageList:'',

    }
  },
  mounted(){
    this.initData();
  },
  methods:{
    updateLangage($userId){
      let formdata = new FormData();
      formdata.append("role", $newRole);
      var requestOptions = {
        method: "POST",
        body: formdata,
        header:{
          'Authorization': this.$store.state.token,
        },
        redirect: "follow",
      };
      fetch(
        `/api/users/${$userId}/update`,
        requestOptions
      );

    },

    initData(){
      fetch(`/api/langages`)
      .then(response=> response.json())
      .then(response =>{
        this.lanageList = response;
      });
    }
  }
}
</script>
