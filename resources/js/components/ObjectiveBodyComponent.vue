<template>
    <div>
        <v-container>
            <v-row>
                <progress-bar-component></progress-bar-component>
                <v-col cols=4 v-for="n in 3" :key="n">
                    <TaskSectionComponent></TaskSectionComponent>
                </v-col>
            </v-row>
        </v-container>

    </div>
</template>

<script>
import TaskSectionComponent from "./TaskSectionComponent";
import ProgressBarComponent from "./ProgressBarComponent";
export default {
    name: "ObjectiveBodyComponent",
    components: {ProgressBarComponent, TaskSectionComponent}
}
</script>

<style scoped>

</style>
