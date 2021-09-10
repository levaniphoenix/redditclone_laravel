<template>
  <div>
    <button class="btn" @click="upvote"> <i class="fas fa-arrow-up"></i></button>
  </div>
</template>

<script>
export default {
    props:[
      'postId',
      'isUpvoted',
    ],
    methods: {
        upvote(){
            axios.post("/upvote/" + this.postId).then(res=>{
              console.log(res.data);
            });
            //console.log(this.postId);
        }
    },

}
</script>

<style>

</style>