<template>
  <div class="indexTuto card m-3">
      {{ datas.title }}<br>
      <div v-show="datas.state == 1">{{ $t('tuto.wip') }}</div>
    <div v-show="datas.state == 2">{{ $t('tuto.available') }}</div>
    <div v-show="datas.state == 3">{{ $t('tuto.archived') }}</div>
      {{ $t('tuto.by') }} {{ datas.authorName }}<br>
      Last update :{{ datas.updated_at| moment("dddd, MMMM Do YYYY") }}<br>
      {{ $t('read.summary') }} :
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
