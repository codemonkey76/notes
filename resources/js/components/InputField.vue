<template>
    <div class="relative pb-4">
        <label :for="name"
               class="absolute text-blue-500 uppercase font-bold text-xs pt-2">
            {{ label }}
        </label>
        <textarea
                v-if="type==='textarea'"
                :id="name"
                class="text-gray-900 pt-8 w-full border-b pb-2 focus:outline-none focus:border-blue-400"
                :class="errorClassObject()"
                :placeholder="placeholder"
                v-model="value"
                @input="updateField"
                :rows="rows"
        ></textarea>
        <input v-if="type==='text'"
               :id="name"
               type="text"
               class="text-gray-900 pt-8 w-full border-b pb-2 focus:outline-none focus:border-blue-400"
               :class="errorClassObject()"
               :placeholder="placeholder"
               v-model="value"
               @input="updateField">
        <p class="text-red-600 text-sm" v-text="errorMessage()"></p>
    </div>
</template>

<script>
    export default {
        name: "InputField",

        props: {
            name: {},
            label: {},
            placeholder: {},
            errors: {},
            type: {
                type: String,
                default: 'text'
            },
            rows: {
                type: String,
                default: "5"
            }
        },
        data() {
            return {
                value: ''
            }
        },

        methods: {
            updateField() {
                this.clearErrors(this.name);

                this.$emit('update:field', this.value)
            },

            errorMessage() {
                if (this.hasError) {
                    return this.errors[this.name][0];
                }
            },

            clearErrors() {
                if (this.hasError) {
                    this.errors[this.name] = null;
                }
            },

            errorClassObject() {
                return {
                    'error-field': this.hasError
                }
            }
        },
        computed: {
            hasError() {
                return (this.errors && this.errors[this.name] && this.errors[this.name].length > 0);
            },
        }
    }
</script>

<style scoped lang="sass">
    .error-field
        @apply .border-red-500 .border-b-2
</style>
