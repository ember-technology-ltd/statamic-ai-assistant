<template>
    <div class="space-y-2">
        <h3 class="text-gray-800 mt-4">Copywriting by formula</h3>
        <div v-if="processing">
            <assistant-spinner />
        </div>
        <div v-else-if="result">
            <assistant-result :result="result" @cancel="result = null" />
        </div>
        <div v-else class="space-y-2">
            <div>
                <div class="help-block">
                    <p>Formula (required)</p>
                </div>
                <select-input :options="formulaOptions" v-model="formula" :isReadOnly="processing" />
                <div v-if="errors.formula" class="text-sm text-red">
                    {{ errors.formula[0] }}
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
                        <p>Audience (required)</p>
                    </div>
                    <text-input type="text" v-model="audience" placeholder="eg. women" :disabled="processing" />
                    <div v-if="errors.audience" class="text-sm text-red">
                        {{ errors.audience[0] }}
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
            formula: null,
            audience: null,
            product_title: null,
            product_description: null,
        }
    },
    computed: {
        formulaOptions() {
            return [
                { value: '4C', label: '4C (Clear, Concise, Compelling, Credible)' },
                { value: 'AIDA', label: 'AIDA (Attention, Interest, Desire, Action)' },
                { value: 'FAB', label: 'FAB (Features, Advantages, Benefits)' },
                { value: 'PAS', label: 'PAS (Problem, Agitate, Solution)' },
                { value: 'PPPP', label: 'PPPP (Picture, Promise, Prove, Push)' },
                { value: 'QUEST', label: 'QUEST (Qualify, Understand, Educate, Stimulate, Transition)' },
            ];
        }
    },
    methods: {
        generate() {
            this.request('copywriting', {
                formula: this.formula,
                audience: this.audience,
                product_title: this.product_title,
                product_description: this.product_description,
            });
        },
    }
}
</script>
