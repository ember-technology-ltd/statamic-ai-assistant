<template>
    <div class="space-y-2">
        <h3 class="text-grey-80 mt-4">Rephrase tool</h3>
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
                <textarea-input v-model="text" placeholder="Enter the text you want to rephrase" :disabled="processing" />
                <div v-if="errors.text" class="text-sm text-red">
                    {{ errors.text[0] }}
                </div>
            </div>
            <div class="flex justify-between gap-4">
                <div class="w-1/2">
                    <div class="help-block">
                        <p>Change the tone</p>
                    </div>
                    <select-input :options="toneOptions" v-model="tone" :isReadOnly="processing" />
                    <div v-if="errors.tone" class="text-sm text-red">
                        {{ errors.tone[0] }}
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="help-block">
                        <p>Change the audience</p>
                    </div>
                    <text-input type="text" v-model="audience" placeholder="eg. children" :readOnly="processing" />
                    <div v-if="errors.audience" class="text-sm text-red">
                        {{ errors.audience[0] }}
                    </div>
                </div>
            </div>
            <div class="flex justify-between gap-4">
                <div class="w-1/2">
                    <div class="help-block">
                        <p>Keywords</p>
                    </div>
                    <text-input type="text" v-model="keywords" placeholder="Enter keywords to include in the new text" :disabled="processing" />
                    <div v-if="errors.keywords" class="text-sm text-red">
                        {{ errors.keywords[0] }}
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="help-block">
                        <p>Expand the text with more information</p>
                    </div>
                    <toggle-input v-model="expand" :readOnly="processing" />
                    <div v-if="errors.expand" class="text-sm text-red">
                        {{ errors.expand[0] }}
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
            text: null,
            tone: null,
            audience: null,
            keywords: null,
            expand: false,
        }
    },
    computed: {
        toneOptions() {
            return [
                { value: 'professional', label: 'Professional' },
                { value: 'informal', label: 'Informal' },
                { value: 'humorous', label: 'Humorous' },
                { value: 'optimistic', label: 'Optimistic' },
                { value: 'friendly', label: 'Friendly' },
                { value: 'exciting', label: 'Exciting' },
            ];
        }
    },
    methods: {
        generate() {
            this.request('rephraser', {
                text: this.text,
                tone: this.tone,
                audience: this.audience,
                keywords: this.keywords,
                expand: this.expand,
            });
        },
    }
}
</script>
