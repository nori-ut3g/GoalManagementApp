<template>
    <div>
        <header-component>

        </header-component>
        <v-main>
            <v-data-table
                :headers="headers"
                :items="objectives"
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
                { text: 'Due', value: 'due_date' },
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
