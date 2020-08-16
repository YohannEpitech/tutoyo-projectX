<template>
  <div class="">

    <navbar/>
    <router-link :to="{ name: 'Home'}">{{ $t('back') }}</router-link>
    <div class="card m-4 p-3">
      <form
      id='registerForm'
      @submit="checkForm"
      method="post"
      >

<div class="m-3" v-if="errors.length">
        <b>{{ $t('errors.msgGeneral') }}</b>
        <ul>
          <li v-for="error in errors" v-bind:key="error.index">{{ error }}</li>
        </ul>
      </div>


<div class="">
        <label for="title">{{ $t('read.title') }} :</label>
        <input
          id="title"
          v-model="title"
          type="text"
          name="title"
          class="mx-2 mt-2"
        >
      </div>

      <div class="">
        <label for="difficulty">{{ $t('read.difficulty') }} :</label>
        <div class="input-group">
          <select class="custom-select" id="difficulty" v-model="difficulty">
            <option selected value="1">Easy</option>
            <option value="2">Medium</option>
            <option value="3">Experimented</option>
          </select>
        </div>
      </div>


      <div class="">
        <label for="state">{{ $t('read.state') }} :</label>
        <div class="input-group">
          <select class="custom-select" id="state" v-model="difficulty">
            <option selected="selected" value="1">WIP</option>
        <option value="2">Available</option>
        <option value="3">Archived</option>
          </select>
        </div>
      </div>

      <div class="">
        <label for="langage">{{ $t('read.langage') }} :</label>
        <div class="input-group">
          <select class="custom-select" id="langage" v-model="langage">
            <option selected="selected" value="php">PHP</option>
            <option value="C">C</option>
            <option value="C++">C++</option>
            <option value="docker">Docker</option>
          </select>
        </div>
      </div>

      <div class="">
        <label for="summary">{{ $t('read.summary') }} :</label>
        <v-md-editor v-model="summary" height="400px"></v-md-editor>
      </div>

      <div class="">
        <label for="content">{{ $t('read.content') }} :</label>
        <v-md-editor v-model="content" height="800px"></v-md-editor>
      </div>


<div class="">
        <label for="file">{{ $t('read.uploadFiles') }} :</label>
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
      title: "",
      difficulty: "",
      state: "",
      langage: "",
      summary: "",
      content: "",
      pathImg: "",
      files: "",

    };
  },

  mounted(){
    fetch(`/api/tutos/${this.$route.params.id}`)
    .then(response => response.json())
    .then(response =>{
      if (response.code === 200){
        this.title= response.result.title;
        this.difficulty= response.result.difficulty;
        this.state = response.result.state;
        this.langage= response.result.langage;
        this.summary= response.result.summary;
        this.content= response.result.content;
        this.files = response.result.files;
      } else {
        throw new Error('Id tuto unknown')
        }
    })
    .catch((error)=>{
      this.errors.push(error.message);
    })
  },
  methods: {
    checkForm(e){
      e.preventDefault();
      if (this.title && this.state && this.langage && this.difficulty) {
        this.register();
      }
      this.errors = [];
      if (!this.title) {
        this.errors.push('Title required.');
      }
      if (!this.state) {
        this.errors.push('State required.');
      }
      if (!this.difficulty) {
        this.errors.push('Difficulty required.');
      }
      if (!this.langage) {
        this.errors.push('Langage required.');
      }
    },

    onFileChanged(event){
      this.files  = event.target.files[0];
    },
    async submit() {
      var formdata = new FormData();
      formdata.append("title", this.title);
      formdata.append("difficulty", this.difficulty);
      formdata.append("state", this.state);
      formdata.append("langage", this.langage);
      formdata.append("summary", this.summary);
      formdata.append("content", this.content);
      // formdata.append('files', this.files);
      var requestOptions = {
        method: "POST",
        body: formdata,
        header:{
          'Authorization': this.$store.state.token,
        },
        redirect: "follow",
      };
      let rawResponse = await fetch(
        `/api/tutos/${this.$route.params.id}/update`,
        requestOptions
      );
      let data = await rawResponse.json();

      this.$router.push({ name: 'Home' })

    },
  },
};
</script>
