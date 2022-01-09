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
                    <v-list>
                        <v-list-item>
                            <v-list-item-avatar>
                                <v-img src="https://cdn.vuetifyjs.com/images/john.png"></v-img>
                            </v-list-item-avatar>
                        </v-list-item>

                        <v-list-item link>
                            <v-list-item-content>
                                <v-list-item-title class="text-h6">
                                    John Leider
                                </v-list-item-title>
                                <v-list-item-subtitle>john@vuetifyjs.com</v-list-item-subtitle>
                            </v-list-item-content>

                            <v-list-item-action>
                                <v-icon>mdi-menu-down</v-icon>
                            </v-list-item-action>
                        </v-list-item>
                    </v-list>
                    <v-divider></v-divider>
                    <v-list
                        nav
                        dense
                    >
                        <v-list-item-group
                            v-model="selectedItem"
                            color="primary"
                        >
                            <v-list-item
                                v-for="(item, i) in items"
                                :key="i"
                            >
                                <v-list-item-icon>
                                    <v-icon v-text="item.icon"></v-icon>
                                </v-list-item-icon>

                                <v-list-item-content>
                                    <v-list-item-title v-text="item.text"></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
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
            sideBar: true,
            items: [
                { text: 'My Files', icon: 'mdi-folder' },
                { text: 'Shared with me', icon: 'mdi-account-multiple' },
                { text: 'Starred', icon: 'mdi-star' },
                { text: 'Recent', icon: 'mdi-history' },
                { text: 'Offline', icon: 'mdi-check-circle' },
                { text: 'Uploads', icon: 'mdi-upload' },
                { text: 'Backups', icon: 'mdi-cloud-upload' },
                ]
        }
    }
}
</script>

<style scoped>

</style>
