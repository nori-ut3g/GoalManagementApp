<template>
    <div id="app">
        <v-app id="inspire">
            <v-data-table
                :headers="headers"
                :items="objectives"
                :items-per-page="5"
                class="elevation-1"
            ></v-data-table>
        </v-app>
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
            objectives: [

            ],
        }
    },
    created:function (){
        axios.get('/api/objectives')
            .then((res) => {
                this.objectives = res.data;
                console.log(res.data)
            })
    }
}

</script>

<style scoped>

</style>
