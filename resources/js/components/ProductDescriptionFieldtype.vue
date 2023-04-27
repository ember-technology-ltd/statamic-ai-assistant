<template>
    <div class="space-y-2">
        <div>
            <textarea-input :value="value" @input="update" />
            <div>
                <button @click="showForm = !showForm" type="button" class="text-sm text-blue-500">Generate description with AI.</button>
            </div>
        </div>
        <div v-show="showForm" class="space-y-2">
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
            <div class="flex items-center gap-2">
                <button type="button" class="btn" @click="generate">Generate</button>
                <div v-show="processing" class="text-sm text-grey">Loading, please wait...</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mixins: [Fieldtype],
    data() {
        return {
            showForm: false,
            audience: null,
            tone: null,
            product_title: null,
            product_description: null,
            max_words: null,
            processing: false,
            errors: {},
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
        async generate() {
            // if (!confirm('This will overwrite the current description. Are you sure?')) {
            //     return;
            // }
            this.errors = {};
            this.processing = true;

            let data = {
                audience: this.audience,
                tone: this.tone,
                product_title: this.product_title,
                product_description: this.product_description,
                max_words: this.max_words,
            };

            try {
                let response = await Statamic.$request.post(this.meta.url, data);

                this.update(response.data);
                this.showForm = false;
            }
            catch (error) {
                if (error.response.data.errors) {
                    this.errors = error.response.data.errors;
                } else {
                    alert(error.response.data.message || 'An error occurred. Please try again.');
                }
            }

            this.processing = false;
        },
    }
};
</script>
