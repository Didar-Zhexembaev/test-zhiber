import auth from './middleware/auth';
import guest from './middleware/guest';

export default [
    {
        name: 'home',
        path: '/',
        component: () => import('../pages/Home.vue'),
    },
    {
        name: 'signup',
        path: '/signup',
        component: () => import('../pages/Signup.vue'),
        meta: {
            middleware: [
                guest
            ]
        }
    },
    {
        name: 'signin',
        path: '/signin',
        component: () => import('../pages/Signin.vue'),
        meta: {
            middleware: [
                guest
            ]
        }
    },
    {
        name: 'report',
        path: '/report',
        component: () => import('../pages/Report.vue'),
        meta: {
            middleware: [
                auth
            ]
        },
    },
    {
        path: '/reports',
        component: () => import('../pages/ReportAll.vue'),
        meta: {
            middleware: [
                auth
            ]
        },
    },
    {
        path: '/:pathMatch(.*)*',
        component: () => import('../pages/404.vue'),

    },
];