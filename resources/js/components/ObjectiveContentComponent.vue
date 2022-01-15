<template>
    <v-row>
        <!--        未着手-->
        <v-col cols="12">
            <v-card><p class="text-h4">{{objective.title}}</p></v-card>
        </v-col>
        <v-col cols="12">
            <v-card><p class="text-h4">{{objective.due_date}}まで</p></v-card>
        </v-col>

        <v-col cols="12">
            <v-sheet height="600">
                <v-calendar
                    ref="calendar"
                    :events="events"
                    @change="refreshCalenderEvents"
                ></v-calendar>
            </v-sheet>
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
                                        v-for="(task, index) in waitingTasks"
                                        :key="task.id"
                                        :id="task.id"
                                    >
                                        <v-expansion-panel-header>
                                            {{task.title}} + {{task.id}}
                                        </v-expansion-panel-header>
                                        <v-expansion-panel-content>
                                            {{task.contents}}
                                            start
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
                                    v-for="(task, index) in workingTasks"
                                    :key="task.id"
                                    :id="task.id"
                                >
                                        <v-expansion-panel-header>
                                            {{task.title}} + {{task.id}}
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
                                    v-for="(task, index) in completedTasks"
                                    :key="task.id"
                                    :id="task.id"
                                    >
                                        <v-expansion-panel-header>
                                            {{task.title}} + {{task.id}}
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
import draggable from 'vuedraggable'

import ProgressBarComponent from "./ProgressBarComponent";
import TaskSectionComponent from "./TaskSectionComponent";
export default {
    name: "ObjectiveContentComponent",
    components: {
        TaskSectionComponent,
        ProgressBarComponent,
        draggable,

    },
    data(){
        return{
            objective:[],
            objective_id : this.$route.params.id,
            tasks:[],
            waitingTasks:[],
            workingTasks:[],
            completedTasks:[],
            events:[],
            tempDate:"" //test用
        }
    },
    created:function () {
        this.getData();

    },
    computed:{

    },
    methods:{
        createTask(status){
            const sendData = {
                objective_id : this.objective_id,
                status : status,
                title: "newTask",
                contents: "newContent",
            }
            axios.post(`/api/objectives/${this.objective_id}/task/create`, sendData)
                .then((res) => {
                    console.log(res.data)
                    switch (res.data.task.status){
                        case 0:
                            this.waitingTasks.push(res.data.task);
                            break;
                        case 1:
                            this.workingTasks.push(res.data.task);
                            break;
                        case 2:
                            this.completedTasks.push(res.data.task);
                            break;
                        default:
                            break;
                    }
                    this.tasks.push(res.data.task);
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        divideData(){
            this.waitingTasks = this.tasks.filter(function(task){
                return task.status === 0;
            })
            this.workingTasks = this.tasks.filter(function(task){
                return task.status === 1;
            })
            this.completedTasks = this.tasks.filter(function(task){
                return task.status === 2;
            })
        },
        getData(){
            axios.get(`/api/objectives/${this.$route.params.id}/tasks`)
                .then((res) => {
                    this.tasks = res.data;

                    this.divideData();
                    this.refreshCalenderEvents()
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
        refreshCalenderEvents(){
            let events = []
            for(const task of this.tasks){

                console.log(task.id)
                if(task.start_date === null) continue;
                let finish_date;
                if(task.finish_date === null) finish_date = new Date().toISOString().split("T")[0].replaceAll("-", "/");
                else finish_date = task.finish_date;

                console.log(task.start_date)
                console.log(task.finish_date)
                events.push({
                    name: task.title,
                    start: new Date(task.start_date),
                    end: new Date(finish_date),
                    color: task.status === 1 ? 'green' : 'blue' ,
                    timed: true,
                })
            }
            this.events = events;

        },
        setStartDate(taskId, startDate){
            let sendDate = {
                "date": startDate
            }
            axios.post(`/api/objectives/${this.objective_id}/task/${taskId}/start`, sendDate)
                .then((res) => {
                    console.log(res)
                    this.getData();
                    this.refreshCalenderEvents()
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        setFinishDate(taskId, endDate){
            let sendDate = {
                "date": endDate
            }
            axios.post(`/api/objectives/${this.objective_id}/task/${taskId}/finish`, sendDate)
                .then((res) => {
                    console.log(res)
                    this.getData();
                    this.refreshCalenderEvents()
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        getEventColor(event) {
            return event.color;
        },
        startDate(taskId){
            axios.get(`/api/objectives/${this.objective_id}/task/${taskId}/start`)
                .then((res) => {
                    console.log(res)
                    this.getData();
                    this.refreshCalenderEvents()
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        finishDate(taskId){
            axios.get(`/api/objectives/${this.objective_id}/task/${taskId}/finish`)
                .then((res) => {
                    console.log(res)
                    this.getData();
                    this.refreshCalenderEvents()
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        onEnd(event){
            if(event.from === event.to){
                console.log("同じやつ")
                return
            }

            let task = this.tasks.find(task => task.id === Number(event.item.id));
            if(task.status === 0){
                this.startDate()
            }else if(task.status === 1){

            }else{

            }




            // let from = e.from.name;
            // let to = e.to.name;
            // let now =  new Date(now).toISOString().split("T")[0].replaceAll("-", "/");
            // //移動元
            // if(from === "waitingTasks" && to === "workingTasks"){
            //     this.setStartDate()
            // }
            // //移動先がWorkingTaskListなら、Startを更新（
            // e.to
        }
    }



}
</script>

<style scoped>

</style>
