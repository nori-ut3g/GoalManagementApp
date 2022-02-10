<template>
    <div>
        <header-component
            ref="header"
        >
        </header-component>
        <v-main>
            <v-row
                justify="end"
            >
                <v-col  cols="4">
                    <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details
                        outlined
                        max-
                    ></v-text-field>
                </v-col>
            </v-row>

            <v-data-table
                :headers="headers"
                :items="table"
                :items-per-page="5"
                :search="search"
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
                { text: 'Show', value: 'show', sortable: false, width: '10%'},
                { text: 'User', value: 'user', width: '20%'},
                { text: 'Title', value: 'title', width: '30%'},
                { text: 'Start', value: 'created_at', width: '10%'},
                { text: 'Due', value: 'due_date', width: '10%'},
                { text: 'Finish', value: 'finish_date', width: '10%'},
                { text: 'Status', value: 'status', width: '10%'},
            ],
            sharedObjectives:[],
            table:[],
            search:''
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
