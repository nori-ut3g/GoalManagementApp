<template>
    <div>
        <v-container>
            <!-- Header -->
            <v-app-bar app clippedLeft flat dark color="indigo darken-3">
                <v-app-bar-nav-icon @click.stop="sideBar=!sideBar"></v-app-bar-nav-icon>
            </v-app-bar>



            <!-- Body -->
            <v-main>
                <!-- SideBar -->
                <v-navigation-drawer app clipped v-model="sideBar" dark color="">

                </v-navigation-drawer>
                <v-row>
                    <progress-bar-component></progress-bar-component>
                    <v-col cols=4 v-for="n in 3" :key="n">
                        <TaskSectionComponent></TaskSectionComponent>
                    </v-col>
                </v-row>
            </v-main>



        </v-container>

    </div>
</template>

<script>
import TaskSectionComponent from "./TaskSectionComponent";
import ProgressBarComponent from "./ProgressBarComponent";
export default {
    name: "ObjectiveBodyComponent",
    components: {ProgressBarComponent, TaskSectionComponent},
    data() {
        return {
            sideBar: true
        }
    }
}
</script>

<style scoped>

</style>
