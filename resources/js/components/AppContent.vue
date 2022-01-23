<template>
    <div>
        <v-container>
            <router-view
            ></router-view>
        </v-container>
    </div>
</template>

<script>
import TaskSectionComponent from "./TaskSectionComponent";
import ProgressBarComponent from "./ProgressBarComponent";
import ObjectiveContentComponent from "./ObjectiveContentComponent";
import ObjectiveTableComponent from "./ObjectiveTableComponent";
import SignUpComponent from "./SignUpComponent";
import LogInComponent from "./LogInComponent";

export default {
    name: "ObjectiveBodyComponent",
    components: {
        LogInComponent,
        SignUpComponent,
        ObjectiveTableComponent,
        ObjectiveContentComponent,
        ProgressBarComponent,
        TaskSectionComponent,},
    data() {
        return {
        }
    },
    computed:{



    },
    created:function(){
        // this.autoLogin();
    },
    methods:{
    }
}
</script>

<style scoped>

</style>
