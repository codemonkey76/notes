<template>
    <div>
        <div v-if="loading">Loading...</div>
        <div v-else>
            <div v-if="notes.length===0">
                No notes yet.
                <router-link to="/notes/create" class="text-blue-500">Get started ></router-link>
            </div>
            <div v-for="note in notes">
                note here

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NotesIndex",
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
            }
        }
    }
</script>

<style scoped>

</style>
