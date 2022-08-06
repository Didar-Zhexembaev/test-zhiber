import { createRouter, createWebHistory } from 'vue-router';
import routes from './routes';
import store from '../store';
import middlewarePipeline from './middleware/pipeline';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
});

router.beforeEach((to, from, next) => {
    if (store.getters.flashMessage) {
        store.dispatch('flashMessage', '');
    }

    if (!to.meta.middleware) {
        return next();
    }
    const middleware = to.meta.middleware;

    const context = {
        to,
        from,
        next,
        store
    };

    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1)
    });
});

export default router;