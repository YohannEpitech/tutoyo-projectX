<template>
  <div >

  </div>
</template>

<script>
export default {
  name: 'Logout',
  async mounted(){
    let formdata = new FormData();
      formdata.append("id", this.$store.state.UserData.id);
    var requestOptions = {
          method: 'POST',
          body: formdata,

          redirect: 'follow'
        };
    let rawResponse = await fetch("/api/logout", requestOptions)
    let data = await rawResponse.json();
    this.$store.state.UserData = {};
    this.$store.state.token = '';
    let date= new Date(Date.now()-60*60*100);
    let expireDate = date.toUTCString();
    document.cookie=`token=;path=/;expires=${expireDate};samesite=lax`;
    this.$router.push({name:'Welcome'});
  }
}
</script>