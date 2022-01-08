<template>
    <div>
        <v-container>
            <v-row>
                <v-col cols=4 v-for="n in 3" :key="n">
                    <TaskSectionComponent></TaskSectionComponent>
                </v-col>
            </v-row>
        </v-container>

    </div>
</template>

<script>
import TaskSectionComponent from "./TaskSectionComponent";
export default {
    name: "ObjectiveBodyComponent",
    components: {TaskSectionComponent}
}
</script>

<style scoped>

</style>
