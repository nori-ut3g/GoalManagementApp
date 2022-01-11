<template>
    <v-row>
<!--        未着手-->
        <v-col cols="4">
            <v-card>未着手</v-card>
            <task-section-component
                :tasks="getWaitingTasks"
            ></task-section-component>
        </v-col>
<!--        実行中-->
        <v-col cols="4">
            <v-card>実行中</v-card>
            <task-section-component
                :tasks="getWorkingTasks"
            ></task-section-component>
        </v-col>
<!--        完了-->
        <v-col cols="4">
            <v-card>完了</v-card>
            <task-section-component
                :tasks="getCompletedTasks"
            ></task-section-component>
        </v-col>

    </v-row>

</template>

<script>
import ProgressBarComponent from "./ProgressBarComponent";
import TaskSectionComponent from "./TaskSectionComponent";
export default {
    name: "ObjectiveContentComponent",
    components: {TaskSectionComponent, ProgressBarComponent},
    data(){
        return{
            tasks:[]
        }
    },
    created:function () {
        //console.log(this.$route.params.id)
        axios.get(`/api/objectives/${this.$route.params.id}/tasks`)
        .then((res) => {
            this.tasks = res.data;
        })
        .catch((error) =>{
            console.log(error)
        })
    },
    computed:{
        getWaitingTasks(){
            return this.tasks.filter(function(task){
                return task.status === 0;
            })
        },
        getWorkingTasks(){
            return this.tasks.filter(function(task){
                return task.status === 1;
            })
        },
        getCompletedTasks(){
            return this.tasks.filter(function(task){
                return task.status === 2;
            })
        },

    },


}
</script>

<style scoped>

</style>
