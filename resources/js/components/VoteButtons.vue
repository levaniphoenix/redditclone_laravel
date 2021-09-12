<template>
  <div>
    <button class="btn" @click="upvote" :style="upvoteColor"> <i class="fas fa-arrow-up"></i></button>
    <p class="align-text-bottom mb-0 mr-2" style="text-align: center;">{{this.displayRating}}</p>
    <button class="btn mr-2" @click="downvote" :style="downvoteColor"><i class="fas fa-arrow-down"></i></button>
  </div>
</template>

<script>
export default {
    props:[
      'postId',
      'isUpvoted',
      'isDownvoted',
      'rating',
    ],
    mounted() {
        
    },
    data() {
        return {
            statusIsUpvoted:this.isUpvoted,
            statusIsDownvoted:this.isDownvoted,
            displayRating:this.rating,
        }
    },
    methods: {
        upvote(){
            if(this.statusIsDownvoted==false && this.statusIsUpvoted==false)
                this.displayRating=parseInt(this.displayRating)+1;
            else if(this.statusIsUpvoted==false && this.statusIsDownvoted==true) 
                this.displayRating=parseInt(this.displayRating)+2;
            else if(this.statusIsDownvoted==false && this.statusIsUpvoted==true)
                this.displayRating=parseInt(this.displayRating)-1;
            
            this.statusIsUpvoted= !this.statusIsUpvoted;
            this.statusIsDownvoted=false;
            axios.post("/upvote/" + this.postId).then(res=>{
              //console.log(res.data);
            }).catch(errors =>{
                if(errors.response.status==401){
                    window.location='/login';
                }
            });
            
        },
        downvote(){
            if(this.statusIsDownvoted==false && this.statusIsUpvoted==false)
                this.displayRating=parseInt(this.displayRating)-1;
            else if(this.statusIsUpvoted==true && this.statusIsDownvoted==false) 
                this.displayRating=parseInt(this.displayRating)-2;
            else if(this.statusIsDownvoted==true && this.statusIsUpvoted==false)
                this.displayRating=parseInt(this.displayRating)+1;

            this.statusIsDownvoted= !this.statusIsDownvoted;
            this.statusIsUpvoted=false;
            axios.post("/downvote/" + this.postId).then(res=>{
                //console.log(this.rating);
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