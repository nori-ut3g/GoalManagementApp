<template>
<div>
    <header-component>
    </header-component>
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
