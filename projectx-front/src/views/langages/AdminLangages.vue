<template>
  <div>
    <navbar/>
<div class="m-2">
    <h1>Admin Langages</h1>
    <!-- <button class="btn btn-success mr-3" @click="add" > Add langage </button> -->

    <div class="card-group" v-for="langage in langageList" v-bind:key="langage.id">
      <indexLangage :datas="langage" v-on:update-langage="updateLangage"/>
    </div>
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
    add(){

    },
    updateLangage($id, $name, $imgFull){
     let requestOptions = {
        method: "PUT",
        headers:{
          'Authorization': this.$store.state.token,
        },
        redirect: "follow",
      };
      fetch(`/api/langages/${$id}?name=${$name}&imgName=${img}`,
        requestOptions
      );

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
      fetch(`/api/langages`,requestOptions)
      .then(response=> response.json())
      .then(response =>{
        this.langageList = response;
      });
    }
  }
}
</script>
