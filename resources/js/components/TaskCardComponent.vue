<template>
    <v-col cols="12">
        <v-card
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
                        <strong>{{task.title}}</strong>
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
    </v-col>
</template>

<script>
export default {
    name: "TaskCardComponent",
    props:['task'],

}

</script>

<style scoped>

</style>
