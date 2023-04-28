<template>
    <div class="space-y-2">
        <h3 class="text-grey-80 mt-4">Product description</h3>
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
                        <p>Audience</p>
                    </div>
                    <text-input type="text" v-model="audience" placeholder="Women" :disabled="processing" />
                    <div v-if="errors.audience" class="text-sm text-red">
                        {{ errors.audience[0] }}
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="help-block">
                        <p>Tone</p>
                    </div>
                    <select-input :options="toneOptions" v-model="tone" :isReadOnly="processing" />
                    <div v-if="errors.tone" class="text-sm text-red">
                        {{ errors.tone[0] }}
                    </div>
                </div>
            </div>
            <div class="flex justify-between gap-4">
                <div class="w-1/2">
                    <div class="help-block">
                        <p>Product Title</p>
                    </div>
                    <text-input type="text" v-model="product_title" placeholder="Black slippers" :disabled="processing" />
                    <div v-if="errors.product_title" class="text-sm text-red">
                        {{ errors.product_title[0] }}
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="help-block">
                        <p>Max words</p>
                    </div>
                    <text-input type="text" v-model="max_words" placeholder="200" :disabled="processing" />
                    <div v-if="errors.max_words" class="text-sm text-red">
                        {{ errors.max_words[0] }}
                    </div>
                </div>
            </div>
            <div>
                <div class="help-block">
                    <p>Product Description</p>
                </div>
                <textarea-input v-model="product_description" placeholder="A pair of black slippers with a soft footbed." :disabled="processing" />
                <div v-if="errors.product_description" class="text-sm text-red">
                    {{ errors.product_description[0] }}
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
            audience: null,
            tone: null,
            product_title: null,
            product_description: null,
            max_words: null,
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
            this.request('product-description', {
                audience: this.audience,
                tone: this.tone,
                product_title: this.product_title,
                product_description: this.product_description,
                max_words: this.max_words,
            });
        },
    }
}
</script>
