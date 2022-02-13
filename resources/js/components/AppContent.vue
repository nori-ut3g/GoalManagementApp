<template>
    <div id="app">
        <v-container>
            <v-main>
                <router-view
                ></router-view>
            </v-main>
        </v-container>
    </div>
</template>

<script>


export default {
    name: "AppContent",
    data() {
        return {
        }
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap');
#app {
    font-family: 'M PLUS Rounded 1c', sans-serif;
}

</style>
