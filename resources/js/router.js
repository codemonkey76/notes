import Vue from 'vue';
import VueRouter from 'vue-router';
import NotesIndex from "./views/NotesIndex";
Vue.use(VueRouter);

export default new VueRouter({
   routes: [{
       path: '/',
       component: NotesIndex
   }, {
       path: '/notes',
       component: NotesIndex
   }],
   mode: 'history'
});
