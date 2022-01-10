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
        <v-btn @click="submit">Register</v-btn>
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
        submit(){
            axios.post('/api/login', this.user)
                .then((res) => {
                    console.log(res.data)
                })
        }
    }
}
</script>

<style scoped>

</style>
