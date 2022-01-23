<template>
    <div>
        <v-app-bar app clippedLeft flat dark color="indigo darken-3">
            <v-app-bar-nav-icon @click.stop="sideBar=!sideBar"></v-app-bar-nav-icon>
            <v-btn to="/home">Home</v-btn>

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
        <v-navigation-drawer  app clipped v-model="sideBar" dark color="">
            <v-list>
                <v-list-item>
                    <!--                            <v-list-item-avatar>-->
                    <!--                                <v-img src="https://cdn.vuetifyjs.com/images/john.png"></v-img>-->
                    <!--                            </v-list-item-avatar>-->
                </v-list-item>

                <v-list-item link>
                    <v-list-item-content>
                        <v-list-item-title class="text-h6">

                        </v-list-item-title>
                        <v-list-item-subtitle>{{userInfo.email}}</v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-action>
                        <v-icon>mdi-menu-down</v-icon>
                    </v-list-item-action>
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
            isShowAlert:false,
            items: [
                { text: 'My Files', icon: 'mdi-folder' , link:'/list'},
                { text: 'Create Objective', icon: 'mdi-folder' , link:'/create'},

            ],
            loginDialog : false,
            signUpDialog : false
        }
    },
    computed:{



    },
    created:function(){
        // this.autoLogin();
        this.checkAuth();
    },
    methods:{
        checkAuth(){
            axios.get('/api/user')
                .then((res) => {
                    this.isLoggedIn = true;
                    this.userInfo = res.data;
                })
                .catch((err) => {
                    this.isLoggedIn = false;
                    this.$router.push('/')
                    console.log(err);
                })
        },
        test(){
            console.log("AppContntがよばれた")
        },
        logout() {
            this.isLoggedIn = false;

            axios.get('/api/logout')
                .then((res) => {
                    console.log(res.data)
                    this.userInfo = []
                    this.$router.push('/')
            })

            // this.checkAuth();

        },
        showAlert(){
            this.isShowAlert = true;
            setTimeout(() => {
                    this.isShowAlert = false}
                ,3000)
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
