<template>
    <div class="space-y-2">
        <h3 class="text-grey-80 mt-4">Outliner</h3>
        <div v-if="processing">
            <assistant-spinner />
        </div>
        <div v-else-if="result">
            <assistant-result :result="result" @cancel="result = null" />
        </div>
        <div v-else class="space-y-2">
            <div>
                <div class="help-block">
                    <p>Summary (required)</p>
                </div>
                <textarea-input v-model="summary" placeholder="Provide a short summary of the subject you want to write about" :disabled="processing" />
                <div v-if="errors.summary" class="text-sm text-red">
                    {{ errors.summary[0] }}
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
            summary: null,
            amount: 5,
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
            this.request('outliner', {
                summary: this.summary,
                amount: this.amount,
            });
        },
    }
}
</script>
