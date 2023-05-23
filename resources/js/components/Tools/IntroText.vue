<template>
    <div class="space-y-2">
        <h3 class="text-gray-800 mt-4">Intro Text</h3>
        <div v-if="processing">
            <assistant-spinner />
        </div>
        <div v-else-if="result">
            <assistant-result :result="result" @cancel="result = null" />
        </div>
        <div v-else class="space-y-2">
            <div>
                <div class="help-block">
                    <p>Headline (required)</p>
                </div>
                <text-input v-model="headline" placeholder="Provide the headline of the subject you want to make an intro to" :disabled="processing" />
                <div v-if="errors.headline" class="text-sm text-red">
                    {{ errors.headline[0] }}
                </div>
            </div>
            <assistant-buttons :processing="processing" @submit="generate" @cancel="$emit('back')" />
        </div>
    </div>
</template>

<script>
import {GeneratorMixin} from '../../mixins.js';

export default {
    mixins: [GeneratorMixin],
    data() {
        return {
            headline: null,
        }
    },
    computed: {
        amountOptions() {
            return [
                { value: 1, label: '1' },
                { value: 2, label: '2' },
                { value: 3, label: '3' },
                { value: 4, label: '4' },
                { value: 5, label: '5' },
                { value: 6, label: '6' },
                { value: 7, label: '7' },
                { value: 8, label: '8' },
                { value: 9, label: '9' },
                { value: 10, label: '10' },
            ];
        }
    },
    methods: {
        generate() {
            this.request('intro-text', {
                headline: this.headline,
            });
        },
    }
}
</script>
