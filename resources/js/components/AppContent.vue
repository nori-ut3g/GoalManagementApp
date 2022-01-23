<template>
    <div>
        <v-container>
            <router-view
            ></router-view>
        </v-container>
    </div>
</template>

<script>
import TaskSectionComponent from "./TaskSectionComponent";
import ProgressBarComponent from "./ProgressBarComponent";
import ObjectiveContentComponent from "./ObjectiveContentComponent";
import ObjectiveTableComponent from "./ObjectiveTableComponent";
import SignUpComponent from "./SignUpComponent";
import LogInComponent from "./LogInComponent";

export default {
    name: "ObjectiveBodyComponent",
    components: {
        LogInComponent,
        SignUpComponent,
        ObjectiveTableComponent,
        ObjectiveContentComponent,
        ProgressBarComponent,
        TaskSectionComponent,},
    data() {
        return {
        }
    },
    computed:{



    },
    created:function(){
        // this.autoLogin();
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
                    console.log(err);
                })
        },
        test(){
          console.log("AppContntがよばれた")
        },
        logout() {
            this.isLoggedIn = true;
            console.log("logout")
            axios.get('/api/logout')

        },
        autoLogin(){
            axios.get('/api/user')
                .then((res) => {
                    if(!this.isLoggedIn)this.showAlert();
                    this.isLoggedIn = true;
                    this.userInfo = res.data;

                })
                .catch((err) => {
                    this.isLoggedIn = false;
                    this.$router.push('/login')
                    console.log(err);
                })

        },
        showAlert(){
            this.isShowAlert = true;
            setTimeout(() => {
                    this.isShowAlert = false}
                ,3000)
        }
    }
}
</script>

<style scoped>

</style>
