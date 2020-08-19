<template>
  <div class="indexTuto card w-25 m-3">
      {{ datas.name }} /{{ datas.email }}
    Role
    <span class="input-group w-50">
      <select class="custom-select" id="role" v-model="datas.role">
        <option value="0">Student</option>
        <option value="1">Prof</option>
        <option value="2">Admin</option>
      </select>
      </span>
    <div class="card-footer">
      <button class="btn btn-success mr-3" @click="update" > Save </button>

    <button class="btn btn-danger" @click="del" > Delete </button>
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
    update(){
      this.$emit('update-user',this.datas.id, this.datas.role)
    },
    del() {
      this.$emit('del-user',this.datas.id)
    },
  },
};
</script>
