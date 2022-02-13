<template>
<div>
    <header-component>
    </header-component>
    <v-container class="grey">
        <v-row
            justify="center"
        >
            <!--                 メインのカルーセル -->
            <v-col cols="12">
                <h1 class="font-weight-bold">
                    目標達成者と同じことをすることが一番の近道
                </h1>
                <p>
                    このアプリで、目標達成者のToDoListを自分のものにしてしまおう
                </p>
            </v-col>
            <v-col cols="12">
                <v-carousel
                    height="vh50"
                >
                    <v-carousel-item
                        v-for="(page, i) in carousel.section1"
                        :key="i"
                    >
                        <v-card
                        >
                            <v-card-title class="text-h6">
                                {{page.text}}
                            </v-card-title>

                            <v-img
                                :src="page.img"
                                class="grey darken-4"
                            ></v-img>
                        </v-card>
                    </v-carousel-item>
                </v-carousel>
            </v-col>

            <v-col cols="12">
                <h1 class="font-weight-bold">
                    シンプルな進捗管理
                </h1>
                <p>

                </p>
            </v-col>
            <v-col cols="12">
                <v-carousel
                    height="vh50"
                >
                    <v-carousel-item
                        v-for="(page, i) in carousel.section1"
                        :key="i"
                    >
                        <v-card
                        >
                            <v-card-title class="text-h6">
                                {{page.text}}
                            </v-card-title>

                            <v-img
                                :src="page.img"
                                class="grey darken-4"
                            ></v-img>
                        </v-card>
                    </v-carousel-item>
                </v-carousel>
            </v-col>

            <!--                 補足事項のカルーセル -->
            <v-col cols="12">
                <v-row>
                    <v-col cols="6">
                        <div >
                            <h1 class="font-weight-bold">
                                カレンダーで進捗管理
                            </h1>
                            <p>
                                目標を設定した
                            </p>
                        </div>

                    </v-col>
                    <v-col cols="6">
                        <v-carousel
                            height="100%"
                        >
                            <v-carousel-item
                                v-for="(page, i) in carousel.section2"
                                :key="i"
                            >
                                <v-card
                                    align="center"
                                    justify="center"
                                >
                                    <v-card-title class="text-h6">
                                        {{page.text}}
                                    </v-card-title>

                                    <v-img

                                        :src='page.img'
                                        class="grey darken-4"
                                        contain
                                    ></v-img>
                                </v-card>
                            </v-carousel-item>
                        </v-carousel>
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
            signUpDialog : false,

            carousel:{
                section1:[
                    {
                        img:require('../../img/welcome/1-1.png').default,
                        text:'自分と同じ目標をもつToDoListを検索！',
                    },
                    {
                        img:require('../../img/welcome/1-2.png').default,
                        text:'Importして、',
                    },
                    {
                        img:require('../../img/welcome/1-3.png').default,
                        text:'自分のToDoListとして使おう',
                    },
                ],
                section2:[
                    {
                        img:'https://picsum.photos/350/165?random',
                        text:'Taskの進捗はシンプルにWaiting, Working, Completeの3つに分けて管理',
                    },
                    {
                        img:'https://picsum.photos/350/165?random',
                        text:'カレンダーで進捗が一目瞭然',
                    },
                    {
                        img:'https://picsum.photos/350/165?random',
                        text:'目標達成したら後学のためシェアしよう',
                    },
                ],

            }
        }
    },
    created:function(){
        this.checkAuth()
    },
    methods:{
        checkAuth(){
            axios.get('/api/check')
                .then((res) => {
                    if (res.data.message === "true") {
                        this.$router.push('/home')
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
