<template>
    <div class="space-y-2">
        <h3 class="text-grey-80 mt-4">Product description</h3>
        <div v-if="processing">
            <div class="p-8 flex flex-col justify-center items-center">
                <svg class="h-10 animate-spin" fill="currentColor" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.2819 9.8211a5.9847 5.9847 0 0 0-.5157-4.9108 6.0462 6.0462 0 0 0-6.5098-2.9A6.0651 6.0651 0 0 0 4.9807 4.1818a5.9847 5.9847 0 0 0-3.9977 2.9 6.0462 6.0462 0 0 0 .7427 7.0966 5.98 5.98 0 0 0 .511 4.9107 6.051 6.051 0 0 0 6.5146 2.9001A5.9847 5.9847 0 0 0 13.2599 24a6.0557 6.0557 0 0 0 5.7718-4.2058 5.9894 5.9894 0 0 0 3.9977-2.9001 6.0557 6.0557 0 0 0-.7475-7.0729zm-9.022 12.6081a4.4755 4.4755 0 0 1-2.8764-1.0408l.1419-.0804 4.7783-2.7582a.7948.7948 0 0 0 .3927-.6813v-6.7369l2.02 1.1686a.071.071 0 0 1 .038.052v5.5826a4.504 4.504 0 0 1-4.4945 4.4944zm-9.6607-4.1254a4.4708 4.4708 0 0 1-.5346-3.0137l.142.0852 4.783 2.7582a.7712.7712 0 0 0 .7806 0l5.8428-3.3685v2.3324a.0804.0804 0 0 1-.0332.0615L9.74 19.9502a4.4992 4.4992 0 0 1-6.1408-1.6464zM2.3408 7.8956a4.485 4.485 0 0 1 2.3655-1.9728V11.6a.7664.7664 0 0 0 .3879.6765l5.8144 3.3543-2.0201 1.1685a.0757.0757 0 0 1-.071 0l-4.8303-2.7865A4.504 4.504 0 0 1 2.3408 7.872zm16.5963 3.8558L13.1038 8.364 15.1192 7.2a.0757.0757 0 0 1 .071 0l4.8303 2.7913a4.4944 4.4944 0 0 1-.6765 8.1042v-5.6772a.79.79 0 0 0-.407-.667zm2.0107-3.0231l-.142-.0852-4.7735-2.7818a.7759.7759 0 0 0-.7854 0L9.409 9.2297V6.8974a.0662.0662 0 0 1 .0284-.0615l4.8303-2.7866a4.4992 4.4992 0 0 1 6.6802 4.66zM8.3065 12.863l-2.02-1.1638a.0804.0804 0 0 1-.038-.0567V6.0742a4.4992 4.4992 0 0 1 7.3757-3.4537l-.142.0805L8.704 5.459a.7948.7948 0 0 0-.3927.6813zm1.0976-2.3654l2.602-1.4998 2.6069 1.4998v2.9994l-2.5974 1.4997-2.6067-1.4997Z" />
                </svg>
                <div class="leading-loose my-4">Working, please wait...</div>
            </div>
        </div>
        <div v-else-if="result">
            <textarea-input :value="result" :disabled="true" />

            <div class="flex justify-between">
                <button type="button" class="btn" @click="result = null">Try again</button>
                <div class="flex items-center gap-2">
                    <transition name="fade">
                        <div v-if="copied" class="text-xs text-grey-80">copied!</div>
                    </transition>
                    <button type="button" class="btn" @click="copy">Copy to clipboard</button>
                </div>
            </div>
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
            <div class="flex items-center gap-2">
                <button type="button" class="btn" @click="$emit('back')">Back</button>
                <button type="button" class="btn btn-primary" @click="generate">Generate</button>
                <div v-show="processing" class="text-sm text-grey">Loading, please wait...</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            audience: null,
            tone: null,
            product_title: null,
            product_description: null,
            max_words: null,
            processing: false,
            result: null,
            copied: false,
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
                let response = await Statamic.$request.post('/cp/addons/jezzdk/statamic-ai-assistant/product-description', data);

                this.result = response.data;
            }
            catch (error) {
                console.log()
                if (error.response.data.errors) {
                    this.errors = error.response.data.errors;
                } else {
                    alert(error.response.data.message || 'An error occurred. Please try again.');
                }
            }

            this.processing = false;
        },
        copy () {
            if (this.result) {
                navigator.clipboard.writeText(this.result);
            }

            this.copied = true;

            setTimeout(() => {
                this.copied = false;
            }, 3000);
        }
    }
}
</script>

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
.fade-enter-to, .fade-leave {
  opacity: 1;
}
</style>
