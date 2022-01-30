<template>
    <div>
        <v-col cols="12">
            <v-text-field
                label="UserName"
                hint="20文字以内で入力してください。"
                v-model="user.name"
                counter="20"
            ></v-text-field>
        </v-col>
        <v-col cols="12">
            <v-text-field
                label="Email Address"
                v-model="user.email"
            ></v-text-field>

        </v-col>
        <v-col cols="12">
            <v-text-field
                label="Password"
                hint="8文字以上で入力してください"
                v-model="user.password"
                :type="show.password ? 'text' : 'password'"
                :append-icon="show.password ? 'mdi-eye' : 'mdi-eye-off'"
                @click:append="show.password = !show.password"
            ></v-text-field>
        </v-col>
        <v-divider></v-divider>
        <v-card-actions>
            <v-btn @click="cancel">Cancel</v-btn>
            <v-spacer></v-spacer>
            <v-btn @click="submit">Sign Up</v-btn>
        </v-card-actions>

    </div>
</template>

<script>
export default {
    name: "SignUpComponent",
    data: () => {
        return {
            user:{
                name:"",
                email:"",
                password:""
            },
            show:{
                password:false
            }
        }
    },

    methods: {
        submit(){
            axios.post('/api/register', this.user)
            .then((res) => {
                this.login()
            })
            .catch((err) =>{
                this.showAlert(err.response.data.message);
            })
        },
        login(){
            axios.post('/api/login', this.user)
                .then((res) => {
                    this.$router.push('/home')
                })
                .catch((err) =>{
                    this.showAlert(err.response.data.message);
                })
        },
        cancel(){
            this.user.name="";
            this.user.email="";
            this.user.password="";
            this.$emit('parent-cancel')
        },
        showAlert(message){
            this.$emit('alert', message)
        }
    }
}
</script>

<style scoped>

</style>
