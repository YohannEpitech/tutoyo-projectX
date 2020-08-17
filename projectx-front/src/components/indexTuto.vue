<template>
  <div class="indexTuto card m-3">
    <div class="card-header">
      <img :src="getImgUrl(datas.langage)"  alt="img langage" height="100" />
      {{ datas.title }}
       <div v-show="datas.difficulty == 1">{{ $t('tuto.easy') }}</div>
    <div v-show="datas.difficulty == 2">{{ $t('tuto.medium') }}</div>
    <div v-show="datas.difficulty == 3">{{ $t('tuto.pro') }}</div>
      {{ datas.langage }}

    <div v-show="datas.state == 1">{{ $t('tuto.wip') }}</div>
    <div v-show="datas.state == 2">{{ $t('tuto.available') }}</div>
    <div v-show="datas.state == 3">{{ $t('tuto.archived') }}</div>
    </div>
    <div class="card-body">
      <v-md-preview :text="datas.summary" ></v-md-preview>
      </div>
    <div class="card-footer">
      {{ datas.updated_at | moment("dddd, MMMM Do YYYY") }} {{ $t('tuto.by') }} {{ datas.authorName }}
      <div v-if="typeIndex == '1'">
        <div v-if="this.$store.state.UserData.id != undefined">
          <div v-if="datas.author_id == this.$store.state.UserData.id ">
            <router-link :to="'/tutos/'+datas.id">{{ $t('tuto.edit') }}</router-link>
          </div>
          <div v-else>
            <button v-on:click="addTuto">{{ $t('tuto.follow') }}</button>
          </div>
        </div>
      </div>

      <div v-else-if="typeIndex == '2'">
        <div v-if="datas.author_id == this.$store.state.UserData.id ">
            <router-link :to="'/tutos/'+datas.id">{{ $t('tuto.edit') }}</router-link>
            <router-link :to="'/tutos/'+datas.id+'/read'">{{ $t('tuto.read') }}</router-link>
          <span v-if="datas.state != 3"><a :href="'/api/tutos/'+datas.id+'/archive'">{{ $t('tuto.archive') }}</a ></span>
        </div>
        <div v-else>
          <button v-on:click="delTuto">{{ $t('tuto.nofollow') }}</button>
          <router-link :to="'/tutos/'+datas.id+'/read'">{{ $t('tuto.read') }}</router-link>
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
      return require('@/assets/'+pic+'.png');
    },
    addTuto() {
      let formdata = new FormData();
      formdata.append("me", this.$store.state.UserData.id);
      formdata.append("addTutoId", this.datas.id);
      let requestOptions = {
        method: "POST",
        header:{
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
        this.$emit('update-content')
      })
      
    },
    delTuto() {
      let formdata = new FormData();
      formdata.append("me", this.$store.state.UserData.id);
      formdata.append("delTutoId", this.datas.id);
      let requestOptions = {
        method: "POST",
        header:{
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
                this.$emit('update-content')

      });
    },
  },
};
</script>
