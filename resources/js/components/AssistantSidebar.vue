<template>
    <div class="fixed top-1/2 right-0">
        <div class="bg-white rounded-l-full border-l border-t border-b border-grey-50">
            <button type="button" class="flex items-center pl-2 pr-1 py-2 focus:outline-none text-grey-100" @click="showForm = !showForm">
                <svg fill="currentColor" class="w-5 h-5 hover:animate-spin" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.2819 9.8211a5.9847 5.9847 0 0 0-.5157-4.9108 6.0462 6.0462 0 0 0-6.5098-2.9A6.0651 6.0651 0 0 0 4.9807 4.1818a5.9847 5.9847 0 0 0-3.9977 2.9 6.0462 6.0462 0 0 0 .7427 7.0966 5.98 5.98 0 0 0 .511 4.9107 6.051 6.051 0 0 0 6.5146 2.9001A5.9847 5.9847 0 0 0 13.2599 24a6.0557 6.0557 0 0 0 5.7718-4.2058 5.9894 5.9894 0 0 0 3.9977-2.9001 6.0557 6.0557 0 0 0-.7475-7.0729zm-9.022 12.6081a4.4755 4.4755 0 0 1-2.8764-1.0408l.1419-.0804 4.7783-2.7582a.7948.7948 0 0 0 .3927-.6813v-6.7369l2.02 1.1686a.071.071 0 0 1 .038.052v5.5826a4.504 4.504 0 0 1-4.4945 4.4944zm-9.6607-4.1254a4.4708 4.4708 0 0 1-.5346-3.0137l.142.0852 4.783 2.7582a.7712.7712 0 0 0 .7806 0l5.8428-3.3685v2.3324a.0804.0804 0 0 1-.0332.0615L9.74 19.9502a4.4992 4.4992 0 0 1-6.1408-1.6464zM2.3408 7.8956a4.485 4.485 0 0 1 2.3655-1.9728V11.6a.7664.7664 0 0 0 .3879.6765l5.8144 3.3543-2.0201 1.1685a.0757.0757 0 0 1-.071 0l-4.8303-2.7865A4.504 4.504 0 0 1 2.3408 7.872zm16.5963 3.8558L13.1038 8.364 15.1192 7.2a.0757.0757 0 0 1 .071 0l4.8303 2.7913a4.4944 4.4944 0 0 1-.6765 8.1042v-5.6772a.79.79 0 0 0-.407-.667zm2.0107-3.0231l-.142-.0852-4.7735-2.7818a.7759.7759 0 0 0-.7854 0L9.409 9.2297V6.8974a.0662.0662 0 0 1 .0284-.0615l4.8303-2.7866a4.4992 4.4992 0 0 1 6.6802 4.66zM8.3065 12.863l-2.02-1.1638a.0804.0804 0 0 1-.038-.0567V6.0742a4.4992 4.4992 0 0 1 7.3757-3.4537l-.142.0805L8.704 5.459a.7948.7948 0 0 0-.3927.6813zm1.0976-2.3654l2.602-1.4998 2.6069 1.4998v2.9994l-2.5974 1.4997-2.6067-1.4997Z" />
                </svg>
            </button>
        </div>

        <stack name="inline-editor" v-if="showForm" @closed="showForm = false">
            <div class="bg-white h-screen overflow-auto relative p-4">
                <div class="flex justify-between items-center">
                    <h1>Hi, I'm your AI assistant</h1>
                    <div class="flex items-center gap-2 text-grey-70">
                        <span class="text-sm leading-loose">Powered by</span>
                        <a href="https://openai.com/" target="_blank" class="inline-flex items-center text-gray-70">
                            <svg class="h-6" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1180 320">
                                <g fill="currentColor" data-v-22ee7e7c="">
                                    <path d="m367.44 153.84c0 52.32 33.6 88.8 80.16 88.8s80.16-36.48 80.16-88.8-33.6-88.8-80.16-88.8-80.16 36.48-80.16 88.8zm129.6 0c0 37.44-20.4 61.68-49.44 61.68s-49.44-24.24-49.44-61.68 20.4-61.68 49.44-61.68 49.44 24.24 49.44 61.68z"></path>
                                    <path d="m614.27 242.64c35.28 0 55.44-29.76 55.44-65.52s-20.16-65.52-55.44-65.52c-16.32 0-28.32 6.48-36.24 15.84v-13.44h-28.8v169.2h28.8v-56.4c7.92 9.36 19.92 15.84 36.24 15.84zm-36.96-69.12c0-23.76 13.44-36.72 31.2-36.72 20.88 0 32.16 16.32 32.16 40.32s-11.28 40.32-32.16 40.32c-17.76 0-31.2-13.2-31.2-36.48z"></path>
                                    <path d="m747.65 242.64c25.2 0 45.12-13.2 54-35.28l-24.72-9.36c-3.84 12.96-15.12 20.16-29.28 20.16-18.48 0-31.44-13.2-33.6-34.8h88.32v-9.6c0-34.56-19.44-62.16-55.92-62.16s-60 28.56-60 65.52c0 38.88 25.2 65.52 61.2 65.52zm-1.44-106.8c18.24 0 26.88 12 27.12 25.92h-57.84c4.32-17.04 15.84-25.92 30.72-25.92z"></path>
                                    <path d="m823.98 240h28.8v-73.92c0-18 13.2-27.6 26.16-27.6 15.84 0 22.08 11.28 22.08 26.88v74.64h28.8v-83.04c0-27.12-15.84-45.36-42.24-45.36-16.32 0-27.6 7.44-34.8 15.84v-13.44h-28.8z"></path>
                                    <path d="m1014.17 67.68-65.28 172.32h30.48l14.64-39.36h74.4l14.88 39.36h30.96l-65.28-172.32zm16.8 34.08 27.36 72h-54.24z"></path>
                                    <path d="m1163.69 68.18h-30.72v172.32h30.72z"></path>
                                    <path d="m297.06 130.97c7.26-21.79 4.76-45.66-6.85-65.48-17.46-30.4-52.56-46.04-86.84-38.68-15.25-17.18-37.16-26.95-60.13-26.81-35.04-.08-66.13 22.48-76.91 55.82-22.51 4.61-41.94 18.7-53.31 38.67-17.59 30.32-13.58 68.54 9.92 94.54-7.26 21.79-4.76 45.66 6.85 65.48 17.46 30.4 52.56 46.04 86.84 38.68 15.24 17.18 37.16 26.95 60.13 26.8 35.06.09 66.16-22.49 76.94-55.86 22.51-4.61 41.94-18.7 53.31-38.67 17.57-30.32 13.55-68.51-9.94-94.51zm-120.28 168.11c-14.03.02-27.62-4.89-38.39-13.88.49-.26 1.34-.73 1.89-1.07l63.72-36.8c3.26-1.85 5.26-5.32 5.24-9.07v-89.83l26.93 15.55c.29.14.48.42.52.74v74.39c-.04 33.08-26.83 59.9-59.91 59.97zm-128.84-55.03c-7.03-12.14-9.56-26.37-7.15-40.18.47.28 1.3.79 1.89 1.13l63.72 36.8c3.23 1.89 7.23 1.89 10.47 0l77.79-44.92v31.1c.02.32-.13.63-.38.83l-64.41 37.19c-28.69 16.52-65.33 6.7-81.92-21.95zm-16.77-139.09c7-12.16 18.05-21.46 31.21-26.29 0 .55-.03 1.52-.03 2.2v73.61c-.02 3.74 1.98 7.21 5.23 9.06l77.79 44.91-26.93 15.55c-.27.18-.61.21-.91.08l-64.42-37.22c-28.63-16.58-38.45-53.21-21.95-81.89zm221.26 51.49-77.79-44.92 26.93-15.54c.27-.18.61-.21.91-.08l64.42 37.19c28.68 16.57 38.51 53.26 21.94 81.94-7.01 12.14-18.05 21.44-31.2 26.28v-75.81c.03-3.74-1.96-7.2-5.2-9.06zm26.8-40.34c-.47-.29-1.3-.79-1.89-1.13l-63.72-36.8c-3.23-1.89-7.23-1.89-10.47 0l-77.79 44.92v-31.1c-.02-.32.13-.63.38-.83l64.41-37.16c28.69-16.55 65.37-6.7 81.91 22 6.99 12.12 9.52 26.31 7.15 40.1zm-168.51 55.43-26.94-15.55c-.29-.14-.48-.42-.52-.74v-74.39c.02-33.12 26.89-59.96 60.01-59.94 14.01 0 27.57 4.92 38.34 13.88-.49.26-1.33.73-1.89 1.07l-63.72 36.8c-3.26 1.85-5.26 5.31-5.24 9.06l-.04 89.79zm14.63-31.54 34.65-20.01 34.65 20v40.01l-34.65 20-34.65-20z"></path>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>

                <template v-if="!tool">
                    <h3 class="text-grey-80 mt-4">Select the tool you wish to use.</h3>

                    <div class="grid grid-cols-3 gap-4 mt-4">
                        <div class="border border-grey-40 rounded-lg p-4 hover:bg-grey-10 cursor-pointer" @click="tool = 'idea_generator'">
                            <h3>Idea generator</h3>
                            <p class="text-grey-70 text-sm mt-2">Find some ideas for your next article.</p>
                        </div>
                        <div class="border border-grey-40 rounded-lg p-4 hover:bg-grey-10 cursor-pointer" @click="tool = 'outliner'">
                            <h3>Outliner</h3>
                            <p class="text-grey-70 text-sm mt-2">Create an outline for an article based on a short summary.</p>
                        </div>
                        <div class="border border-grey-40 rounded-lg p-4 hover:bg-grey-10 cursor-pointer" @click="tool = 'intro_text'">
                            <h3>Intro</h3>
                            <p class="text-grey-70 text-sm mt-2">Create a compelling intro from an article title.</p>
                        </div>
                        <div class="border border-grey-40 rounded-lg p-4 hover:bg-grey-10 cursor-pointer" @click="tool = 'summarizer'">
                            <h3>Summarizer</h3>
                            <p class="text-grey-70 text-sm mt-2">Create a summary of a large piece of text.</p>
                        </div>
                        <div class="border border-grey-40 rounded-lg p-4 hover:bg-grey-10 cursor-pointer" @click="tool = 'rephraser'">
                            <h3>Rephrase tool</h3>
                            <p class="text-grey-70 text-sm mt-2">Not satisfied with your text? Rephrase it to something slightly (or completely) different.</p>
                        </div>
                        <div class="border border-grey-40 rounded-lg p-4 hover:bg-grey-10 cursor-pointer" @click="tool = 'grammar_check'">
                            <h3>Grammar check</h3>
                            <p class="text-grey-70 text-sm mt-2">Check your text for grammatical errors and have them fixed.</p>
                        </div>
                        <div class="border border-grey-40 rounded-lg p-4 hover:bg-grey-10 cursor-pointer" @click="tool = 'copywriting'">
                            <h3>Copywriting by formula</h3>
                            <p class="text-grey-70 text-sm mt-2">Create text based on the AIDA or QUEST formula.</p>
                        </div>
                        <div class="border border-grey-40 rounded-lg p-4 hover:bg-grey-10 cursor-pointer" @click="tool = 'product_headlines'">
                            <h3>Product headlines</h3>
                            <p class="text-grey-70 text-sm mt-2">Create product headlines that stands out.</p>
                        </div>
                        <div class="border border-grey-40 rounded-lg p-4 hover:bg-grey-10 cursor-pointer" @click="tool = 'product_description'">
                            <h3>Product description</h3>
                            <p class="text-grey-70 text-sm mt-2">Create an engaging product description tailored to your audience.</p>
                        </div>
                        <div class="border border-grey-40 rounded-lg p-4 hover:bg-grey-10 cursor-pointer" @click="tool = 'category_description'">
                            <h3>Category description</h3>
                            <p class="text-grey-70 text-sm mt-2">Create an engaging category description tailored to your audience.</p>
                        </div>
                        <div class="border border-grey-40 rounded-lg p-4 hover:bg-grey-10 cursor-pointer" @click="tool = 'call_to_action'">
                            <h3>Call-to-action</h3>
                            <p class="text-grey-70 text-sm mt-2">Make great call-to-action text for your product.</p>
                        </div>
                    </div>
                </template>

                <template v-if="tool === 'idea_generator'">
                    <idea-generator @back="tool = null" />
                </template>
                <template v-if="tool === 'outliner'">
                    <outliner @back="tool = null" />
                </template>
                <template v-if="tool === 'intro_text'">
                    <intro-text @back="tool = null" />
                </template>
                <template v-if="tool === 'summarizer'">
                    <summarizer @back="tool = null" />
                </template>
                <template v-if="tool === 'rephraser'">
                    <rephraser @back="tool = null" />
                </template>
                <template v-if="tool === 'grammar_check'">
                    <grammar-check @back="tool = null" />
                </template>
                <template v-if="tool === 'copywriting'">
                    <copywriting @back="tool = null" />
                </template>
                <template v-if="tool === 'product_headlines'">
                    <product-headlines @back="tool = null" />
                </template>
                <template v-if="tool === 'product_description'">
                    <product-description @back="tool = null" />
                </template>
                <template v-if="tool === 'category_description'">
                    <category-description @back="tool = null" />
                </template>
                <template v-if="tool === 'call_to_action'">
                    <call-to-action @back="tool = null" />
                </template>
            </div>
        </stack>
    </div>
</template>

<script>
import IdeaGenerator from './Tools/IdeaGenerator.vue';
import Outliner from './Tools/Outliner.vue';
import IntroText from './Tools/IntroText.vue';
import Summarizer from './Tools/Summarizer.vue';
import Rephraser from './Tools/Rephraser.vue';
import GrammarCheck from './Tools/GrammarCheck.vue';
import Copywriting from './Tools/Copywriting.vue';
import ProductHeadlines from './Tools/ProductHeadlines.vue';
import ProductDescription from './Tools/ProductDescription.vue';
import CategoryDescription from './Tools/CategoryDescription.vue';
import CallToAction from './Tools/CallToAction.vue';

export default {
    components: {
        'idea-generator': IdeaGenerator,
        'outliner': Outliner,
        'intro-text': IntroText,
        'summarizer': Summarizer,
        'rephraser': Rephraser,
        'grammar-check': GrammarCheck,
        'copywriting': Copywriting,
        'product-headlines': ProductHeadlines,
        'product-description': ProductDescription,
        'category-description': CategoryDescription,
        'call-to-action': CallToAction,
    },
    data() {
        return {
            showForm: false,
            tool: null,
        }
    },
    mounted() {
        //
    },
};
</script>

<style>
.top-1\/2 {
    top: 50%;
}
</style>
