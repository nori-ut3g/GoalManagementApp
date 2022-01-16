<template>
    <div>
        <v-text-field
            v-if="isTaskTitleFieldFocus"
            @blur="taskTitleFieldOutFocus(task.title)"
            :value="task.title"
            elevation="3"
            autofocus
            width="180"
            v-model="task.title"
        ></v-text-field>
        <v-card
            v-else
            solo
            v-on:dblclick="taskTitleFieldDbClick"
            tile
            width="180"
            min-height="30"
            class="my-2"
        >
            <strong>{{task.title}}</strong>
        </v-card>
        <v-expansion-panel-header>



            {{task.start_date}}
            {{task.finish_date}}
            <br>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
            <v-menu
                v-if="task.status !== 0"
                ref="startDateMenu"
                v-model="startDateMenu"
                :close-on-content-click="false"
                :return-value.sync="startDate"
                transition="scale-transition"
                offset-y
                min-width="auto"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        v-model="startDate"
                        label="Start Date"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-date-picker
                    v-model="startDate"
                    no-title
                    scrollable
                >
                    <v-spacer></v-spacer>
                    <v-btn
                        text
                        color="primary"
                        @click="startDateMenu = false"
                    >
                        Cancel
                    </v-btn>
                    <v-btn
                        text
                        color="primary"
                        @click="setStartDate"
                    >
                        OK
                    </v-btn>
                </v-date-picker>
            </v-menu>
            <v-menu
                v-if="task.status === 2"
                ref="finishDateMenu"
                v-model="finishDateMenu"
                :close-on-content-click="false"
                :return-value.sync="finishDate"
                transition="scale-transition"
                offset-y
                min-width="auto"
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        v-model="finishDate"
                        label="Finish Date"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-date-picker
                    v-model="finishDate"
                    no-title
                    scrollable
                >
                    <v-spacer></v-spacer>
                    <v-btn
                        text
                        color="primary"
                        @click="finishDateMenu = false"
                    >
                        Cancel
                    </v-btn>
                    <v-btn
                        text
                        color="primary"
                        @click="setFinishDate"
                    >
                        OK
                    </v-btn>
                </v-date-picker>
            </v-menu>

            {{task.note}}
        </v-expansion-panel-content>

        <v-btn
            v-if="task.status === 0"
            @click="startTask"
        >
            ＞
        </v-btn>
        <v-btn
            v-if="task.status === 1"
            @click="finishTask"
        >
            ＞
        </v-btn>

    </div>
</template>

<script>
export default {
    name: "TaskCardComponent",
    props:['objectiveId', 'task'],
    data(){
        return{
            startDate: "",//(new Date(this.task.start_date)),
            startDateMenu: false,
            finishDate:"",//new Date(this.task.finish_date),
            finishDateMenu:false,

            isTaskTitleFieldFocus:false,
            isTaskContentsFieldFocus:false
        }
    },
    methods:{
        startTask(){
            axios.get(`/api/objectives/${this.objectiveId}/task/${this.task.id}/start`)
                .then((res) => {
                    this.refresh();
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        finishTask(){
            axios.get(`/api/objectives/${this.objectiveId}/task/${this.task.id}/finish`)
                .then((res) => {
                    this.refresh();
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        refresh(){
            this.$emit('refresh');
        },
        setStartDate(){
            let sendDate = {
                "date": this.startDate
            }
            axios.post(`/api/objectives/${this.objectiveId}/task/${this.task.id}/start`, sendDate)
                .then((res) => {
                    this.refresh();
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        setFinishDate(){
            let sendDate = {
                "date": this.finishDate
            }
            axios.post(`/api/objectives/${this.objectiveId}/task/${this.task.id}/finish`, sendDate)
                .then((res) => {
                    this.refresh();
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        changeTitle(title){
            let sendDate = {
                "title": title
            }
            axios.post(`/api/objectives/${this.objectiveId}/task/${this.task.id}/edit_title`, sendDate)
                .then((res) => {
                    this.refresh();
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        taskTitleFieldDbClick(){
            this.isTaskTitleFieldFocus = true;
        },
        taskContentsFieldDbClick(){
            this.isTaskContentsFieldFocus = true;
        },
        taskTitleFieldOutFocus(title){
            this.changeTitle(title);
            this.isTaskTitleFieldFocus = false;
        },
        taskContentsFieldOutFocus(){
            this.isTaskContentsFieldFocus = false;
        },


    }

}

</script>

<style scoped>

</style>
