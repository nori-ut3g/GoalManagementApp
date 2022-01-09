<template>
    <v-card>
        <v-col cols="12">
            <v-text-field
                label="Email Address"
                value="example@example.com"
            ></v-text-field>
        </v-col>
        <v-col cols="12">
            <v-text-field
                label="UserName"
                value="nori"
            ></v-text-field>
        </v-col>
        <v-col cols="12">
            <v-text-field
                label="Password(re-enter)"
                value="password"
            ></v-text-field>
        </v-col>
        <v-col cols="12">
            <v-text-field
                label="Password"
                value="password"
            ></v-text-field>
        </v-col>

    </v-card>
</template>

<script>
export default {
    name: "SignUpComponent"
}
</script>

<style scoped>

</style>
