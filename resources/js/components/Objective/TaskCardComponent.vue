<template>
    <v-card
        :color="cardColor"
    >
        <v-col cols="12">
            <v-form
                ref="titleForm"
                lazy-validation
            >
                <v-text-field
                    label="Task"
                    v-model="task.title"
                    :readonly="!title.edit"
                    @click="title.edit = true"
                    @blur="taskTitleFieldOutFocus(task.title)"
                    :rules="rules.titleInput"
                    counter="30"
                ></v-text-field>
            </v-form>

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
                    <v-form
                        ref="noteForm"
                        lazy-validation
                    >
                        <v-textarea
                            label="Note"
                            v-model="task.note"
                            :auto-grow="note.edit"
                            :readonly="!note.edit"
                            @click="note.edit = true"
                            @blur="taskNoteFieldOutFocus(task.note)"
                            outlined
                            :rules="rules.noteInput"
                            counter="255"
                        ></v-textarea>
                    </v-form>
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
            startDate: "",
            startDateMenu: false,
            finishDate:"",
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
            },

            rules:{
                titleInput:[v => (v !== null &&  v.length <= 30) || 'Title は30字以内で入力してください。'],
                noteInput:[v => (v !== null &&  v.length <= 255)  || 'note は255字以内で入力してください。'],
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
                    .then(() => {
                        this.refresh();
                    })
                    .catch(() =>{
                    })
            }
        },
        startTask(){
            axios.get(`/api/objectives/${this.objectiveId}/task/${this.task.id}/start`)
                .then(() => {
                    this.refresh();
                })
                .catch(() =>{
                })
        },
        finishTask(){
            axios.get(`/api/objectives/${this.objectiveId}/task/${this.task.id}/finish`)
                .then(() => {
                    this.refresh();
                })
                .catch(() =>{
                })
        },
        undoStartTask(){
            axios.get(`/api/objectives/${this.objectiveId}/task/${this.task.id}/undo_start`)
                .then(() => {
                    this.refresh();
                })
                .catch(() =>{
                })
        },
        undoFinishTask(){
            axios.get(`/api/objectives/${this.objectiveId}/task/${this.task.id}/undo_finish`)
                .then(() => {
                    this.refresh();
                })
                .catch(() =>{
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
                .then(() => {
                    this.refresh();
                })
                .catch(() =>{
                })
        },
        setFinishDate(){
            let sendDate = {
                "date": this.finishDate
            }
            axios.put(`/api/objectives/${this.objectiveId}/task/${this.task.id}/finish`, sendDate)
                .then(() => {
                    this.refresh();
                })
                .catch(() =>{
                })
        },
        changeTitle(title){
            let sendDate = {
                "title": title
            }
            if(this.$refs.titleForm.validate()) {
                axios.put(`/api/objectives/${this.objectiveId}/task/${this.task.id}/edit_title`, sendDate)
                    .then(() => {
                        this.refresh();
                    })
                    .catch(() => {
                    })
            }
        },
        changeNote(note){
            let sendDate = {
                "note": note
            }
            if(this.$refs.noteForm.validate()) {
                axios.put(`/api/objectives/${this.objectiveId}/task/${this.task.id}/edit_note`, sendDate)
                    .then(() => {
                        this.refresh();
                    })
                    .catch(() => {
                    })
            }
        },
        taskTitleFieldOutFocus(title){
            this.changeTitle(title);
            this.title.edit = false;
            this.isTaskTitleFieldFocus = false;
        },
        taskNoteFieldOutFocus(note){
            this.changeNote(note);
            this.note.edit = false;
            this.isTaskNoteFieldFocus = false;
        },
        changeStartDate(){
            let sendDate = {
                "start_date": this.task.start_date
            }
            axios.put(`/api/objectives/${this.objectiveId}/task/${this.task.id}/start`, sendDate)
                .then(() => {
                    this.startDateMenu = false;
                    this.refresh();
                })
                .catch(() =>{
                })
        },
        changeFinishDate(){
            let sendDate = {
                "finish_date": this.task.finish_date
            }
            axios.put(`/api/objectives/${this.objectiveId}/task/${this.task.id}/finish`, sendDate)
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
