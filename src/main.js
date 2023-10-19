import { createApp } from 'vue'
import App from './App'
import components from "@/components/UI"
import router from "@/router/router"
import store from "@/store"
// import axios from "axios";
// import VIntersection from "@/directives/VIntersection"
import directives from '@/directives'
// import QuillEditor from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

// Регистрация Quill как глобального компонента

import '@/assets/styles/style_v1.css'
// import '@/assets/styles/multiselect-styles.css';
// import multiselect from 'vue-multiselect'



const app = createApp(App)
// app.component('QuillEditor', QuillEditor)

components.forEach(component => {
    app.component(component.name, component)
})
directives.forEach(directive => {
    app.directive(directive.name, directive)
})

app
    .use(router)
    .use(store)
    .mount('#app')
