<template>
<div>
    こんにちは{{userInfo.name}}さん
    <v-sheet height="600">
        <v-calendar
            ref="calendar"
            type="month"
            event-overlap-mode="mode"
            weekdays="[0, 1, 2, 3, 4, 5, 6]"
            event-overlap-threshold="30"
        ></v-calendar>
    </v-sheet>
</div>

</template>

<script>
export default {
    name: "WelcomeComponent",

    data() {
        return {
            userInfo:[],
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
