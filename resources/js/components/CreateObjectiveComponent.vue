<template>
    <v-card>
        <v-col cols="12">
            <v-text-field
                label="Objective"
                value="Title"
                v-model="objective.title"
            ></v-text-field>
        </v-col>

        <v-menu
            ref="menu"
            v-model="menu"
            :close-on-content-click="false"
            :return-value.sync="objective.due_date"
            transition="scale-transition"
            offset-y
            min-width="auto"
        >
            <template v-slot:activator="{ on, attrs }">
                <v-text-field
                    v-model="objective.due_date"
                    label="Due Date"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                ></v-text-field>
            </template>
            <v-date-picker
                v-model="objective.due_date"
                no-title
                scrollable
            >
                <v-spacer></v-spacer>
                <v-btn
                    text
                    color="primary"
                    @click="menu = false"
                >
                    Cancel
                </v-btn>
                <v-btn
                    text
                    color="primary"
                    @click="$refs.menu.save(objective.due_date)"
                >
                    OK
                </v-btn>
            </v-date-picker>
        </v-menu>

        <v-btn @click="create()">Create</v-btn>

    </v-card>
</template>

<script>
export default {
    name: "CreateObjective",
    data(){
        return{
            objective:{
                title:"",
                // due_date:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)
                due_date:""
            },
            menu: false,
        }
    },
    methods:{
        create(){
            axios.post('/api/objectives/create', this.objective)
                .then((res) => {
                    console.log(this.objective)
                })
            .catch((error) =>{
                console.log(error),
                    console.log(this.objective)

            })
        },
    }
}
</script>

<style scoped>

</style>
