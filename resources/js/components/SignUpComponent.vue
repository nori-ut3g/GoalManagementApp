<template>
    <div>
        <v-col cols="12">
            <v-text-field
                label="UserName"
                hint="Name must be at least 4 characters."
                v-model="user.name"
            ></v-text-field>
        </v-col>

        <v-col cols="12">
            <v-text-field
                label="Password"
                hint="Password must be at least 8 characters."
                v-model="user.password"

            ></v-text-field>
        </v-col>

        <v-col cols="12">
            <v-text-field
                label="Email Address"
                v-model="user.email"
                :error="error.email"
                :error-messages="errorMessage.email"
                @change="isAvailableEmail"
            ></v-text-field>

        </v-col>
        <v-divider></v-divider>
        <v-card-actions>
            <v-btn @click="cancel">Cancel</v-btn>
            <v-spacer></v-spacer>
            <v-btn @click="submit">Register</v-btn>
        </v-card-actions>

    </div>
</template>

<script>
export default {
    name: "SignUpComponent",
    data: () => {
        return {
            user:{},
            errorMessage:{
                    email:"",
                    name:"",
                    password:""
            },
            error:{
                email:false
            },
        }
    },
    created() {

    },
    computed:{

    },
    methods: {
        submit(){
            axios.post('/api/register', this.user)
            .then((res) => {
                console.log(res.data)

                this.login()
            })
            .catch((error) =>{

            })
        },
        login(){
            console.log(this.user)
            axios.post('/api/login', this.user)
                .then((res) => {
                    console.log(res.data)
                    this.$router.push('/home')
                })
                .catch((error) =>{
                })
        },
        isAvailableEmail(){
            let sendData = {
                email:this.user.email
            }
            axios.post('/api/email_validator', sendData)
                    .then((res) => {
                        this.error.email = false;
                        this.errorMessage.email = "";
                    })
                    .catch((err) => {
                        console.log(err.response.data.email[0])
                        this.error.email = true;
                        this.errorMessage.email = err.response.data.email[0];
                    })
        },
        cancel(){
            this.$emit('parent-cancel')
        }

    }
}
</script>

<style scoped>

</style>
