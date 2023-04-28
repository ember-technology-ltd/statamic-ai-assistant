import AssistantSidebar from './components/AssistantSidebar.vue';
import AssistantSpinner from './components/AssistantSpinner.vue';
import AssistantResult from './components/AssistantResult.vue';
import AssistantButtons from './components/AssistantButtons.vue';

Statamic.booting(() => {
  Statamic.$components.register('assistant-sidebar', AssistantSidebar);
  Statamic.$components.register('assistant-spinner', AssistantSpinner);
  Statamic.$components.register('assistant-result', AssistantResult);
  Statamic.$components.register('assistant-buttons', AssistantButtons);
});

Statamic.booted(() => {
  const component = Statamic.$components.append('assistant-sidebar', { props: null });
  // console.log(component);
});
