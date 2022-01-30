<template>
    <v-card
        :color="cardColor"
    >
        <v-col cols="12">
            <v-text-field
                label="Task"
                @click="task.edit = true"
                v-model="task.title"
                :readonly="!title.edit"
                @blur="taskTitleFieldOutFocus(task.title)"
            ></v-text-field>

            <v-icon
                v-if="task.status !== 0"
                @click="prev"
            >
                mdi-arrow-left-thick
            </v-icon>

            <v-icon
                v-if="task.status !== 2"
                @click="next"
            >
                mdi-arrow-right-thick
            </v-icon>

            <v-btn
                icon
                @click="show = !show"
            >
                <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
            </v-btn>
        </v-col>

        <v-col cols="12">

            <v-expand-transition>
                <div v-show="show">
                    <div>
                        <v-textarea
                            @click="note.edit = true"
                            :auto-grow="note.edit"
                            label="Note"
                            v-model="task.note"
                            :readonly="!note.edit"
                            @blur="taskNoteFieldOutFocus(task.note)"
                            outlined
                        ></v-textarea>
                    </div>

                    <v-icon
                        v-if="task.status === 2"
                        @click="datePickerDialog = true"
                    >
                        mdi-calendar-month
                    </v-icon>

                    <v-icon
                        @click="deleteTask"
                    >
                        mdi-delete
                    </v-icon>

                    <v-dialog
                        v-model="datePickerDialog"
                        width="500"
                    >
                        <v-card>
                            <v-card-title class="text-h5 grey lighten-2">
                                Date
                            </v-card-title>

                            <v-divider></v-divider>

                            <v-card-subtitle>
                                Start Date
                            </v-card-subtitle>
                            <v-card-actions>
                                <v-menu
                                    ref="start"
                                    v-model="startDateMenu"
                                    :close-on-content-click="false"
                                    :return-value.sync="task.start_date"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="auto"
                                >
                                    <template v-slot:activator="{ on, attrs }">

                                        <v-text-field
                                            v-model="task.start_date"
                                            value="task.start_date"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="task.start_date"
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
                                            @click="changeStartDate"
                                        >
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-menu>

                                <v-spacer></v-spacer>
                            </v-card-actions>

                            <v-divider></v-divider>

                            <v-card-subtitle>
                                Finish Date
                            </v-card-subtitle>
                            <v-card-actions>
                                <v-menu
                                    ref="menu"
                                    v-model="finishDateMenu"
                                    :close-on-content-click="false"
                                    :return-value.sync="task.finish_date"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="auto"
                                >
                                    <template v-slot:activator="{ on, attrs }">

                                        <v-text-field
                                            v-model="task.finish_date"
                                            value="task.finish_date"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="task.finish_date"
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
                                            @click="changeFinishDate"
                                        >
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-menu>

                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </div>
            </v-expand-transition>
        </v-col>
    </v-card>
</template>

<script>
export default {
    name: "TaskCardComponent",
    props:['objectiveId', 'task', 'cardColor'],
    data(){
        return{
            startDate: "",//(new Date(this.task.start_date)),
            startDateMenu: false,
            finishDate:"",//new Date(this.task.finish_date),
            finishDateMenu:false,

            isTaskTitleFieldFocus:false,
            isTaskNoteFieldFocus:false,
            show: false,
            datePickerDialog:false,

            title:{
                edit:false,
            },
            note:{
                edit:false,
            }
        }
    },
    methods:{
        next(){
            if(this.task.status === 0){
                this.startTask();
            }else if(this.task.status === 1){
                this.finishTask();
            }
        },
        prev(){
           if(this.task.status === 1){
               if (confirm('開始日がリセットされますがよろしいですか？')) {
                   this.undoStartTask();
               }
           }else if(this.task.status === 2){
               if (confirm('終了日がリセットされますがよろしいですか？')){
                   this.undoFinishTask();
               }
           }

        },
        deleteTask(){
            if (confirm('削除しますか？')){
                axios.delete(`/api/objectives/${this.objectiveId}/task/${this.task.id}/delete`)
                    .then((res) => {
                        this.refresh();
                    })
                    .catch((error) =>{
                    })
            }
        },
        startTask(){
            axios.get(`/api/objectives/${this.objectiveId}/task/${this.task.id}/start`)
                .then((res) => {
                    this.refresh();
                })
                .catch((error) =>{
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
        undoStartTask(){
            axios.get(`/api/objectives/${this.objectiveId}/task/${this.task.id}/undo_start`)
                .then((res) => {
                    this.refresh();
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        undoFinishTask(){
            axios.get(`/api/objectives/${this.objectiveId}/task/${this.task.id}/undo_finish`)
                .then((res) => {
                    this.refresh();
                })
                .catch((error) =>{
                })
        },

        refresh(){
            this.$emit('refresh');
        },
        setStartDate(){
            let sendDate = {
                "date": this.startDate
            }
            axios.put(`/api/objectives/${this.objectiveId}/task/${this.task.id}/start`, sendDate)
                .then((res) => {
                    this.refresh();
                })
                .catch((error) =>{
                })
        },
        setFinishDate(){
            let sendDate = {
                "date": this.finishDate
            }
            axios.put(`/api/objectives/${this.objectiveId}/task/${this.task.id}/finish`, sendDate)
                .then((res) => {
                    this.refresh();
                })
                .catch((error) =>{
                })
        },
        changeTitle(title){
            let sendDate = {
                "title": title
            }
            axios.put(`/api/objectives/${this.objectiveId}/task/${this.task.id}/edit_title`, sendDate)
                .then((res) => {
                    this.refresh();
                })
                .catch((error) =>{
                })
        },
        changeNote(note){
            console.log(note)
            let sendDate = {
                "note": note
            }
            axios.put(`/api/objectives/${this.objectiveId}/task/${this.task.id}/edit_note`, sendDate)
                .then((res) => {
                    this.refresh();
                })
                .catch((error) =>{
                })
        },
        taskTitleFieldDbClick(){
            this.isTaskTitleFieldFocus = true;
        },
        taskNoteFieldDbClick(){
            this.isTaskNoteFieldFocus = true;
        },
        taskTitleFieldOutFocus(title){
            console.log("aaa")
            this.changeTitle(title);
            this.title.edit = false;
            this.isTaskTitleFieldFocus = false;
        },
        taskNoteFieldOutFocus(note){
            this.note.edit = false;
            console.log('push note')
            this.changeNote(note);

            this.isTaskNoteFieldFocus = false;
        },

        changeStartDate(){
            let sendDate = {
                "start_date": this.task.start_date
            }

            axios.post(`/api/objectives/${this.objectiveId}/task/${this.task.id}/start`, sendDate)
                .then((res) => {

                    this.startDateMenu = false;
                    this.refresh();
                })
                .catch((error) =>{
                })

        },
        changeFinishDate(){
            let sendDate = {
                "finish_date": this.task.finish_date
            }

            axios.post(`/api/objectives/${this.objectiveId}/task/${this.task.id}/finish`, sendDate)
                .then((res) => {
                    this.finishDateMenu = false;
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
