<template>
    <div class="py-2">
        <v-card mt-2 pt-2
            elevation="3"
            tile
            color="#385F73"
        >
            <v-container>
                <div>
                    <v-card
                        solo
                        tile
                        min-height="30"
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
    </div>
</template>

<script>
export default {
    name: "TaskCardComponent"
}

</script>

<style scoped>

</style>
