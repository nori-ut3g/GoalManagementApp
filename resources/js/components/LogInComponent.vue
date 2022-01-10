<template>
    <v-card>
        <v-col cols="12">
            <v-text-field
                label="Email Address"
                value="example@example.com"
                v-model="user.email"
            ></v-text-field>
        </v-col>
        <v-col cols="12">
            <v-text-field
                label="Password"
                value="password"

                v-model="user.password"
            ></v-text-field>
        </v-col>
        <v-btn @click="login">Login</v-btn>
    </v-card>
</template>

<script>
export default {
    name: "LogInComponent",
    data: () => {
        return {
            user:{}
        }
    },
    methods: {
        login(){
            axios.get('/sanctum/csrf-cookie')
                .then((res) => {
                    axios.post('/api/login', this.user)
                        .then((res) => {
                            console.log(res.data)
                        })
                        .catch((err) => {
                            console.log(err);
                        })
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
