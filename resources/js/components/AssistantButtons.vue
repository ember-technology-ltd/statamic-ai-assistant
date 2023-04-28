<template>
    <div>
        <div class="flex items-center gap-2 mt-4">
            <button type="button" class="btn" @click="$emit('cancel')">Back</button>
            <button type="button" class="btn btn-primary" @click="$emit('submit')">Generate</button>
            <div v-show="processing" class="text-sm text-grey">Loading, please wait...</div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['processing'],
}
</script>
