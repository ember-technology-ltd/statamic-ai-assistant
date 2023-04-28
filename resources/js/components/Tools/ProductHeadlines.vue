<template>
    <div class="space-y-2">
        <h3 class="text-grey-80 mt-4">Product headlines</h3>
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
                        <p>Audience (required)</p>
                    </div>
                    <text-input type="text" v-model="audience" placeholder="eg. women" :disabled="processing" />
                    <div v-if="errors.audience" class="text-sm text-red">
                        {{ errors.audience[0] }}
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="help-block">
                        <p>Tone (required)</p>
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
                        <p>Product Title (required)</p>
                    </div>
                    <text-input type="text" v-model="product_title" placeholder="Write the name of the product" :disabled="processing" />
                    <div v-if="errors.product_title" class="text-sm text-red">
                        {{ errors.product_title[0] }}
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="help-block">
                        <p>Amount</p>
                    </div>
                    <select-input :options="amountOptions" v-model="amount" :isReadOnly="processing" />
                    <div v-if="errors.amount" class="text-sm text-red">
                        {{ errors.amount[0] }}
                    </div>
                </div>
            </div>
            <div>
                <div class="help-block">
                    <p>Product Description (required)</p>
                </div>
                <textarea-input v-model="product_description" placeholder="Write a short description of the product" :disabled="processing" />
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
            amount: 5,
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
        },
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
            this.request('product-headlines', {
                audience: this.audience,
                tone: this.tone,
                product_title: this.product_title,
                product_description: this.product_description,
                amount: this.amount,
            });
        },
    }
}
</script>
