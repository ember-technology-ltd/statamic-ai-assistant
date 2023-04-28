<template>
    <div>
        <textarea-input :value="result" />

        <div class="flex justify-between mt-2">
            <button type="button" class="btn" @click="$emit('cancel')">Try again</button>
            <div class="flex items-center gap-2">
                <div v-if="copied" class="text-xs text-grey-80">copied!</div>
                <button type="button" class="btn" @click="copy">Copy to clipboard</button>
            </div>
        </div>

        <div class="my-4 text-sm text-grey-60 text-center">
            Disclaimer: The generated text is for inspiration only and should not be used as is. It is your responsibility to ensure that the generated text is in compliance with your local laws and regulations.
        </div>
    </div>
</template>

<script>
export default {
    props: ['result'],
    data() {
		return {
			copied: false,
		}
	},
    methods: {
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
