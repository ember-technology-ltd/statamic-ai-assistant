<template>
    <div class="space-y-2">
        <h3 class="text-gray-800 mt-4">Summarizer</h3>
        <div v-if="processing">
            <assistant-spinner />
        </div>
        <div v-else-if="result">
            <assistant-result :result="result" @cancel="result = null" />
        </div>
        <div v-else class="space-y-2">
            <div>
                <div class="help-block">
                    <p>Text (required)</p>
                </div>
                <textarea-input v-model="text" placeholder="Provide the text you want to be summarized" :disabled="processing" />
                <div v-if="errors.text" class="text-sm text-red">
                    {{ errors.text[0] }}
                </div>
            </div>
            <div>
                <div class="help-block">
                    <p>Summarization level</p>
                </div>
                <select-input :options="levelOptions" v-model="level" :isReadOnly="processing" />
                <div v-if="errors.level" class="text-sm text-red">
                    {{ errors.level[0] }}
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
            text: null,
            level: null,
        }
    },
    computed: {
        levelOptions() {
            return [
                { value: 'child', label: 'Child' },
                { value: 'highschool student', label: 'High school student' },
                { value: 'university student', label: 'University student' },
                { value: 'genious', label: 'Genious' },
                { value: 'simpleton', label: 'Simpleton' },
            ];
        }
    },
    methods: {
        generate() {
            this.request('summarizer', {
                text: this.text,
                level: this.level,
            });
        },
    }
}
</script>
