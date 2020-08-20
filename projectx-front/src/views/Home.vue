<template>
  <div class="home">
    <navbar />
    <div class="m-3">
    <h1>{{ $t('home.dashboard') }}</h1>
    <div v-if="listsOwner.length != 0">
      <h2>{{ $t('home.mytutos') }}</h2>
      <div v-for="tutoOwner in listsOwner" v-bind:key="tutoOwner.id"  >
        <indextuto :typeIndex="2" :datas="tutoOwner" v-on:update-content="updateList" />
      </div>
    </div>
    <h2>{{ $t('home.followtutos') }}</h2>
    <div v-if="listsFollow.length == 0">{{ $t('home.empty') }}</div>
    <div v-for="tuto in listsFollow" v-bind:key="tuto.id">
      <indextuto :typeIndex="3" :datas="tuto" v-on:update-content="updateList" />
    </div>
  </div>
  </div>
</template>

<script>
import navbar from "@/components/NavBar.vue";

import indexTuto from "@/components/indexTuto.vue";

export default {
  name: "Home",
  components: {
    navbar: navbar,
    indextuto: indexTuto,
  },
  data() {
    return {
      listsFollow: [],
      listsOwner: [],
    };
  },
  mounted() {
    if (this.$store.state.UserData.id == undefined){
      this.$router.push({ name: 'Welcome' })
    } else {
    this.initData();
    }
  },
  methods: {
    updateList(){
      this.initData();
    },
    
    async initData() {
      let requestOptions = {
        method: "GET",
        headers:{
          authorization: 'Bearer '+this.$store.state.token,
        },
        
      };
      await fetch(`/api/users/${this.$store.state.UserData.id}/tutos`,requestOptions)
      .then(response => response.json())
      .then(response =>{
        this.listsFollow = response.followedTuto;
        this.listsOwner = response.authorTuto;
      })
    },
  },
};
</script>

