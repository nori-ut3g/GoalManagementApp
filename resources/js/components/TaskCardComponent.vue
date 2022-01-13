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
                        <strong>{{task.title}}</strong>
                        <strong>{{task.title}}</strong>
                        <strong>{{task.title}}</strong>
                    </v-card>
                </div>



            </v-container>
        </v-card>
    </v-col>
</template>

<script>
export default {
    name: "TaskCardComponent",
    props:['task'],
    methods:{
        create(){

        },


    }

}

</script>

<style scoped>

</style>
