<template>
    <div class="h-screen bg-white">
        <div class="flex">
            <div class="pl-6 bg-gray-200 w-48 h-screen border-r-2 border-gray-400">
                <nav class="pt-4">
                    <router-link to="/">
                        <svg class="fill-current text-blue-600 w-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path d="M336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM192 40c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm144 418c0 3.3-2.7 6-6 6H54c-3.3 0-6-2.7-6-6V118c0-3.3 2.7-6 6-6h42v36c0 6.6 5.4 12 12 12h168c6.6 0 12-5.4 12-12v-36h42c3.3 0 6 2.7 6 6z"/>
                        </svg>
                    </router-link>

                    <p class="mt-4">
                    <router-link to="/notes" class="uppercase font-bold text-gray-500 text-xs">
                        Notes
                    </router-link>
                    <!--</p>-->
                    <!--<p>-->
                    <!--<router-link to="/notes/create" class="uppercase font-bold text-gray-500 text-xs">Create</router-link>-->
                    <!--</p>-->
                </nav>
            </div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: "App"
    }
</script>

<style scoped>

</style>
