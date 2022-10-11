import './bootstrap';
import '../css/app.css';
import 'ant-design-vue/dist/antd.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { Link } from '@inertiajs/inertia-vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Layout from "./Shared/Layout.vue"
import Antd from "ant-design-vue";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        let page = resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'));
        page.then((module) => {
            module.default.layout = module.default.layout || Layout
        })
        return page;
    },
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Antd)
            .component('Link', Link)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
