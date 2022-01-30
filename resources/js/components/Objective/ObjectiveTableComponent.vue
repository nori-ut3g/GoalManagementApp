<template>
    <div>
        <header-component>

        </header-component>
        <v-main>
            <v-data-table
                :headers="headers"
                :items="table"
                :items-per-page="5"
                class="elevation-1"
                @click:row="clickRow"
            ></v-data-table>
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
                { text: 'Title', value: 'title' },
                { text: 'Start', value: 'created_at' },
                { text: 'Due', value: 'due_date' },
                { text: 'Finish', value: 'finish_date' },
                { text: 'Status', value: 'status' },

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
            this.objectives.forEach(objective => {
                const row = {
                    title: objective.title,
                    created_at: objective.created_at.split("T")[0].replaceAll("-", "/"),
                    due_date: objective.due_date.replaceAll("-", "/"),
                    finish_date: objective.finish_date.replaceAll("-", "/"),
                    status: objective.status === 0 ? 'Working': 'Complete',
                    id: objective.id
                }
                this.table.push(row);
            })
        }

    }
}

</script>

<style scoped>

</style>
