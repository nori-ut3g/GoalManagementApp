<template>
<div>
    <header-component>
    </header-component>
    <v-container class="grey">
        <v-row
            justify="center"
        >
            <v-col cols="12">
                <h1 class="font-weight-bold">
                    決めた目標に対して
                </h1>
                <p>
                    まずは、Trello ボードとリスト、カードから始めましょう。チームの作業が増えたら、さらに他の機能へと拡大していきます。プロジェクト管理、タスクの整理、チームワークの促進をすべて一か所で行えます。
                </p>
            </v-col>
            <v-col cols="12">
                <v-img
                    src="https://picsum.photos/id/11/500/300"
                >
                </v-img>
            </v-col>
            <v-col cols="12">
                <v-row>
                    <v-col cols="6">
                        <v-img
                            src="https://picsum.photos/id/11/500/300"
                        >
                        </v-img>
                    </v-col>
                    <v-col cols="6">
                        <p>
                            まず、ボードから始めます
                            リストとカードは、Trello ボードで作業を管理するためのブロックです。タスクの割り当て、タイムライン、生産性メトリクス、カレンダーなどの機能を利用して発展させていきます。
                        </p>
                    </v-col>
                </v-row>


            </v-col>
        </v-row>
    </v-container>
</div>

</template>

<script>
import HeaderComponent from "./Header/HeaderComponent";
import LogInComponent from "./Header/LogInComponent";
import SignUpComponent from "./Header/SignUpComponent";
export default {
    name: "WelcomeComponent",
    components: {SignUpComponent, LogInComponent, HeaderComponent},
    data() {
        return {
            sideBar: false,
            userInfo:[],
            isLoggedIn:0,
            isShowAlert:false,
            loginDialog : false,
            signUpDialog : false
        }
    },
    created:function(){
        this.checkAuth()
    },
    methods:{
        checkAuth(){

            axios.get('/api/user')
                .then((res) => {
                    this.$router.push('/home')
                })
                .catch((err) => {
                    if(err.response.status === 401){

                    }
                })
        },

        loginCancel(){
            this.loginDialog = false;
        },
        signUpCancel(){
            this.signUpDialog = false;
        }

    }
}
</script>

<style scoped>

</style>
