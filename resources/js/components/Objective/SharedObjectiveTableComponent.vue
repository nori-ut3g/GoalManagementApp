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
                <template v-slot:item.show="{ item }">
                    <v-icon
                        @click="showObjective(item)"
                    >
                        mdi-eye
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
                { text: 'Show', value: 'show', sortable: false},
                { text: 'User', value: 'user'},
                { text: 'Title', value: 'title' },
                { text: 'Start', value: 'created_at' },
                { text: 'Due', value: 'due_date' },
                { text: 'Finish', value: 'finish_date' },
                { text: 'Status', value: 'status' },
            ],
            sharedObjectives:[],
            table:[],
        }
    },
    created:function (){
        this.getSharedObjectives();
    },
    methods:{
        getSharedObjectives(){

            axios.get('/api/shared_objectives')
                .then((res) => {
                    this.table=[]
                    this.sharedObjectives = res.data;
                    this.convertToTable()
                })
        },
        convertToTable(){
            this.sharedObjectives.forEach(objective => {
                const row = {
                    title: objective.title,
                    user: objective.user_name,
                    created_at: objective.created_at.split("T")[0].replaceAll("-", "/"),
                    due_date: objective.due_date.replaceAll("-", "/"),
                    finish_date: objective.finish_date === null ? null : objective.finish_date.replaceAll("-", "/"),
                    status: objective.status === 0 ? 'Working': 'Complete',
                    id: objective.id,
                }
                this.table.push(row);
            })
        },
        showObjective(item){
            this.$router.push('/share/objective/'+item.id)
        },
    }
}

</script>

<style scoped>

</style>
