import { createApp} from "vue";
import App from './src/App.vue'
import router from "@/router/router.js";
import store from "@/store/store.js";
import components from "@/components/UI"
import "@/assets/styles/style_v12.css"


const app = createApp(App)

components.forEach(component => {
    app.component(component.name, component)
})

app
    .use(router)
    .use(store)
    .mount('#app')


