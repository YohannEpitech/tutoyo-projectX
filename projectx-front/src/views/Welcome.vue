<template>
  <div class="home">
    <navbar/>
    <div  v-for="tuto in lists" v-bind:key="tuto.id">
        <indextuto :typeIndex="1" :datas="tuto"/>
      </div>
  </div>
</template>

<script>
import navbar from '@/components/NavBar.vue';
import indexTuto from '@/components/indexTuto.vue';

export default {
  name:'welcome',
  components:{
    'navbar':navbar,
    'indextuto':indexTuto

  },
  data() {
    return {
      lists:[],
    };
  },
  mounted() {
      this.initData();

  },
  methods:{
    initData(){
    fetch(`/api/tutos`)
    .then(response => response.json())
    .then(response => {
      this.lists = response
    })
    }
  }
}
</script>
