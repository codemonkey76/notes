<template>
    <div class="p-2 flex-1 bg-gray-200">
        <div v-if="loading">Loading...</div>
        <div class="h-screen overflow-y-auto" v-else>
            <notes-create class="p-2 mb-2 rounded shadow bg-white" @note:created="noteCreated($event)"></notes-create>
            <div v-if="notes.length===0">
                No notes yet.
                <router-link to="/notes/create" class="text-blue-500">Get started ></router-link>
            </div>

            <notes-show class="rounded p-2 mb-2 bg-white border shadow text-gray-900"
                        v-for="(note,key) in notes"
                        :note="note"
                        :key="key"
            />
        </div>
    </div>
</template>

<script>
    import NotesCreate from "./NotesCreate";
    import NotesShow from "./NotesShow";

    export default {
        name: "NotesIndex",
        components: {NotesShow, NotesCreate},
        data() {
            return {
                notes: null,
                loading: true
            }
        },
        mounted() {
            this.load();
        },
        methods: {
            load() {
                axios.get('/api/notes')
                    .then(response => {
                        this.notes = response.data.data;

                        this.loading = false;
                    }).catch(error => {
                    alert('Could not retrieve any notes.');
                    this.loading = false;
                });
            },
            noteCreated(event) {
                this.notes.unshift(event);
            }
        }
    }
</script>

<style scoped>

</style>
