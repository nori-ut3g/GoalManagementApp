<template>
    <div>
        <v-progress-linear
            v-model="progress"
            color="blue-grey"
            height="50"
        >
            <strong>{{ Math.ceil(progress) }}%</strong>
        </v-progress-linear>
    </div>
</template>

<script>
export default {
    name: "ProgressBarComponent",
    data:function(){
        return{
            progress: 44,
        }
    },
}
</script>

<style scoped>

</style>
