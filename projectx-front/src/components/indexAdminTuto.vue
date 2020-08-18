<template>
  <div class="indexTuto card m-3">
      {{ datas.title }}<br>
      Last update :{{ datas.updated_at| moment("dddd, MMMM Do YYYY") }}<br>
      {{ datas.summary }}


    <div class="card-footer text-right">
      <button class="btn btn-success mr-3" @click="edit" > Edit </button>

    <button class="btn btn-danger" @click="del" > Delete </button>
    </div>
  </div>
</template>

<script>
import navbar from "@/components/NavBar.vue";
export default {
  name: "indexAdminTuto",
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
      this.$emit('edit-tuto',this.datas.id)
    },
    del() {
      this.$emit('del-tuto',this.datas.id)
    },
  },
};
</script>
