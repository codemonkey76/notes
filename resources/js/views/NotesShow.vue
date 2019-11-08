<template>
    <div>
        <div class="flex justify-between pb-2 items-center">
            <span><strong>Company: </strong>{{note.data.company}}</span>
            <span>{{note.data.status}}</span>
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
            return {

            }
        }
    }
</script>

<style scoped>

</style>