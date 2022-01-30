<template>
<div>
    <header-component>

    </header-component>
        <v-row>
            <v-col
                cols=12
            >
                こんにちは{{userInfo.name}}さん
            </v-col>
            <v-col
                cols=12
            >
                <v-btn
                    fab
                    text
                    small
                    color="grey darken-2"
                    @click="prevMonth"
                >
                    <v-icon small>
                        mdi-chevron-left
                    </v-icon>
                </v-btn>

                <v-btn
                    outlined
                    class="mr-4"
                    color="grey darken-2"
                    @click="setToday"
                >
                    Today
                </v-btn>

                <v-btn
                    fab
                    text
                    small
                    color="grey darken-2"
                    @click="nextMonth"
                >
                    <v-icon small>
                        mdi-chevron-right
                    </v-icon>
                </v-btn>
            </v-col>

            <v-col
                cols=12
            >
                <v-sheet height="600">
                    <v-calendar
                        ref="calendar"
                        v-model="value"
                        :events="events"
                        :event-more="true"
                    ></v-calendar>
                </v-sheet>
            </v-col>
        </v-row>
</div>

</template>

<script>
import HeaderComponent from "./Header/HeaderComponent";
export default {
    name: "WelcomeComponent",
    components: {HeaderComponent},
    data() {
        return {
            userInfo:{},
            events: [

            ],
            objectives:[],
            value: new Date().toISOString().split("T")[0].replaceAll("-", "/")
        }
    },
    created:function(){
        this.getData();
    },
    methods:{

        getData(){
            axios.get('/api/user')
                .then((res) => {
                    this.userInfo = res.data;
                    this.getObjectives();
                })
                .catch((err) => {
                    console.log(err);
                    console.log(this.userInfo)
                })

        },
        getObjectives(){
            axios.get('/api/objectives')
                .then((res) => {
                    this.objectives = res.data;
                    this.refreshCalenderEvents()
                })
        },
        refreshCalenderEvents(){
            let events = []
            for(const objective of this.objectives){
                if(objective.created_at === null) continue;
                let due_date;
                if(objective.due_date === null) due_date = new Date().toISOString().split("T")[0].replaceAll("-", "/");
                else due_date = objective.due_date;

                events.push({
                    name: objective.title,
                    start: new Date(objective.created_at),
                    end: new Date(due_date),
                    timed: false
                })
            }
            this.events = events;
        },
        nextMonth(){
            this.$refs.calendar.next()
        },
        prevMonth(){
            this.$refs.calendar.prev()
        },
        setToday () {
            this.value = ''
        },
    }
}
</script>

<style scoped>

</style>
