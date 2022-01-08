<template>
    <div>
        <v-card
            max-width="400"
        >
            <v-container >
                <v-row>
                    <task-card-component></task-card-component>
                    <task-card-component></task-card-component>
                    <task-card-component></task-card-component>
                </v-row>
            </v-container>
        </v-card>
    </div>

</template>

<script>
import TaskCardComponent from "./TaskCardComponent";
export default {
    name: "TaskSectionComponent",
    components: {TaskCardComponent}
}
</script>

<style scoped>

</style>
