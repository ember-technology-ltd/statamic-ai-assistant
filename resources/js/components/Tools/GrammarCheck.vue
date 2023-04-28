<template>
    <div class="space-y-2">
        <h3 class="text-grey-80 mt-4">Grammar Check</h3>
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
                <textarea-input v-model="text" placeholder="Provide the text you want to check for grammatical errors" :disabled="processing" />
                <div v-if="errors.text" class="text-sm text-red">
                    {{ errors.text[0] }}
                </div>
            </div>
            <div>
                <div class="help-block">
                    <p>Also fix the errors</p>
                </div>
                <toggle-input v-model="fix" :readOnly="processing" />
                <div v-if="errors.fix" class="text-sm text-red">
                    {{ errors.fix[0] }}
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
            fix: null,
        }
    },
    methods: {
        generate() {
            this.request('grammar-check', {
                text: this.text,
                fix: this.fix,
            });
        },
    }
}
</script>
