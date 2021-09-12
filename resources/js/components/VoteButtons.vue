<template>
  <div>
    <button class="btn" @click="upvote" :style="upvoteColor"> <i class="fas fa-arrow-up"></i></button>
    <p class="align-text-bottom mb-0 mr-2" style="text-align: center;">15k</p>
    <button class="btn mr-2" @click="downvote" :style="downvoteColor"><i class="fas fa-arrow-down"></i></button>
  </div>
</template>

<script>
export default {
    props:[
      'postId',
      'isUpvoted',
      'isDownvoted',
    ],
    mounted() {
        
    },
    data() {
        return {
            statusIsUpvoted:this.isUpvoted,
            statusIsDownvoted:this.isDownvoted,
        }
    },
    methods: {
        upvote(){
            this.statusIsUpvoted= !this.statusIsUpvoted;
            this.statusIsDownvoted=false;
            axios.post("/upvote/" + this.postId).then(res=>{
              //this.status= !this.status;
            }).catch(errors =>{
                if(errors.response.status==401){
                    window.location='/login';
                }
            });
            
        },
        downvote(){
            this.statusIsDownvoted= !this.statusIsDownvoted;
            this.statusIsUpvoted=false;
            axios.post("/downvote/" + this.postId).then(res=>{
                //console.log(res.data);
            }).catch(errors =>{
                if(errors.response.status==401){
                    window.location='/login';
                }
            });
        },
    },
    computed:{
        upvoteColor(){
            return (this.statusIsUpvoted) ? "color: #FF8B60;" : "color: #000;"; 
        },
        downvoteColor(){
            return (this.statusIsDownvoted) ? "color: #9494FF;" : "color: #000;";
        }
    },

}
</script>

<style>

</style>