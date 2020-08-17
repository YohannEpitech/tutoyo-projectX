<template>
  <div class="indexTuto card m-3">
      <input type="text" v-model="name" >
        <!-- <label for="img">{{ $t('read.langageImg') }} :</label> -->
        <input
          id="img"
          type="file"
          name="img"
          class="mx-2 mt-2"
          accept="image/jpeg, image/png"
          @change="onFileChanged"
          aria-describedby="file"
        >
     
    <div class="card-footer">
       <button class="btn btn-success mr-3" @click="update" > Save </button>
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
   datas: {}
  },
  data(){
    return {
      name:'',
      imgName:''
    }
  },
  mounted(){
    this.name = this.datas.name,
    this.imgName = this.datas.imgName
  },
  methods: {
    onFileChanged(event){
      this.imgName  = event.target.files[0].name;
    },
    update(){
      console.log(this.imgName)
      this.$emit('update-langage',this.datas.id, this.name, this.imgName)
    },

  },
};
</script>
