<template>
  <div>
    <navbar />
    <router-link :to="{ name: 'Home'}">Back</router-link>
    <div class="card  m-4 p-3">
      <div class>
        <label for="title">Title :</label>
        {{ title }}
      </div>
      <div class>
        <label for="title">Difficulty :</label>
        <span v-show="difficulty == 1">Easy</span>
        <span v-show="difficulty == 2">Medium</span>
        <span v-show="difficulty == 3">Experimented</span>
      </div>
      <div class>
        <label>State :</label>
        <span v-show="state == 1">WIP</span>
        <span v-show="state == 2">Available</span>
        <span v-show="state == 3">Archived</span>
      </div>

      <div class>
        <label>Langage :</label>
        {{ langage }}
      </div>

      <label>Summary :</label>

      <v-md-preview :text="summary"></v-md-preview>

      <label>Content :</label>
      <v-md-preview :text="content"></v-md-preview>
      <label>Files :</label>
      <a :href="'/api/tutos/'+id+'/download'">{{ files }}</a>
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
    };
  },

  async mounted() {
    if (this.$store.state.UserData.id == undefined) {
      this.$router.push({ name: "Welcome" });
    } else {
      fetch(`/api/tutos/${this.$route.params.id}`)
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
            this.pathImg = response.result.pathImg;
            this.files = response.result.files;
          }
        });
    }
  },
  methods: {
    async downloadFile() {
      var formdata = new FormData();
      formdata.append("files", this.files);
      var requestOptions = {
        method: "GET",
        body: formdata,
        redirect: "follow",
      };
      let rawResponse = await fetch(
        `/api/tutos/${this.$route.params.id}/download`
      );
    },
  },
};
</script>
