<template>
    <div class="relative pb-4">
        <label :for="name"
               class="absolute text-blue-500 uppercase font-bold text-xs pt-2"
                :class="{'-mt-6': type==='select'}">
            {{ label }}
        </label>
        <textarea
                v-if="type==='textarea'"
                :id="name"
                class="text-gray-900 pt-8 w-full border-b pb-2 focus:outline-none focus:border-blue-400"
                :class="errorClassObject()"
                :placeholder="placeholder"
                v-model="state"
                @input="updateField"
                :rows="rows"
        ></textarea>
        <input v-if="type==='text'"
               :id="name"
               type="text"
               class="text-gray-900 pt-8 w-full border-b pb-2 focus:outline-none focus:border-blue-400"
               :class="errorClassObject()"
               :placeholder="placeholder"
               v-model="state"
               @input="updateField">
        <select v-if="type==='select'"
                :id="name"
                class="block mt-6 appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        v-model="state" @input="updateField">
             >
            <option v-for="(option,key) in options" :value="option">{{titleCase(option)}}</option>
        </select>
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
            },
            options: {},
            value: {}
        },
        data() {
            return {
                state: this.value
            }
        },
        watch: {
            value(val) {
                this.state = val;
            }
        },
        methods: {
            titleCase(str) {
                return str[0].toUpperCase() + str.slice(1);
            },
            updateField(event) {
                this.clearErrors(this.name);

                this.$emit('input', event.target.value)
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
