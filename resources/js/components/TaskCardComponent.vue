<template>
    <v-app>
        <v-card
            elevation="3"
            tile
            width="200"
            color="#385F73"
        >
            <v-container>
                <div>
                    <v-card
                        solo
                        tile
                        width="180"
                        min-height="30"
                        class="my-2"
                    >
                        <strong>TaskName</strong>
                    </v-card>
                </div>


                <div class="text-right">
                    <v-icon> mdi-note </v-icon>
                    <v-icon> mdi-check-bold</v-icon>
                    <v-icon> mdi-star</v-icon>
                    <v-icon> mdi-delete</v-icon>
                </div>
            </v-container>
        </v-card>

    </v-app>
</template>

<script>
export default {
    name: "TaskCardComponent"
}

</script>

<style scoped>

</style>
