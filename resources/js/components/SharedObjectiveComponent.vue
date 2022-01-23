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
                                    <SharedTaskCard
                                        :task="task"
                                        :card-color="cardColor.waiting"
                                    >
                                    </SharedTaskCard>
                                </v-expansion-panel>
                            </v-container>
                        </v-expansion-panels>
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
                                    <SharedTaskCard
                                        :task="task"
                                        v-on:refresh="getData"
                                        :card-color="cardColor.working"
                                    >
                                    </SharedTaskCard>
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
                                    <SharedTaskCard
                                        :task="task"
                                        v-on:refresh="getData"
                                        :card-color="cardColor.complete"
                                    >
                                    </SharedTaskCard>
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
import HeaderComponent from "./HeaderComponent";
import TaskCardComponent from "./TaskCardComponent";
import TaskSectionComponent from "./TaskSectionComponent";
import ProgressBarComponent from "./ProgressBarComponent";
import draggable from "vuedraggable";
import SharedTaskCard from "./SharedTaskCard";

export default {
    name: "SharedObjectiveComponent",
    components: {
        SharedTaskCard,
        HeaderComponent,
        TaskCardComponent,
        TaskSectionComponent,
        ProgressBarComponent,
        draggable,

    },
    data(){
        return{
            objective:[],
            sharedObjective_id : this.$route.params.id,
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
            }
        }
    },
    created:function () {
        this.getData();

    },
    methods:{
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
            axios.get(`/api/sharedObjective/${this.$route.params.id}`)
                .then((res) => {
                    console.log('aaaa')
                    console.log(res)

                    this.objective = res.data.objective
                    this.getTasks()
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        getTasks(){
            axios.get(`/api/sharedObjective/${this.$route.params.id}/tasks`)
                .then((res) => {
                    this.tasks = res.data;
                    this.divideData();
                    this.refreshCalenderEvents();
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
        getEventColor(event) {
            return event.color;
        },
        setToday(){
            this.focus = ""
        },
        next(){
            this.$refs.calendar.next()
        },
        prev(){
            this.$refs.calendar.prev()
        },




    }
}
</script>

<style scoped>

</style>
