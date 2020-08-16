<template>
  <div class="">

    <navbar/>
    <router-link :to="{ name: 'Home'}">Back</router-link>
    <div class="card m-4 p-3">
      <form
      id='registerForm'
      @submit="checkForm"
      method="post"
      >

<div class="m-3" v-if="errors.length">
        <b>Please correct the following error(s):</b>
        <ul>
          <li v-for="error in errors" v-bind:key="error.index">{{ error }}</li>
        </ul>
      </div>


<div class="">
        <label for="name">Name :</label>
        <input
          id="name"
          v-model="name"
          type="text"
          name="name"
          class="mx-2 mt-2"
        >
      </div>

<div class="">
        <label for="file">Files :</label>
        <input
          id="file"
          type="file"
          name="title"
          class="mx-2 mt-2"
          accept="image/jpeg, image/png"
          @change="onFileChanged"
          aria-describedby="file"
        >
      </div>

      <div class="text-right">
        <input
          type="submit"
          value="Update"
          class="btn btn-primary mx-4"
        >
      </div>
      </form>
      </div>
    </div>
</template>

<script>
import navbar from '@/components/NavBar.vue';

export default {
  name: "editTuto",
  components: {
    'navbar' : navbar,
  },
  data() {
    return {
      errors:[],
      id:0,
      name:'',
      files: "",

    };
  },

  mounted(){
    this.initData();
  },
  methods: {
    initData(){
fetch(`/api/langages`)
    .then(response => response.json())
    .then(response =>{
      if (response.code === 200){
        this.id = response.result.id;
        this.name= response.result.name;
        this.files = response.result.files;
      } else {
        throw new Error('Id langage unknown')
        }
    })
    .catch((error)=>{
      this.errors.push(error.message);
    })
    },
    checkForm(e){
      e.preventDefault();
      if (this.name && this.files) {
        this.update();
      }
      this.errors = [];
      if (!this.name) {
        this.errors.push('Name required.');
      }
      if (!this.files) {
        this.errors.push('Files required.');
      }
    },

    onFileChanged(event){
      this.files  = event.target.files[0];
    },
    async submit() {
      var formdata = new FormData();
      formdata.append("name", this.name);
      formdata.append("files", this.files);
      var requestOptions = {
        method: "PUT",
        body: formdata,
        header:{
          'Authorization': this.$store.state.token,
        },
        redirect: "follow",
      };
      fetch(`/api/langages/${this.id}`, requestOptions);
      this.initData();
    },
  },
};
</script>
