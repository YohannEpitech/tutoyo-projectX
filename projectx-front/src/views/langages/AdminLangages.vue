<template>
  <div>
    <navbar/>

    <h1>Admin Langage</h1>
    <button class="btn btn-success mr-3" @click="add" > Add langage </button>

    <div v-for="langage in langageList" v-bind:key="langage.id">
      <indexLangage :datas="langage" v-on:update-langage="updateLangage"/>
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
  methods:{
    add(){

    },
    updateLangage($id, $name, $img){
      console.log(`?name=${$name}&imgName=${img.name}`)
     let requestOptions = {
        method: "PUT",
        header:{
          'Authorization': this.$store.state.token,
        },
        redirect: "follow",
      };
      fetch(`/api/langages/${$id}?name=${$name}&imgName=${img}`,
        requestOptions
      );

    },

    initData(){
      fetch(`/api/langages`)
      .then(response=> response.json())
      .then(response =>{
        this.langageList = response;
      });
    }
  }
}
</script>
