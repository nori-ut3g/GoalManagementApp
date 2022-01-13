<template>
    <v-row>
        <!--        未着手-->
        <v-col cols="12">
            <v-card><p class="text-h4">{{objective.title}}</p></v-card>
        </v-col>
        <v-col cols="12">
            <v-card><p class="text-h4">{{objective.due_date}}まで</p></v-card>
        </v-col>

        <v-col cols="4">
            <v-card>未着手</v-card>
            <v-card
                max-width="400"
            >
                <v-container>
                    <v-row>
                        <!--                    <div v-for="(task, index) in tasks" :key="index" >-->
                        <!--                        <task-card-component  :task="task" class="my-2" ></task-card-component>-->
                        <!--                    </div>-->
                        <v-expansion-panels>
                            <v-expansion-panel
                                v-for="(task, index) in getWaitingTasks" :key="index"
                            >
                                <v-expansion-panel-header>
                                    {{task.title}}
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    {{task.contents}}
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-row>
                </v-container>
                <v-card><v-btn @click="createTask(0)">Create</v-btn></v-card>
            </v-card>
        </v-col>
        <!--        実行中-->
        <v-col cols="4">
            <v-card>実行中</v-card>
            <v-card
                max-width="400"
            >
                <v-container>
                    <v-row>
                        <!--                    <div v-for="(task, index) in tasks" :key="index" >-->
                        <!--                        <task-card-component  :task="task" class="my-2" ></task-card-component>-->
                        <!--                    </div>-->
                        <v-expansion-panels>
                            <v-expansion-panel
                                v-for="(task, index) in getWorkingTasks" :key="index"
                            >
                                <v-expansion-panel-header>
                                    {{task.title}}
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    {{task.contents}}
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-row>
                </v-container>
                <v-card><v-btn @click="createTask(1)">Create</v-btn></v-card>

            </v-card>
        </v-col>
<!--        &lt;!&ndash;        完了&ndash;&gt;-->
        <v-col cols="4">
            <v-card>完了</v-card>
            <v-card
                max-width="400"
            >
                <v-container>
                    <v-row>
                        <!--                    <div v-for="(task, index) in tasks" :key="index" >-->
                        <!--                        <task-card-component  :task="task" class="my-2" ></task-card-component>-->
                        <!--                    </div>-->
                        <v-expansion-panels>
                            <v-expansion-panel
                                v-for="(task, index) in getCompletedTasks" :key="index"
                            >
                                <v-expansion-panel-header>
                                    {{task.title}}
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    {{task.contents}}
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-row>
                </v-container>
                <v-card><v-btn @click="createTask(2)">Create</v-btn></v-card>

            </v-card>
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
            objective:[],
            objective_id : this.$route.params.id,
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
        axios.get(`/api/objective/${this.$route.params.id}`)
            .then((res) => {
                this.objective = res.data;
                console.log(this.objective)
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
    methods:{
        createTask(status){
            const sendData = {
                objective_id : this.objective_id,
                status : status,
                title: "newTask",
                contents: "newContent",
            }
            console.log(sendData)
            axios.post(`/api/objectives/${this.objective_id}/task/create`, sendData)
                .then((res) => {
                    console.log(res.data)
                    this.tasks.push(res.data.task);
                })
                .catch((error) =>{
                    console.log(error)
                })
        }
    }



}
</script>

<style scoped>

</style>
