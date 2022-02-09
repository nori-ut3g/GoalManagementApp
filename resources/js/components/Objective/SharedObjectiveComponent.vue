<template>
    <div>
<!--        Header-->
        <header-component>
        </header-component>

<!--        Main-->
        <v-main>
            <v-row>
<!--                Objective Card Section-->
                <v-col cols="12">
                    <v-card>

<!--                        Objective Title-->
                        <v-card-title>
                            <v-icon>
                                mdi-flag-checkered
                            </v-icon>
                            {{objective.title}}
                        </v-card-title>

<!--                        Due Date-->
                        <v-card-text>
                            <v-icon>
                                mdi-calendar-range
                            </v-icon>
                            {{objective.due_date}}
                        </v-card-text>

<!--                        Import Btn-->
                        <v-btn
                            v-if="loggingIn"
                            @click="dialog.show = true"
                        >
                            Import
                            <v-icon>
                                mdi-cloud-upload
                            </v-icon>
                        </v-btn>

<!--                        Setting Import Objective-->
                        <v-dialog
                            v-model="dialog.show"
                            width="500"
                        >
                            <v-card>
                                <v-card-title class="text-h5 grey lighten-2">
                                    Import Setting
                                </v-card-title>

                                <v-text-field
                                    v-model="dialog.newTitle"
                                    :value="dialog.newTitle"
                                    required
                                    class="mx-5"
                                    clearable
                                ></v-text-field>

                                <v-menu
                                    ref="menu"
                                    v-model="dialog.dueDatePicker"
                                    :close-on-content-click="false"
                                    :return-value.sync="dialog.newDueDate"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="auto"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            v-model="dialog.newDueDate"
                                            label="Due Date"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="dialog.newDueDate"
                                        no-title
                                        scrollable
                                        :min="dialog.today"
                                    >
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            text
                                            color="primary"
                                            @click="dialog.dueDatePicker = false"
                                        >
                                            Cancel
                                        </v-btn>
                                        <v-btn
                                            text
                                            color="primary"
                                            @click="$refs.menu.save(dialog.newDueDate)"
                                        >
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-menu>
                                <v-divider></v-divider>
                                <v-card-actions>
                                    <v-btn
                                        text
                                    >
                                        Cancel
                                    </v-btn>
                                    <v-spacer></v-spacer>

                                    <v-btn
                                        color="primary"
                                        text
                                        @click="importObjective"
                                    >
                                        Import
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>

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
            loggingIn:false,
            dialog:{
                show:false,
                dueDatePicker:false,
                newTitle:'',
                newDueDate:'',
                today:new Date().toISOString().split("T")[0]
            },

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
        this.checkLoggingIn();
        this.getData();
    },
    methods:{
        preSetNewObjectiveTitle(){
            this.dialog.newTitle = this.objective.title;
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
            axios.get(`/api/sharedObjective/${this.$route.params.id}`)
                .then((res) => {
                    this.objective = res.data.objective
                    this.preSetNewObjectiveTitle();
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
        checkLoggingIn(){
            console.log('aaaaa')
            axios.get(`/api/check`)
            .then((res)=>{
                if(res.data.message === "true") this.loggingIn = true;
            })
        },
        importObjective(){
            let sendData = {
                title : this.dialog.newTitle,
                due_date: this.dialog.newDueDate,
                start_date: new Date().toISOString().split("T")[0].replaceAll("-", "/")
            }

            axios.post('/api/objectives/create', sendData)
                .then((res) => {
                    this.importTasks(res.data.objective_id)
                })
                .catch((err) =>{
                    this.alert(err.response.data.message);
                })
        },
        importTasks(objective_id){


            let sendData = {

                objective_id: objective_id,
                tasks : this.tasks,
            }
            axios.post('/api/objectives/task/multipleCreate', sendData)
                .then((res) => {
                    console.log(res.data)
                    this.$router.push(`/objective/${objective_id}`);
                })
                .catch((err) =>{
                    this.alert(err.response.data.message);
                })

        }




    }
}
</script>

<style scoped>

</style>
