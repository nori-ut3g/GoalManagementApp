<template>
<div>
    <div>
        <v-app-bar app clippedLeft flat dark color="indigo darken-3">

            <v-spacer></v-spacer>

            <v-btn
                @click="loginDialog = true"
            >login</v-btn>
            <v-dialog
                v-model="loginDialog"
                width="500"
            >
                <v-card>
                    <v-card-title class="text-h5 grey lighten-2">
                        LogIn
                    </v-card-title>

                    <log-in-component
                        @parent-cancel="loginCancel"
                    ></log-in-component>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>

            <v-btn
                @click="signUpDialog = true"
            >SignUp</v-btn>

            <v-dialog
                v-model="signUpDialog"
                width="500"
            >
                <v-card>
                    <v-card-title class="text-h5 grey lighten-2">
                        SignUp
                    </v-card-title>

                    <sign-up-component
                        @parent-cancel="signUpCancel"
                    ></sign-up-component>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>

        </v-app-bar>

    </div>

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
