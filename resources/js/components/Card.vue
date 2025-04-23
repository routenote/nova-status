<template>
    <card class="h-auto">
        <h3 class="px-6 pt-4 pb-2 text-base text-80 font-bold mb-2">
            Service Status

            <span
                @click="fetch"
                :class="{ 'opacity-50': processing }"
                class="font-normal float-right underline text-sm cursor-pointer">
                Retry
            </span>
        </h3>

        <div v-if="processing" style="padding: 2rem 0 4rem 0">
            <loader />
        </div>

        <div
            :key="index"
            v-if="!processing"
            v-for="(status, index) in statuses"
            class="block w-full px-6 py-4 border-40"
            :class="{
                'border-t': index === 0,
                'border-b': index + 1 !== statuses.length,
            }">

            <span class="text-lg font-bold" v-text="status.label"></span>

            <span
                v-if="passes(status)"
                class="float-right text-xs text-success border border-success rounded-full px-2 py-1 ml-2">
                Connected
            </span>

            <span
                v-if="!passes(status)"
                class="float-right text-xs text-danger border border-danger rounded-full px-2 py-1 ml-2">
                Failure
            </span>

            <span
                v-text="status.value"
                v-if="!passes(status)"
                class="block w-full text-xs text-80 mt-2">
            </span>
        </div>
    </card>
</template>

<script>
    import { map } from 'lodash'

    export default {
        props: ['card'],

        data() {
            return {
                statuses: [],
                processing: false,
            }
        },

        methods: {
            fetch() {
                this.processing = true

                Nova.request()
                    .get('/nova-vendor/nova-status')
                    .then(r => (this.statuses = r.data))
                    .then(r => (this.processing = false))
            },

            passes(status) {
                return typeof status.value === 'boolean' && status.value
            },
        },

        created() {
            this.fetch()
        },
    }
</script>
