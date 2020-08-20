<template>
  <div class="indexTuto card m-3">
    <div class="row">
    <div class="col-1 mx-auto my-auto">
    <img :src="getImgUrl(datas.imgName)"  alt="img langage" class="img-fluid" />
      </div>
      <div class="col-8 text-left my-2">
      {{ datas.title }}
       <div v-show="datas.difficulty == 1">{{ $t('tuto.easy') }}</div>
      <div v-show="datas.difficulty == 2">{{ $t('tuto.medium') }}</div>
      <div v-show="datas.difficulty == 3">{{ $t('tuto.pro') }}</div>
      <div v-show="datas.state == 1">{{ $t('tuto.wip') }}</div>
    <div v-show="datas.state == 2">{{ $t('tuto.available') }}</div>
    <div v-show="datas.state == 3">{{ $t('tuto.archived') }}</div>
    <v-md-preview :text="datas.summary" ></v-md-preview>
   </div>

    <div class="col-2 bg-light ml-auto mr-2">
      {{ datas.updated_at | moment("dddd, MMMM Do YYYY") }} </br>{{ $t('tuto.by') }} {{ datas.authorName }}
      <div v-if="typeIndex == '1'">
        <div v-show="this.$store.state.UserData.id != undefined">
            <router-link v-show="datas.author_id == this.$store.state.UserData.id " class="btn btn-danger" :to="'/tutos/'+datas.id">{{ $t('tuto.edit') }}</router-link>
            <button v-if="isFollowedTuto()" class="btn btn-danger m-1" v-on:click="delTuto">{{ $t('tuto.nofollow') }}</button>
            <button v-else class="btn btn-primary m-1"  v-on:click="addTuto">{{ $t('tuto.follow') }}</button>
            <router-link class="btn btn-success m-1" :to="'/tutos/'+datas.id+'/read'" >{{ $t('tuto.read') }}</router-link>
 
          </div>
      </div>

      <div v-show="typeIndex == '2'">
        <div v-if="datas.author_id == this.$store.state.UserData.id ">
            <router-link class="btn btn-danger m-1" :to="'/tutos/'+datas.id" >{{ $t('tuto.edit') }}</router-link><br>
            <router-link class="btn btn-success m-1" :to="'/tutos/'+datas.id+'/read'" >{{ $t('tuto.read') }}</router-link>
            <button v-if="datas.state != 3" class="btn btn-warning m-1" v-on:click="archiveTuto">{{ $t('tuto.archive') }}</button>
          
        </div>
        </div>

      <div v-show="typeIndex == '3'">
          <button class="btn btn-danger m-1" v-on:click="delTuto">{{ $t('tuto.nofollow') }}</button><br>
          <router-link  class="btn btn-success m-1"  :to="'/tutos/'+datas.id+'/read'">{{ $t('tuto.read') }}</router-link>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import navbar from "@/components/NavBar.vue";
import editTuto from "@/views//EditTuto.vue";
export default {
  name: "indextuto",
  components: {
    navbar: navbar,
    edittuto: editTuto,
  },
  props: {
    msg: String,
    typeIndex: Number,
    datas: {}
  },
  methods: {
    getImgUrl(pic){
      return require('@/assets/'+pic);
    },
    isFollowedTuto(){
      if (this.$store.state.UserData.follow_tutos != undefined){
        if (this.$store.state.UserData.follow_tutos.includes(this.datas.id)){
          return true;

        } else {
          return false;
        }
      }
    },
    addTuto() {
      let formdata = new FormData();
      formdata.append("me", this.$store.state.UserData.id);
      formdata.append("addTutoId", this.datas.id);
      let requestOptions = {
        method: "POST",
        headers:{
          'Authorization': 'Bearer '+this.$store.state.token,
          'Accept': 'application/json',
        },
        body: formdata,
        redirect: "follow",
      };
      fetch(`/api/users/me/tutos/add`,requestOptions)
      .then(response => response.json())
      .then(response =>{
        this.$store.state.UserData = response;
        localStorage.setItem("state", JSON.stringify(this.$store.state));
        this.$emit('update-content')
      })
      
    },
    delTuto() {
      let formdata = new FormData();
      formdata.append("me", this.$store.state.UserData.id);
      formdata.append("delTutoId", this.datas.id);
      let requestOptions = {
        method: "POST",
        headers:{
          'Authorization': 'Bearer '+this.$store.state.token,
          'Accept': 'application/json',
        },
        body: formdata,
        redirect: "follow",
      };
      fetch(`/api/users/me/tutos/delete`,requestOptions)
      .then(response => response.json())
      .then(response => {
        this.$store.state.UserData = response;
        localStorage.setItem("state", JSON.stringify(this.$store.state));
        this.$emit('update-content')

      });
    },
      archiveTuto() {
      let formdata = new FormData();
      formdata.append("id", this.datas.id);
      let requestOptions = {
        method: "POST",
        headers:{
          'Authorization': 'Bearer '+this.$store.state.token,
          'Accept': 'application/json',
        },
        body: formdata,
        redirect: "follow",
      };
      fetch(`/api/tutos/${this.datas.id}/archive`,requestOptions);
              this.$emit('update-content')

      
    },
  },
};
</script>
