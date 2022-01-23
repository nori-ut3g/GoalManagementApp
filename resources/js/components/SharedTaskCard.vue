<template>
    <v-card
        :color="cardColor"
    >
        <v-col cols="12">
            <v-card
                solo
                tile
                min-height="30"
                class="my-2"
            >
                <v-card-title>
                    {{task.title}}
                </v-card-title>
            </v-card>
            <v-btn
                icon
                @click="show = !show"
            >
                <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
            </v-btn>
        </v-col>
        <v-col cols="12">

            <v-expand-transition>
                <div v-show="show">
                    <v-card>
                        <div>
                            <v-card-text
                            >
                                {{task.note}}
                            </v-card-text>
                        </div>
                    </v-card>
                </div>
            </v-expand-transition>
        </v-col>
                    </v-card>
</template>

<script>
export default {
    name: "SharedTaskCard",
    props:['task',  'cardColor'],
    data(){
        return{
            show: false
        }

    }

}
</script>

<style scoped>

</style>
