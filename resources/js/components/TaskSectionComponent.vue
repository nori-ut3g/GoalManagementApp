<template>
    <div>
        <v-card
            max-width="400"
        >
            <v-container >
                <v-row>
                    <div v-for="(task, index) in tasks" :key="index" >
                        <task-card-component  :task="task" class="my-2" ></task-card-component>
                    </div>
                </v-row>
            </v-container>
        </v-card>
    </div>

</template>

<script>
import TaskCardComponent from "./TaskCardComponent";
export default {
    name: "TaskSectionComponent",
    components: {TaskCardComponent},
    props: ['tasks'],
    data(){
        return{
            tasks:[]
        }
    }
}
</script>

<style scoped>

</style>
