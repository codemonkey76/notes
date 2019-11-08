<template>
    <div>
        <form @submit.prevent="submitForm">
            <input-field
                    name="company"
                    label="Company"
                    placeholder="Company name"
                    :errors="errors"
                    v-model="form.company"
            />

            <input-field
                    name="contact"
                    label="Contact"
                    placeholder="Contact name"
                    :errors="errors"
                    v-model="form.contact"
            />

            <input-field
                    name="issue"
                    label="issue"
                    placeholder="What's the issue?"
                    :errors="errors"
                    v-model="form.issue"
            />

            <input-field
                    name="details"
                    label="details"
                    placeholder="Enter the job details"
                    :errors="errors"
                    type="textarea"
                    rows="4"
                    v-model="form.details"
            />

            <input-field
                name="time"
                label="time (mins)"
                placeholder="Enter the time spent"
                :errors="errors"
                v-model="form.time"
            />

            <input-field
                    name="status"
                    label="status"
                    type="select"
                    :options="statuses"
                    v-model="form.status"
            />
            <div class="flex justify-end">
                <button class="flex text-sm items-center border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white focus:outline-none focus:shadow-outline font-bold px-2 py-1 rounded shadow">
                    <svg class="w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                              d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"/>
                    </svg>
                    Add Note
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    import InputField from "../components/InputField";

    export default {
        name: "NotesCreate",
        components: {InputField},
        props: ['statuses'],
        data() {
            return {
                errors: null,
                form: this.clearForm()
            }
        },
        mounted() {
          this.clearForm();
        },
        methods: {
            clearForm() {
                return {
                    company: '',
                    contact: '',
                    issue: '',
                    details: '',
                    status: 'open',
                    time: '1',
                };
            }
            ,
            submitForm() {
                axios.post('/api/notes', this.form)
                    .then(response => {
                        this.$emit('note:created', response.data);
                        this.form = this.clearForm();
                    }).catch(errors => {
                    this.errors = errors.response.data.errors;
                });
            }
        }

    }
</script>

<style scoped>

</style>
