<template>
  <div>
    <navbar />
    <router-link class="m-2" :to="{ name: 'Home'}">{{ $t('back') }}</router-link>
    <div class="card  m-4 p-3">
      <div class>
        <label for="title " class="font-weight-bold">{{ $t('read.title') }} : </label>
        {{ title }}
      </div>
      <div class>
        <label for="title" class="font-weight-bold">{{ $t('read.difficulty') }} : </label>
        <span v-show="difficulty == 1">{{ $t('tuto.easy') }}</span>
        <span v-show="difficulty == 2">{{ $t('tuto.medium') }}</span>
        <span v-show="difficulty == 3">{{ $t('tuto.pro') }}</span>
      </div>
      <div class>
        <label class="font-weight-bold">{{ $t('read.state') }} : </label>
        <span v-show="state == 1">{{ $t('tuto.wip') }}</span>
        <span v-show="state == 2">{{ $t('tuto.available') }}</span>
        <span v-show="state == 3">{{ $t('tuto.archived') }}</span>
      </div>

      <div class>
      
        <label  class="font-weight-bold">{{ $t('read.langage') }} : </label>
        {{ langage }}
        <img v-if="langage!=''" :src="getImgUrl(imgName)"  alt="img langage" height="50" />
      </div>

      <label  class="font-weight-bold">{{ $t('read.summary') }} :</label>

      <v-md-preview :text="summary"></v-md-preview>

      <label  class="font-weight-bold">{{ $t('read.content') }} :</label>
      <v-md-preview :text="content"></v-md-preview>
      <label  class="font-weight-bold">{{ $t('read.downloadFiles') }} :</label>
      <a :href="'/api/tutos/'+id+'/download'">{{ $t('read.exercices') }}.pdf</a>
    </div>
  </div>
</template>

<script>
import navbar from "@/components/NavBar.vue";

export default {
  name: "readTuto",
  components: {
    navbar: navbar,
  },
  data() {
    return {
      id: 0,
      title: "",
      difficulty: "",
      state: "",
      langage: "",
      summary: "",
      content: "",
      pathImg: "",
      files: "",
      imgName:"",
    };
  },

  created() {
    if (this.$store.state.UserData.id == undefined) {
      this.$router.push({ name: "Welcome" });
    } else {
      let requestOptions = {
        method: "GET",
        headers:{
          'Authorization': 'Bearer '+this.$store.state.token,
          'Accept': 'application/json',
        },
        redirect: "follow",
      };
      fetch(`/api/tutos/${this.$route.params.id}`,requestOptions)
        .then((response) => response.json())
        .then((response) => {
          if (response.code === 200) {
            this.id = response.result.id;
            this.title = response.result.title;
            this.difficulty = response.result.difficulty;
            this.state = response.result.state;
            this.langage = response.result.langage;
            this.summary = response.result.summary;
            this.content = response.result.content;
            this.imgName = response.result.imgName;
            this.files = response.result.files;

          }
        });
    }
  },
  mounted(){
    if (this.$store.state.UserData.id == undefined ){
      this.$router.push({ name: 'Welcome' })
    }
  },
  methods: {
    getImgUrl(pic){
      return require('@/assets/'+pic);
    },
    // downloadFile() {
    //   let requestOptions = {
    //     method: "GET",
    //     body: formdata,
    //     headers:{
    //       'Authorization': 'Bearer '+this.$store.state.token,
    //       'Accept': 'application/json',
    //     },
    //     redirect: "follow",
    //   };
    //   fetch(`/api/tutos/${this.$route.params.id}/download`,requestOptions);
    // },
  },
};
</script>
