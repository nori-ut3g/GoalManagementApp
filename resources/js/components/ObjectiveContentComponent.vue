<template>
    <v-row>
        <v-col cols=4 v-for="n in 3" :key="n">
            <task-section-component></task-section-component>
        </v-col>
    </v-row>

</template>

<script>
import ProgressBarComponent from "./ProgressBarComponent";
import TaskSectionComponent from "./TaskSectionComponent";
export default {
    name: "ObjectiveContentComponent",
    components: {TaskSectionComponent, ProgressBarComponent}
}
</script>

<style scoped>

</style>
