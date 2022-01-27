<template>
    <div>
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
        <v-divider></v-divider>
        <v-card-actions>
            <v-btn @click="cancel">Cancel</v-btn>
            <v-spacer></v-spacer>
            <v-btn @click="login">Login</v-btn>
        </v-card-actions>
    </div>
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
            axios.post('/api/login', this.user)
                .then((res) => {
                    console.log(res.data)
                    this.$router.push('/home')
                })
                .catch((err) => {
                    // console.log(err);
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
