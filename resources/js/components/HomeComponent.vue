<template>
<div>
    こんにちは{{userInfo.name}}さん
    <v-sheet height="600">

        <v-calendar
            ref="calendar"

            :events="events"
        ></v-calendar>
    </v-sheet>
</div>

</template>

<script>
export default {
    name: "WelcomeComponent",

    data() {
        return {
            userInfo:{},
            events: [
                {
                    name: '月次報告',
                    start: '2022-01-01 09:00',
                    end: '2022-02-01 17:00',
                },
                {
                    name: '出張',
                    start: '2021-10-11',
                    end: '2021-10-15',
                }
            ],
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
