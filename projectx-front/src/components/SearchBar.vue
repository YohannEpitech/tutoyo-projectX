<template>
  <div class="hello">

<div class=" bg-info  justify-content-center active-cyan active-cyan-2 mb-3 p-1">
 <input class=" form-control text-center form-input w-25 mx-auto " type="search" placeholder="Search" aria-label="Search" @input="search"
                                                                                 v-model="value">
                                                                                 </div>
  </div>
</template>

<script>

export default {
  name: 'Searchbar',

  data() {
      return {
        value: ""
      };
    },
    mounted(){
      this.value = this.$store.state.search;
      this.search();
    },
    watch:{
      value:function(){
         this.$store.state.search = this.value
        localStorage.setItem("state", JSON.stringify(this.$store.state));          
        this.search();
      }
    },
    methods: {
      search() {
        if (this.$store.state.search == "") {
          let requestOptions = {
            method: 'GET',
            headers:{
              'Authorization': 'Bearer '+this.$store.state.token,
              'Accept': 'application/json',
            },
            redirect: 'follow'
          };
          fetch(`/api/tutos`,requestOptions)
          .then(response => response.json())
          .then(response =>{
            this.$parent.lists = response;
          });
        } else {
          let formdata = new FormData();
          formdata.append("searchField", this.$store.state.search );
          let requestOptions = {
            method: 'POST',
            body: formdata,
            headers:{
              'Authorization': 'Bearer '+this.$store.state.token,
              'Accept': 'application/json',
            },
            redirect: 'follow'
          };
          fetch('/api/tutos/search',requestOptions)
          .then(response => response.json())
          .then(response => {
            this.$parent.lists = response.result;
          })          
        }
      },


    }
}
</script>
