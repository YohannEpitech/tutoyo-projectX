<template>
  <div class="tuto">
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
          <select class="custom-select" id="state" v-model="state">
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
             <option v-for="lang in langagesAvailable" v-bind:key="lang.id" :value="lang.name">{{ lang.name }}</option>

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
          value="Create"
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
  name: "createTuto",
  components: {
    'navbar' : navbar,


  },
  data() {
    return {
      errors:[],
      title: "",
      difficulty: "1",
      state: "1",
      langage: "",
      summary: "",
      content: "",
      pathImg: "",
      files: '',
      filesURL:null,
      langages:[],
      langagesAvailable:[],

    };
  },
  mounted(){
    if (this.$store.state.UserData.id == undefined ){
      this.$router.push({ name: 'Welcome' })
    }
    if (this.$store.state.UserData.role <= 1 ){
      this.$router.push({ name: 'Home' })
    }
    fetch(`/api/langages`)
    .then(response => response.json())
    .then(response =>{
      this.langagesAvailable= response;
    })
  },
  methods: {
    checkForm(e){
      e.preventDefault();
      
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
      if (this.summary && this.summary.length>255) {
        this.errors.push('Summary exceeded 255 characters.');
      }
      if (this.errors.length == 0) {
        this.register();
      }
    },
    onFileChanged(event){
      this.files  = event.target.files[0];
    },
    register() {
      let formdata = new FormData();
      formdata.append("title", this.title);
      formdata.append("difficulty", this.difficulty);
      formdata.append("state", this.state);
      formdata.append("author_id", this.$store.state.UserData.id);
      formdata.append("langage", this.langage);
      formdata.append("summary", this.summary);
      formdata.append("content", this.content);
      formdata.append('files', this.files);
      let requestOptions = {
        method: "POST",
        body: formdata,
        header:{
          'Authorization': 'Bearer '+this.$store.state.token,
        },
        redirect: "follow",
      };
      fetch(`/api/tutos/create`, requestOptions);
      this.$router.push({ name: 'Home' })
    },
  },
};
</script>