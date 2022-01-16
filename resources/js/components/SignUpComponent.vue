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
                label="UserName"
                value="nori"
                v-model="user.name"
            ></v-text-field>
        </v-col>

        <v-col cols="12">
            <v-text-field
                label="Password"
                value="password"
            ></v-text-field>
        </v-col>
        <v-col cols="12">
            <v-text-field
                label="Password(re-enter)"
                value="password"
                v-model="user.password"
            ></v-text-field>
        </v-col>
        <v-btn @click="submit">Register</v-btn>
    </v-card>
</template>

<script>
export default {
    name: "SignUpComponent",
    data: () => {
        return {
            user:{}
        }
    },
    methods: {
        submit(){
            axios.post('/api/register', this.user)
            .then((res) => {
                console.log(res.data)
            })
            .catch((error) =>{
                console.log(error)
            })
        }
    }
}
</script>

<style scoped>

</style>
