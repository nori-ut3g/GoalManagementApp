<template>
    <v-card
        :color="cardColor"
    >
        <v-col cols="12">
            <v-text-field
                v-if="isTaskTitleFieldFocus"
                @blur="taskTitleFieldOutFocus(task.title)"
                :value="task.title"
                elevation="3"
                autofocus

                v-model="task.title"
            ></v-text-field>
            <v-card
                v-else
                solo
                v-on:dblclick="taskTitleFieldDbClick"
                tile
                min-height="30"
                class="my-2"
            >
                <v-card-title>
                    {{task.title}}
                </v-card-title>
            </v-card>


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
                    <v-card>
                    <div>
                        <v-text-field
                            v-if="isTaskNoteFieldFocus"
                            @blur="taskNoteFieldOutFocus(task.note)"
                            :value="task.note"
                            v-model="task.note"
                        ></v-text-field>
                        <v-card-text
                            v-else
                            v-on:dblclick="taskNoteFieldDbClick"
                        >
                            {{task.note}}
                        </v-card-text>
                    </div>


                    </v-card>
                    <v-icon
                        v-if="task.status === 2"
                    >
                        mdi-calendar-month
                    </v-icon>

                    <v-icon
                        @click="deleteTask"
                    >
                        mdi-delete
                    </v-icon>
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
                        console.log(error)
                    })
            }
        },
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
        changeNote(note){
            let sendDate = {
                "note": note
            }
            axios.post(`/api/objectives/${this.objectiveId}/task/${this.task.id}/edit_note`, sendDate)
                .then((res) => {
                    console.log(note)
                    this.refresh();
                })
                .catch((error) =>{
                    console.log(error)
                })
        },
        taskTitleFieldDbClick(){
            this.isTaskTitleFieldFocus = true;
        },
        taskNoteFieldDbClick(){
            this.isTaskNoteFieldFocus = true;
        },
        taskTitleFieldOutFocus(title){
            this.changeTitle(title);
            this.isTaskTitleFieldFocus = false;
        },
        taskNoteFieldOutFocus(note){
            this.changeNote(note);

            this.isTaskNoteFieldFocus = false;
        },


    }

}

</script>

<style scoped>

</style>
