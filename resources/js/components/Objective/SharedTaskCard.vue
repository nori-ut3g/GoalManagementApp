<template>
    <v-card
        :color="cardColor"
    >
        <v-col cols="12">
            <v-text-field
                label="Task"
                v-model="task.title"
                readonly
            ></v-text-field>
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
                    <div>
                        <v-textarea
                            label="Note"
                            v-model="task.note"
                            readonly
                            outlined
                        ></v-textarea>
                    </div>
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
