<template>
    <div>
        <header-component
        ref="header"
        >
        </header-component>
        <v-main>
            <v-card>
                <v-form
                    ref="form"
                    lazy-validation
                >
                    <v-col cols="12">
                        <v-text-field
                            label="Goal"
                            value="Title"
                            v-model="objective.title"
                            :rules="[rules.title.counter, rules.title.require]"
                            counter="50"
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
                                :rules="[rules.date.require]"
                            ></v-text-field>
                        </template>
                        <v-date-picker
                            v-model="objective.due_date"
                            no-title
                            scrollable
                            :min="today"
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
                </v-form>

                <v-btn @click="create()">Create</v-btn>

            </v-card>
        </v-main>
    </div>
</template>

<script>
import HeaderComponent from "../Header/HeaderComponent";
export default {
    name: "CreateObjective",
    components: {HeaderComponent},
    data(){
        return{
            userInfo:{},
            objective:{
                title:"",
                // due_date:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)
                due_date:"",
            },
            menu: false,
            today:new Date().toISOString().split("T")[0],
            rules:{
                title:{
                    counter: value => (value !== undefined && value.length) <= 50 || 'Max 50',
                    require:value => !!value || 'Required.'
                },
                date:{
                    require:value => !!value || 'Required.'
                }
            }
        }
    },
    created:function(){
        this.getUserInfo();
    },
    methods:{
        create(){
            let sendData = {
                title : this.objective.title,
                due_date: this.objective.due_date,
                user_id: this.userInfo.id,
                start_date: new Date().toISOString().split("T")[0].replaceAll("-", "/")
            }
            if(this.$refs.form.validate()) {
                axios.post('/api/objectives/create', sendData)
                    .then((res) => {
                        this.$router.push(`/objective/${res.data.objective_id}`);
                    })
                    .catch((err) => {
                        this.alert(err.response.data.message);
                    })
            }
        },
        getUserInfo(){
            axios.get('/api/user')
                .then((res) => {
                    this.userInfo = res.data;
                })
                .catch((err) => {
                })
        },
        alert(message){
            this.$refs.header.showAlert(message);
        }
    }
}
</script>

<style scoped>

</style>
