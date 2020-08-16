<template>
  <div class="indexTuto card m-3">
      {{ datas.username }}
      {{ datas.email }}
    <h1>Role</h1>
    <div class="input-group">
      <select class="custom-select" id="role" v-model="datas.role">
        <option value="0">Student</option>
        <option value="1">Prof</option>
        <option value="2">Admin</option>
      </select>
      </div>
    <div class="card-footer">
      <button class="btn btn-success mr-3" @click="edit" > Edit </button>
    </div>
  </div>
</template>

<script>
import navbar from "@/components/NavBar.vue";
export default {
  name: "indexAdminUser",
  components: {
    navbar: navbar,
  },
  props: {
    msg: String,
    typeIndex: Number,
    datas: {}
  },
  methods: {
    edit(){
      this.$emit('edit-langage',this.datas.id)
    },

  },
};
</script>
