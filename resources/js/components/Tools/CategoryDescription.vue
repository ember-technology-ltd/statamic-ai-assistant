<template>
    <div class="space-y-2">
        <h3 class="text-grey-80 mt-4">Category description</h3>
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
                        <p>Category name (required)</p>
                    </div>
                    <text-input type="text" v-model="category" placeholder="eg. bags" :disabled="processing" />
                    <div v-if="errors.category" class="text-sm text-red">
                        {{ errors.category[0] }}
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="help-block">
                        <p>Keyword (required)</p>
                    </div>
                    <text-input type="text" v-model="keyword" placeholder="eg. suitcase" :disabled="processing" />
                    <div v-if="errors.keyword" class="text-sm text-red">
                        {{ errors.keyword[0] }}
                    </div>
                </div>
            </div>
            <div class="flex justify-between gap-4">
                <div class="w-1/2">
                    <div class="help-block">
                        <p>Business name (required)</p>
                    </div>
                    <text-input type="text" v-model="business_name" placeholder="Write the name of your business" :disabled="processing" />
                    <div v-if="errors.business_name" class="text-sm text-red">
                        {{ errors.business_name[0] }}
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
                    <p>Business description (required)</p>
                </div>
                <textarea-input v-model="business_description" placeholder="Write a short description of your business" :disabled="processing" />
                <div v-if="errors.business_description" class="text-sm text-red">
                    {{ errors.business_description[0] }}
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
            category: null,
            keyword: null,
            audience: null,
            business_name: null,
            business_description: null,
        }
    },
    methods: {
        generate() {
            this.request('category-description', {
                category: this.category,
                keyword: this.keyword,
                audience: this.audience,
                business_name: this.business_name,
                business_description: this.business_description,
            });
        },
    }
}
</script>
