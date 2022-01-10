<template>
    <div>

        <v-data-table
            :headers="headers"
            :items="objectives"
            :items-per-page="5"
            class="elevation-1"
        ></v-data-table>
        <v-card>
            <v-col cols="12">
                <v-text-field
                    label="Objective"
                    value="Title"
                    v-model="objective.title"
                ></v-text-field>
            </v-col>
            <v-btn @click="create()">Create</v-btn>
        </v-card>
    </div>

</template>

<script>
export default {
    name: "ObjectiveTableComponent",
    data () {
        return {
            headers: [
                {
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                { text: 'Title', value: 'title' },
                { text: 'Update', value: 'updated_at' },
                { text: 'Create', value: 'created_at' }
            ],
            objectives:[],
            objective:{
                title:"",
            }
        }
    },
    created:function (){
        this.getObjectives();
    },
    methods:{
        create(){
            axios.post('/api/objectives/create', this.objective)
                .then((res) => {
                    this.getObjectives();
                })
        },
        getObjectives(){
            axios.get('/api/objectives')
                .then((res) => {
                    this.objectives = res.data;
                    console.log(res.data)
                })
        }
    }
}

</script>

<style scoped>

</style>
