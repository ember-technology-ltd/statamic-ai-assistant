import Sidebar from './components/Sidebar.vue';

console.log(Statamic);

Statamic.booting(() => {
  Statamic.$components.register('sidebar', Sidebar);
});

Statamic.booted(() => {
  const component = Statamic.$components.append('sidebar', { props: null });
  // console.log(component);
  console.log('done')
});
