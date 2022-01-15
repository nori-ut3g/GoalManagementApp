<template>
    <div>

        <v-data-table
            :headers="headers"
            :items="objectives"
            :items-per-page="5"
            class="elevation-1"
            @click:row="clickRow"
        ></v-data-table>

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
                { text: 'Due', value: 'due_date' },
                // { text: 'Update', value: 'updated_at' },
                // { text: 'Create', value: 'created_at' }
            ],
            objectives:[],

        }
    },
    created:function (){
        this.getObjectives();
    },
    methods:{
        getObjectives(){
            axios.get('/api/objectives')
                .then((res) => {
                    this.objectives = res.data;
                    console.log(res.data)
                })
        },
        clickRow (row) {
            this.$router.push('/objective/'+row.id)
            console.log('clickRow', row.id)
        }
    }
}

</script>

<style scoped>

</style>
