<template>
    <div>
        <div class="flex justify-between pb-2 items-center">
            <span class="flex-1"><strong>Company: </strong>{{note.data.company}}</span>
            <span class="flex-1">{{note.data.status}}</span>
            <span class="flex-1 text-gray-500 uppercase text-sm"><strong>Created by: {{note.data.creator}}</strong> {{note.data.created}}</span>
        </div>
        <div><strong>Contact: </strong>{{note.data.contact}}</div>
        <div><strong>Issue: </strong>{{note.data.issue}}</div>
        <p class="whitespace-pre-wrap" v-html="note.data.details"/>

        <p v-text="note.data.time"/>
        <div class="flex justify-end">
            <button @click="deleteNote" class="text-sm flex items-center border border-red-500 text-red-500 hover:bg-red-500 hover:text-white focus:outline-none focus:shadow-outline font-bold px-2 py-1 rounded shadow">
                <svg class="w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="currentColor"
                          d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9.4-18.7A24 24 0 00281.1 0H166.8a23.72 23.72 0 00-21.4 13.3L136 32H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"/>
                </svg>
                Delete Note
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NotesShow",
        props: ['note'],
        data() {
            return {}
        },
        methods: {
            deleteNote() {
                axios.delete('/api/notes/' + this.note.data.note_id)
                    .then(() => {
                        this.$emit('note:remove', this.note.data.note_id);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
