<template>
  <div class="home">
    <navbar/>
        <searchbar />

    <div  v-for="tuto in lists" v-bind:key="tuto.id">
        <indextuto :typeIndex="1" :datas="tuto"  />
      </div>
  </div>
</template>

<script>
import navbar from '@/components/NavBar.vue';
import indexTuto from '@/components/indexTuto.vue';
import searchbar from "@/components/SearchBar.vue";

export default {
  name:'welcome',
  components:{
    'navbar':navbar,
    'indextuto':indexTuto,
    searchbar:searchbar

  },
  data() {
    return {
      lists:[],
      listsFollow:[],
    };
  },
}
</script>
