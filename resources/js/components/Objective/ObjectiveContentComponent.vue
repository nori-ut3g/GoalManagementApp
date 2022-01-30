<template>
    <div>
        <header-component>

        </header-component>
        <v-main>
            <v-row>
                <v-col cols="12">
                    <v-card>
                        <v-card-title>
                            <v-icon>
                                mdi-flag-checkered
                            </v-icon>
                            {{objective.title}}
                        </v-card-title>
                        <v-card-text>
                            <v-icon>
                                mdi-calendar-range
                            </v-icon>
                            {{objective.due_date}}
                        </v-card-text>
                            <v-switch
                                v-model="isShared"
                                :label="isShared ? 'Share' : 'Private'"
                                @change="switchShareOrPrivate"
                            ></v-switch>
                        <v-btn
                            :to="shareURL"
                            v-if="isShared"
                        >
                            {{"manage-goals.com" + "/#/share/objective/" + sharedID }}
                        </v-btn>

                        <v-btn
                                    color="#1DA1F2"
                                    :href="twitterShareURL"
                                    v-if="isShared"
                                >
                                    <v-icon
                                        left
                                        color="white"
                                        small
                                    >
                                        mdi-twitter
                                    </v-icon>
                                    <span>share</span>
                                </v-btn>

                    </v-card>
                </v-col>

                <v-col cols="12">
                    <v-sheet>
                        <v-btn
                            fab
                            text
                            small
                            color="grey darken-2"
                            @click="prev"
                        >
                            <v-icon small>
                                mdi-chevron-left
                            </v-icon>
                        </v-btn>
                        <v-btn
                            outlined
                            class="mr-4"
                            color="grey darken-2"
                            @click="setToday"
                        >
                            Today
                        </v-btn>

                        <v-btn
                            fab
                            text
                            small
                            color="grey darken-2"
                            @click="next"
                        >
                            <v-icon small>
                                mdi-chevron-right
                            </v-icon>
                        </v-btn>
                        <v-calendar
                            ref="calendar"
                            v-model="focus"
                            :events="events"
                            :event-more="true"
                            @change="refreshCalenderEvents"
                            color="green"
                        ></v-calendar>
                    </v-sheet>
                </v-col>

                <v-col cols="4">
                    <v-card color="grey lighten-4">
                        <v-card-title class="text-center">Waiting</v-card-title>
                            <v-expansion-panels>
                                <v-container>
                                    <v-expansion-panel
                                        v-for="(task, index) in waitingTasks"
                                        :key="task.id"
                                        :id="task.id"
                                    >
                                        <TaskCardComponent
                                            :task="task"
                                            :objective-id="objective_id"
                                            :card-color="cardColor.waiting"
                                            v-on:refresh="refresh"
                                        >
                                        </TaskCardComponent>
                                    </v-expansion-panel>
                                </v-container>
                            </v-expansion-panels>
                        <v-spacer></v-spacer>
                        <v-btn @click="createTask(0)">Create</v-btn>
                    </v-card>
                </v-col>
                <v-col cols="4">
                    <v-card color="grey lighten-4">
                        <v-card-title>Working</v-card-title>
                            <v-expansion-panels>
                                <v-container>
                                    <v-expansion-panel
                                        v-for="(task, index) in workingTasks"
                                        :key="task.id"
                                        :id="task.id"
                                    >
                                        <TaskCardComponent
                                            :task="task"
                                            :objective-id="objective_id"
                                            v-on:refresh="refresh"
                                            :card-color="cardColor.working"
                                        >
                                        </TaskCardComponent>
                                    </v-expansion-panel>
                                </v-container>
                            </v-expansion-panels>
                    </v-card>
                </v-col>
                <v-col cols="4">
                    <v-card  color="grey lighten-4">
                        <v-card-title>Complete</v-card-title>
                            <v-expansion-panels>
                                <v-container>
                                    <v-expansion-panel
                                        v-for="(task, index) in completedTasks"
                                        :key="task.id"
                                        :id="task.id"
                                    >
                                        <TaskCardComponent
                                            :task="task"
                                            :objective-id="objective_id"
                                            v-on:refresh="refresh"
                                            :card-color="cardColor.complete"
                                        >
                                        </TaskCardComponent>
                                    </v-expansion-panel>
                                </v-container>
                            </v-expansion-panels>
                    </v-card>
                </v-col>
            </v-row>
        </v-main>
    </div>

</template>

<script>
import TaskSectionComponent from "./TaskSectionComponent";
import TaskCardComponent from "./TaskCardComponent";
import HeaderComponent from "../Header/HeaderComponent";
export default {
    name: "ObjectiveContentComponent",
    components: {
        HeaderComponent,
        TaskCardComponent,
        TaskSectionComponent,

    },
    data(){
        return{
            objective:[],
            objective_id : this.$route.params.id,
            tasks:[],
            waitingTasks:[],
            workingTasks:[],
            completedTasks:[],
            eachTasks:{
                waiting:[],
                working:[],
                complete:[]
            },
            events:[],
            tempDate:"", //test用,
            focus: '',
            isShared: false,
            sharedID:"",
            cardColor:{
                waiting:"blue lighten-5",
                working:"red lighten-5",
                complete:"green lighten-5"
            },
        }
    },
    created:function () {
        this.getData();

    },
    computed:{
        twitterShareURL(){

            return "https://twitter.com/intent/tweet?url="+ "manage-goals.com" + "/#/share/objective/" + this.sharedID + "&text=GoalManagementApp&hashtags=portfolio";
        },
        shareURL(){
            return "/share/objective/" + this.sharedID;
        }
    },
    methods:{
        createTask(status){
            const sendData = {
                objective_id : this.objective_id,
                status : status,
                title: "",
                note: "newContent",
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
            axios.get(`/api/objectives/${this.$route.params.id}`)
                .then((res) => {
                    this.objective = res.data;
                })
                .catch((error) =>{
                    console.log(error)
                })
            axios.get(`/api/objectives/shared_id/${this.$route.params.id}`)
                .then((res) => {
                    let sharedObjective = res.data.shared_objective;

                    if(sharedObjective){
                        this.isShared = true;
                        this.sharedID = sharedObjective.id;
                    }else{
                        this.isShared = false;
                        this.sharedID = "";
                    }
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        refreshCalenderEvents(){
            let events = []
            for(const task of this.tasks){

                if(task.start_date === null) continue;
                let finish_date;
                if(task.finish_date === null) finish_date = new Date().toISOString().split("T")[0].replaceAll("-", "/");
                else finish_date = task.finish_date;

                events.push({
                    name: task.title,
                    start: new Date(task.start_date),
                    end: new Date(finish_date),
                    color: task.status === 1 ? 'warning' : 'green' ,
                    timed: false
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
        startTask(taskId){
            axios.get(`/api/objectives/${this.objective_id}/task/${taskId}/start`)
                .then((res) => {
                    this.getData();
                    this.refreshCalenderEvents()
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        finishTask(taskId){
            axios.get(`/api/objectives/${this.objective_id}/task/${taskId}/finish`)
                .then((res) => {
                    this.getData();
                    this.refreshCalenderEvents()
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        resetFinishDate(){

        },
        resetStartDate(){

        },
        refresh(){
            this.getData();
            this.divideData()
            this.refreshCalenderEvents()
        },
        setToday(){
            this.focus = date
        },
        next(){
            this.$refs.calendar.next()
        },
        prev(){
            this.$refs.calendar.prev()
        },
        switchShareOrPrivate(){
            if(this.isShared){
                this.share();

            }else{
                this.private()
            }
        },


        share(){

            let sendData = {
                objective_id : this.objective_id
            }
            axios.post(`/api/objectives/share`, sendData)
                .then((res) => {
                    console.log(res)
                    this.sharedID = res.data.id;
                    this.isShared = true;
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        private(){

            axios.delete(`/api/objectives/private/${this.objective_id}`)
                .then((res) => {
                    this.sharedID = "";
                    this.isShared = false;
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
