<template>
  <div class="myProfile">
    <navbar />
    <div class="card m-2">
    <div class="card-header text-center">My profile</div>

    <form
    id='profileForm'
    @submit="checkForm"
    method="post"
    >

    <div class="m-3" v-if="errors.length">
        <b>Please correct the following error(s):</b>
        <ul>
          <li v-for="error in errors" v-bind:key="error.index">{{ error }}</li>
        </ul>
      </div>

<div class="text-center">
        <label for="username">Username :</label>
        <input
          id="username"
          v-model="username"
          type="text"
          name="username"
          class="mx-2 mt-2"
        >
      </div>

 <div class="text-center">
        <label for="password">Email :</label>
        {{ email }}
      </div>

 <div class="text-center">
        <label for="password">Password :</label>
        <input
          id="password"
          v-model="password"
          type="password"
          name="password"
          class="mx-2"
        >
      </div>

       <div class="text-center">
        <label for="c_password">Confirmation Password :</label>
        <input
          id="c_password"
          v-model="c_password"
          type="password"
          name="c_password"
          class="mx-2"
        >
      </div>

<div class="text-right">
        <input
          type="submit"
          value="Submit"
          class="btn btn-primary mx-4"
        >
      </div>
    </form>
    </div>
  </div>
</template>

<script>
import navbar from "@/components/NavBar.vue";

export default {
  name: "MyProfile",
  components: {
    navbar: navbar,
  },
  data() {
    return {
      errors:[],
      username: "",
      email: "",
      password: "",
      c_password: "",
    };
  },
  async mounted() {
    if (typeof(this.$store.state.UserData.id) == undefined) {
      this.$router.push({ name: "Welcome" });
    } else {
      fetch(`/api/users/${this.$store.state.UserData.id}`)
      .then(response => response.json())
      .then(response => {
        if (typeof(response.id) != undefined){
          this.username = response.name;
          this.email = response.email;
        }
        else {
          this.$router.push({ name: "Welcome" });
        }
      })
    }
  },
  methods: {
    checkForm(e){
      e.preventDefault();
      if (this.username && (this.password === this.c_password)) {
        this.update();
      }
      this.errors = [];
      if (!this.username) {
        this.errors.push('Username required.');
      }
      if (this.password != this.c_password) {
        this.errors.push('Passwords don t match.');
      }
    },
    async update() {
      var formdata = new FormData();
      if (this.username != this.$store.state.UserData.name) {
        formdata.append("username", this.username);
      }
      if (this.password !== "") {
        if (this.c_password === this.password) {
          formdata.append("password", this.password);
        }
      }
      var requestOptions = {
        method: "POST",
        body: formdata,
        header:{
          'Authorization': this.$store.state.token,
        },
        redirect: "follow",
      };

      fetch(
        `/api/users/${this.$store.state.UserData.id}/update`,
        requestOptions
      );

      this.$router.push({ name: "Home" });
      }
    },

};
</script>
