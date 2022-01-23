<template>
<div>
    <header-component>

    </header-component>
    <v-main>
        こんにちは{{userInfo.name}}さん
        <v-sheet height="600">

            <v-calendar
                ref="calendar"
                :events="events"
            ></v-calendar>
        </v-sheet>
    </v-main>
</div>

</template>

<script>
import HeaderComponent from "./HeaderComponent";
export default {
    name: "WelcomeComponent",
    components: {HeaderComponent},
    data() {
        return {
            userInfo:{},
            events: [

            ],
            objectives:[],
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
            console.log('aaa')
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
        }
    }
}
</script>

<style scoped>

</style>
