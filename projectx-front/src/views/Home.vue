<template>
  <div class="home">
    <navbar />
    <h1>{{ $t('home.dashboard') }}</h1>
    <div v-if="listsOwner.length>0">
    <h2>{{ $t('home.mytutos') }}</h2>
    <div v-for="tuto in listsOwner" v-bind:key="tuto.id" v-on:update-content="updateList" >

      <indextuto :typeIndex="2" :datas="tuto" />
    </div>
    </div>
    <h2>{{ $t('home.followtutos') }}</h2>
    <div v-if="listsFollow.length == 0">{{ $t('home.empty') }}</div>
    <div v-for="tuto in listsFollow" v-bind:key="tuto.id">
      <indextuto :typeIndex="2" :datas="tuto" v-on:update-content="updateList"/>
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
    initData() {
      fetch(`/api/users/${this.$store.state.UserData.id}/tutos`)
      .then(response => response.json())
      .then(response =>{
        this.listsFollow = response.followedTuto;
        this.listsOwner = response.authorTuto;
      })
    },
  },
};
</script>

