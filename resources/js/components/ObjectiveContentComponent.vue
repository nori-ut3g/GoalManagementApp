<template>
    <v-row>
<!--        未着手-->
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
                                    ここにコンテンツ内容が入る
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
                                v-for="(item,i) in 5"
                                :key="i"
                            >
                                <v-expansion-panel-header>
                                    Item
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-row>
                </v-container>
            </v-card>
        </v-col>
<!--        完了-->
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
                                v-for="(item,i) in 5"
                                :key="i"
                            >
                                <v-expansion-panel-header>
                                    Item
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-row>
                </v-container>
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
                title: "testtitle",
                contents: "testcontent",
            }
            console.log(sendData)
            axios.post(`/api/objectives/${this.objective_id}/task/create`, sendData)
                .then((res) => {
                    console.log(res.data)
                    this.tasks.push(res.data.task);
                })
                .catch((error) =>{
                    console.log(error.data)
                })
        }
    }



}
</script>

<style scoped>

</style>
