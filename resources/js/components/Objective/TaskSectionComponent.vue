<template>
    <div>
        <v-card
            max-width="400"
        >
            <v-container>
                <v-row>
<!--                    <div v-for="(task, index) in tasks" :key="index" >-->
<!--                        <task-card-component  :task="task" class="my-2" ></task-card-component>-->
<!--                    </div>-->
                    <v-expansion-panels>
                        <v-expansion-panel
                            v-for="(item,i) in 5"
                            :key="i"
                        >
                            <v-expansion-panel-header>
                                Item
                            </v-expansion-panel-header>
                            <v-expansion-panel-content>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </v-expansion-panel-content>
                        </v-expansion-panel>
                    </v-expansion-panels>
                </v-row>
            </v-container>
        </v-card>
    </div>

</template>

<script>
import TaskCardComponent from "./TaskCardComponent";
export default {
    name: "TaskSectionComponent",
    components: {TaskCardComponent},
    props: ['tasks', 'userInfo'],
    data(){
        return{
            // tasks:[]
        }
    }
}
</script>

<style scoped>

</style>
