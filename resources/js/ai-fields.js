import ProductDescription from './components/ProductDescriptionFieldtype.vue';

Statamic.booting(() => {
    Statamic.$components.register('product_description-fieldtype', ProductDescription);
});
