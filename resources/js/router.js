import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from "./components/ExampleComponent";
import NotesIndex from "./views/NotesIndex";
Vue.use(VueRouter);

export default new VueRouter({
   routes: [{
       path: '/',
       component: ExampleComponent
   }, {
       path: '/notes',
       component: NotesIndex
   }],
   mode: 'history'
});
