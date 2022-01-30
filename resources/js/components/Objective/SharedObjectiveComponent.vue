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
                                    <SharedTaskCard
                                        :task="task"
                                        :card-color="card.waiting.color"
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
                                    v-for="(task, index) in card.working.tasks"
                                    :key="task.id"
                                    :id="task.id"
                                >
                                    <SharedTaskCard
                                        :task="task"
                                        v-on:refresh="getData"
                                        :card-color="card.working.color"
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
                                    v-for="(task, index) in card.completed.tasks"
                                    :key="task.id"
                                    :id="task.id"
                                >
                                    <SharedTaskCard
                                        :task="task"
                                        v-on:refresh="getData"
                                        :card-color="card.completed.color"
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
import HeaderComponent from "../Header/HeaderComponent";
import TaskCardComponent from "./TaskCardComponent";
import SharedTaskCard from "./SharedTaskCard";

export default {
    name: "SharedObjectiveComponent",
    components: {
        SharedTaskCard,
        HeaderComponent,
        TaskCardComponent,

    },
    data(){
        return{
            objective:[],
            sharedObjective_id : this.$route.params.id,
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
            tempDate:"", //test用,
            focus: '',
            isShared: false,
            sharedID:"",
        }
    },
    created:function () {
        this.getData();

    },
    methods:{
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
            axios.get(`/api/sharedObjective/${this.$route.params.id}`)
                .then((res) => {
                    this.objective = res.data.objective
                    this.getTasks()
                })
                .catch((error) =>{
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
