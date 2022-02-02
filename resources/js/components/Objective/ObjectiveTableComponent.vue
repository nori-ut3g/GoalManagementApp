<template>
    <div>
        <header-component
            ref="header"
        >

        </header-component>
        <v-main>
            <v-data-table
                :headers="headers"
                :items="table"
                :items-per-page="5"

                class="elevation-1"
            >
                <template v-slot:item.edit="{ item }">
                    <v-icon
                        @click="editObjective(item)"
                    >
                        mdi-pencil
                    </v-icon>
                </template>
                <template v-slot:item.delete="{ item }">
                    <v-icon
                        @click="deleteObjective(item)"
                    >
                        mdi-delete
                    </v-icon>
                </template>
            </v-data-table>
        </v-main>
    </div>

</template>

<script>
import HeaderComponent from "../Header/HeaderComponent";
export default {
    name: "ObjectiveTableComponent",
    components: {HeaderComponent},
    data () {
        return {
            headers: [
                {
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                { text: 'Edit', value: 'edit', sortable: false},
                { text: 'Title', value: 'title' },
                { text: 'Start', value: 'start_date' },
                { text: 'Due', value: 'due_date' },
                { text: 'Finish', value: 'finish_date' },
                { text: 'Status', value: 'status' },
                { text: 'Delete', value: 'delete', sortable: false},
            ],
            objectives:[],
            table:[],
        }
    },
    created:function (){
        this.getObjectives();
    },
    methods:{
        getObjectives(){
            axios.get('/api/objectives')
                .then((res) => {
                    this.table=[]
                    this.objectives = res.data;
                    this.convertToTable()
                })
        },
        clickRow (row) {
            this.$router.push('/objective/'+row.id)
        },
        convertToTable(){
            console.log(this.objectives)
            this.objectives.forEach(objective => {

                const row = {
                    title: objective.title,
                    start_date: objective.start_date === null ? null :objective.start_date.split("T")[0].replaceAll("-", "/"),
                    due_date: objective.due_date.replaceAll("-", "/"),
                    finish_date: objective.finish_date === null ? null : objective.finish_date.replaceAll("-", "/"),
                    status: objective.status === 0 ? 'Working': 'Complete',
                    id: objective.id,
                }
                this.table.push(row);
            })
        },
        editObjective(item){
            this.$router.push('/objective/'+item.id)
        },
        deleteObjective(item){
            axios.delete(`/api/objectives/${item.id}/delete`)
                .then((res) => {
                    this.getObjectives();

                })
                .catch((error) =>{
                })
        }
    }
}

</script>

<style scoped>

</style>
