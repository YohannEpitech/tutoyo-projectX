<template>
  <div >

  </div>
</template>

<script>
export default {
  name: 'Logout',
  created(){
    let formdata = new FormData();
      formdata.append("id", this.$store.state.UserData.id);
    let requestOptions = {
          method: 'POST',
          body: formdata,
          header:{
            'Authorization': 'Bearer '+this.$store.state.token,
            'Accept': 'application/json',
          },
          redirect: 'follow'
        };
    fetch("/api/logout", requestOptions);
    this.$store.state.UserData = {};
    this.$store.state.token = '';
    let date= new Date(Date.now()-60*60*100);
    let expireDate = date.toUTCString();
    document.cookie=`token=;path=/;expires=${expireDate};samesite=lax`;
    this.$router.push({name:'Welcome'});
  }
}
</script>