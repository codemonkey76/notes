<template>
    <div class="p-2 flex-1 bg-gray-200">
        <div v-if="loading">Loading...</div>
        <div class="h-screen overflow-y-auto" v-else>
            <notes-create class="p-2 mb-2 rounded shadow bg-white" @note:created="noteCreated($event)" :statuses="statuses"></notes-create>
            <div v-if="notes.length===0">
                No notes yet.
                <router-link to="/notes/create" class="text-blue-500">Get started ></router-link>
            </div>

            <notes-show class="rounded p-2 mb-2 bg-white border shadow text-gray-900"
                        v-for="(note,key) in notes"
                        :note="note"
                        :key="key"
                        @note:remove="noteDeleted(key)"
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
                statuses: null,
                loading: true
            }
        },
        mounted() {
            this.load();
        },
        methods: {
            load() {
                axios.get('/api/status')
                    .then(response => {
                        this.statuses = response.data;
                        axios.get('/api/notes')
                            .then(response => {

                                this.notes = response.data.data;

                                this.loading = false;
                            }).catch(() => {
                            alert('Could not retrieve any notes.');
                            this.loading = false;
                        });
                    }).catch(() => {
                    alert('Could not retrieve statuses.');
                });
            },
            noteCreated(event) {
                this.notes.unshift(event);
            },
            noteDeleted(key) {
                this.notes.splice(key, 1);
            }
        }
    }
</script>

<style scoped>

</style>
