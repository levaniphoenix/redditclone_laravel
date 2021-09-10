<template>
    <div>
        <button @click="joinSubreddit" v-text="buttonText" style="margin-top: 24px; width:100px; font-weight: 700; letter-spacing: unset;" class="ml-4 btn btn-primary rounded-pill"></button>
    </div>
</template>

<script>
export default {
    props:[
        'subredditId',
        'isJoined',
    ],
    mounted() {
        
    },
    data() {
        return {
            status:this.isJoined,
        }
    },

    methods: {
        joinSubreddit(){
            axios.post("/join/" + this.subredditId).then(res =>{
                this.status= !this.status;
            })
            .catch(errors =>{
                if(errors.response.status==401){
                    window.location='/login';
                }
            });
        }
    },
    computed:{
        buttonText(){
            return (this.status) ? 'Joined' : "Join"; 
        }
    },

}
</script>

<style>
    
</style>
