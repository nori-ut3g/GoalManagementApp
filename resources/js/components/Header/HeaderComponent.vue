<template>
    <div>
        <v-app-bar app clippedLeft flat dark color="indigo darken-3">
            <v-app-bar-nav-icon
                v-if="isLoggedIn"
                @click.stop="sideBar=!sideBar"
            ></v-app-bar-nav-icon>
            <v-btn v-if="isLoggedIn" to="/home">Home</v-btn>
            <v-spacer></v-spacer>

            <v-btn
                @click="loginDialog = true"
                v-if="!isLoggedIn"
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
                        @alert="showAlert"
                    ></log-in-component>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>

            <v-btn
                @click="signUpDialog = true"
                v-if="!isLoggedIn"
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
                        @alert="showAlert"
                    ></sign-up-component>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>

            <v-btn
                @click="logout"
                v-if="isLoggedIn"
            >Logout</v-btn>

        </v-app-bar>
        <v-alert
            border="top"
            color="red lighten-2"
            dark
            v-if="alert.isShow"
        >
            {{alert.message}}
        </v-alert>
        <v-navigation-drawer
            app
            clipped
            v-model="sideBar"
            dark
            color=""
        >
            <v-list>
                <v-list-item>
                    <v-list-item-title
                        class="text-h4"
                    >{{userInfo.name}}
                    </v-list-item-title>
                </v-list-item>

                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-title class="text-h6">

                        </v-list-item-title>
                        <v-list-item-subtitle>
                            {{userInfo.email}}
                        </v-list-item-subtitle>
                    </v-list-item-content>

                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list
                nav
                dense
            >
                <v-list-item-group
                    color="primary"
                >
                    <v-list-item
                        v-for="(item, i) in items"
                        :key="i"
                        :to="item.link"
                    >
                        <v-list-item-icon>
                            <v-icon v-text="item.icon"></v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title v-text="item.text"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>

        </v-navigation-drawer>

    </div>

</template>

<script>
import LogInComponent from "./LogInComponent";
import SignUpComponent from "./SignUpComponent";
export default {
    name: "HeaderComponent",
    components: {SignUpComponent, LogInComponent},
    data() {
        return {
            sideBar: false,
            userInfo:[],
            isLoggedIn:false,
            alert:{
                isShow:false,
                message:""
            },
            items: [
                { text: 'My Goals', icon: 'mdi-folder' , link:'/list'},
                { text: 'Create Goal', icon: 'mdi-flag-checkered' , link:'/create'},
                { text: "Friend's Goal", icon: 'mdi-account-multiple ' , link:'/share/list'},
                { text: 'User Settings', icon: 'mdi-account-cog', link:'/userSettings'}
            ],
            loginDialog : false,
            signUpDialog : false
        }
    },
    created:function(){
        this.checkAuth();
    },
    methods:{
        checkAuth(){
            axios.get('/api/check')
                .then((res) => {
                    if(res.data.message === "true"){
                        this.isLoggedIn = true;
                        this.getUserData();
                    }
                    else{
                        this.isLoggedIn = false;
                    }

                })
                .catch((err) => {
                    this.isLoggedIn = false;
                })
        },
        getUserData(){
            axios.get('/api/user')
                .then((res) => {
                    this.userInfo = res.data
                })
        },
        logout() {
            this.isLoggedIn = false;
            axios.get('/api/logout')
                .then((res) => {
                    this.userInfo = []
                    this.$router.push('/')
            })
        },
        showAlert(message){
            // messageの構成
            this.alert.isShow = true;
            this.alert.message = message;
            setTimeout(() => {
                    this.alert.isShow = false
                    this.alert.message = ""
                }
                ,5000)
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
