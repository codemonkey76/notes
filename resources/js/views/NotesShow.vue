<template>
    <div>
        <div class="flex justify-between pb-2 items-center">
            <span class="font-bold">{{note.data.company}}</span>
            <span class="text-gray-500 uppercase text-sm">{{note.data.created}}</span>
        </div>
        <div><strong>Contact: </strong>{{note.data.contact}}</div>
        <div><strong>Issue: </strong>{{note.data.issue}}</div>
        <p class="whitespace-pre-wrap" v-html="note.data.details" />
    </div>
</template>

<script>
    export default {
        name: "NotesShow",
        props: ['note'],
        data() {
        }
    }
</script>

<style scoped>

</style>