<template>
<div>


</div>

</template>

<script>
export default {
    name: "WelcomeComponent",

    data() {
        return {
            userInfo:{},
        }
    },
    created:function(){
        this.getUserInfo();
    },
    methods:{
        getUserInfo(){
            axios.get('/api/user')
                .then((res) => {
                    this.userInfo = res.data;
                })
                .catch((err) => {
                    console.log(err);
                })

        },
    }
}
</script>

<style scoped>

</style>
