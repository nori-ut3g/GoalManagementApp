<template>
    <div>
        <header-component
            ref="header"
        >

        </header-component>
        <v-main>
            <v-row>
                <v-col cols="12">
                    <v-card>
                        <v-card-title>
                            <v-btn
                                class="mx-2"
                                fab
                                small
                                v-if="!isCompletedObjective"
                                @click="achieveObjective"
                            >
                                <v-icon>
                                    mdi-flag-checkered
                                </v-icon>
                            </v-btn>
                            <div>
                                {{objective.title}}
                            </div>
                            <v-spacer></v-spacer>
                            <v-switch
                                v-model="isShared"
                                :label="isShared ? 'Share' : 'Private'"
                                @change="switchShareOrPrivate"
                            ></v-switch>
                        </v-card-title>
                        <v-card-text>
                            <v-icon>
                                mdi-calendar-range
                            </v-icon>
                            {{objective.due_date}}
                        </v-card-text>
                        <v-btn
                            class="mx-2"
                            v-if="isShared"
                            @click="openPreview"
                        >
                            preview
                            <v-icon>
                                mdi-dock-window
                            </v-icon>
                        </v-btn>


                        <v-btn
                            class="mx-2"
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
                        <v-col
                            cols="12"
                        >
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
                        </v-col>
                        <v-col
                            cols="12"
                        >
                            <v-row
                                justify="center"
                            >
                                <div
                                    v-if="$refs.calendar"
                                >
                                    {{ $refs.calendar.title }}
                                </div>
                            </v-row>
                        </v-col>

                        <v-calendar
                            ref="calendar"
                            v-model="calendarFocus"
                            :events="events"
                            :event-more="true"
                            @change="refreshCalenderEvents"
                            color="indigo lighten-4"
                        ></v-calendar>
                    </v-sheet>
                </v-col>

                <v-col cols="4">
                    <v-card color="grey lighten-4">
                        <v-card-title class="text-center">Waiting</v-card-title>
                            <v-expansion-panels>
                                <v-container>
                                    <v-expansion-panel
                                        v-for="(task, index) in card.waiting.tasks"
                                        :key="task.id"
                                        :id="task.id"
                                    >
                                        <TaskCardComponent
                                            :task="task"
                                            :objective-id="objective_id"
                                            :card-color="card.waiting.color"
                                            v-on:refresh="refresh"
                                        >
                                        </TaskCardComponent>
                                    </v-expansion-panel>
                                </v-container>
                            </v-expansion-panels>
                        <v-spacer></v-spacer>
<!--                        TODO:maxTask-->
                        <v-btn @click="createTask(0)">Create</v-btn>
                    </v-card>
                </v-col>
                <v-col cols="4">
                    <v-card color="grey lighten-4">
                        <v-card-title>Working</v-card-title>
                            <v-expansion-panels>
                                <v-container>
                                    <v-expansion-panel
                                        v-for="(task, index) in card.working.tasks"
                                        :key="task.id"
                                        :id="task.id"
                                    >
                                        <TaskCardComponent
                                            :task="task"
                                            :objective-id="objective_id"
                                            v-on:refresh="refresh"
                                            :card-color="card.working.color"
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
                                        v-for="(task, index) in card.completed.tasks"
                                        :key="task.id"
                                        :id="task.id"
                                    >
                                        <TaskCardComponent
                                            :task="task"
                                            :objective-id="objective_id"
                                            v-on:refresh="refresh"
                                            :card-color="card.completed.color"
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
import TaskCardComponent from "./TaskCardComponent";
import HeaderComponent from "../Header/HeaderComponent";
export default {
    name: "ObjectiveContentComponent",
    components: {
        HeaderComponent,
        TaskCardComponent,
    },
    data(){
        return{
            objective:[],
            objective_id : this.$route.params.id,
            tasks:[],

            card:{
                waiting:{
                    tasks:[],
                    color:"blue lighten-5",
                },
                working:{
                    tasks:[],
                    color:"purple lighten-5",
                },
                completed:{
                    tasks:[],
                    color:"indigo lighten-5",
                }
            },
            calendar:{
                working:{
                    color:"purple lighten-2",
                },
                completed:{
                    color:"indigo lighten-2",
                }
            },

            events:[],

            calendarFocus: '',
            isShared: false,
            sharedID:"",

            isCompletedObjective:false,


        }
    },
    created:function () {
        this.getData();

    },
    computed:{
        twitterShareURL(){
            return "https://twitter.com/intent/tweet?url="+ "https://manage-goals.com/share/objective/" + this.sharedID + "&text=GoalManagementApp&hashtags=portfolio";
        },
        shareURL(){
            return "localhost/share/objective/" + this.sharedID;
            // return "https://manage-goals.com/share/objective/" + this.sharedID;
        }
    },
    methods:{
        createTask(status){
            const sendData = {
                objective_id : this.objective_id,
                status : status,
                title: "",
                note: "",
            }
            axios.post(`/api/objectives/${this.objective_id}/task/create`, sendData)
                .then((res) => {
                    switch (res.data.task.status){
                        case 0:
                            this.card.waiting.tasks.push(res.data.task);
                            break;
                        case 1:
                            this.card.working.tasks.push(res.data.task);
                            break;
                        case 2:
                            this.card.completed.tasks.push(res.data.task);
                            break;
                        default:
                            break;
                    }
                    this.tasks.push(res.data.task);
                })
                .catch((err) =>{
                    this.alert(err.response.data.message);
                })
        },
        divideData(){
            this.card.waiting.tasks = this.tasks.filter(function(task){
                return task.status === 0;
            })
            this.card.working.tasks = this.tasks.filter(function(task){
                return task.status === 1;
            })
            this.card.completed.tasks = this.tasks.filter(function(task){
                return task.status === 2;
            })
        },
        getData(){

            axios.get(`/api/objectives/${this.$route.params.id}`)
                .then((res) => {
                    this.objective = res.data;
                    this.isCompletedObjective = this.objective.status !== 0
                })
                .catch((error) =>{
                })
            axios.get(`/api/objectives/${this.$route.params.id}/tasks`)
                .then((res) => {
                    this.tasks = res.data;
                    this.divideData();
                    this.refreshCalenderEvents()
                })
                .catch((error) =>{
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
                    color: task.status === 1 ? this.calendar.working.color : this.calendar.completed.color ,
                    timed: false
                })
            }
            this.events = events;

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
                })
        },
        finishTask(taskId){
            axios.get(`/api/objectives/${this.objective_id}/task/${taskId}/finish`)
                .then((res) => {
                    this.getData();
                    this.refreshCalenderEvents()
                })
                .catch((error) =>{
                })
        },
        refresh(){
            this.getData();
            this.divideData()
            this.refreshCalenderEvents()
        },
        setToday(){
            this.calendarFocus = date
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
                    this.sharedID = res.data.id;
                    this.isShared = true;
                })
                .catch((error) =>{
                })
        },
        private(){
            axios.delete(`/api/objectives/private/${this.objective_id}`)
                .then((res) => {
                    this.sharedID = "";
                    this.isShared = false;
                })
                .catch((error) =>{
                })
        },
        openPreview(){
            // window.open("https://manage-goals.com/share/objective/" + this.sharedID,'_blank')
            window.open("/share/objective/" + this.sharedID,'_blank')
        },
        achieveObjective(){
            if (confirm('目標を達成しますか？')){
                axios.get(`/api/objectives/${this.objective_id}/finish`)
                    .then((res) => {
                        this.isCompletedObjective = true;
                        this.refresh();
                    })
                    .catch((error) =>{
                    })
            }
        },
        alert(message){
            this.$refs.header.showAlert(message);
        },
        changeStartDate(){
            let sendDate = {
                "objective_id":this.objective_id,
                "start_date": this.objective.start_date
            }
            axios.put(`/api/objectives/update_start_date`, sendDate)
                .then((res) => {
                    this.startDateMenu = false;
                    this.refresh();
                })
                .catch(() =>{
                })
        },
        changeFinishDate(){
            let sendDate = {
                "objective_id":this.objective_id,
                "due_date": this.objective.due_date
            }
            axios.put(`/api/objectives/update_due_date`, sendDate)
                .then((res) => {
                    this.dueDateMenu = false;
                    this.refresh();
                })
                .catch((error) =>{
                })
        }
    }



}
</script>

<style scoped>

</style>
