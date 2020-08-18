<template>
  <div class="indexTuto card m-3 " style="max-width:10rem;">
      <input type="text" v-model="datas.name" >
        <img v-if="name != undefined":src="getImgUrl(datas.imgName)"  alt="img langage"  width="100"  />
    
     
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
  methods: {
    getImgUrl(pic){
      return require('@/assets/'+pic);
    },
    onFileChanged(event){
      this.imgFullName  = event.target.files[0].name;

    },
    update(){
      console.log(this.imgFullName)
      this.$emit('update-langage',this.datas.id, this.name, this.imgFullName)
    },

  },
};
</script>
