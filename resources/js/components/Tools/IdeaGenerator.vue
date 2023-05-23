<template>
    <div class="space-y-2">
        <h3 class="text-gray-800 mt-4">Idea Generator</h3>
        <div v-if="processing">
            <assistant-spinner />
        </div>
        <div v-else-if="result">
            <assistant-result :result="result" @cancel="result = null" />
        </div>
        <div v-else class="space-y-2">
            <div class="flex justify-between gap-4">
                <div class="w-1/2">
                    <div class="help-block">
                        <p>Topics to include (required)</p>
                    </div>
                    <text-input type="text" v-model="topics" placeholder="computer games, esport, gaming" :disabled="processing" />
                    <div v-if="errors.topics" class="text-sm text-red">
                        {{ errors.topics[0] }}
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="help-block">
                        <p>Amount of ideas to generate</p>
                    </div>
                    <select-input :options="amountOptions" v-model="amount" :isReadOnly="processing" />
                    <div v-if="errors.amount" class="text-sm text-red">
                        {{ errors.amount[0] }}
                    </div>
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
            topics: null,
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
            this.request('idea-generator', {
                topics: this.topics,
                amount: this.amount,
            });
        },
    }
}
</script>
