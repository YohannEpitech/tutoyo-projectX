<template>
  <div >
    <navbar/>
        <h1>(404) Page NotFound</h1>
        <router-link  :to="{name:'Welcome'}">Redirection to Welcome</router-link>


  </div>
</template>

<script>
import navbar from '@/components/NavBar.vue';
export default {
  name: 'Register',
  components: {
    navbar : navbar,
  },  
  
}
</script>
