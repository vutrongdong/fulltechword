import Vue from 'vue';
import Router from 'vue-router';

import HomeRouter from './HomeRouter.js';
import RoleRouter from './RoleRouter.js';
import SettingRouter from './SettingRouter.js';
import UserRouter from './UserRouter.js';
import CategoryRouter from './CategoryRouter.js';
import BlogRouter from './BlogRouter.js';
import TagRouter from './TagRouter.js';

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: '/admin',
    routes: [
        ...HomeRouter,
        ...RoleRouter,
        ...SettingRouter,
        ...UserRouter,
        ...CategoryRouter,
        ...BlogRouter,
        ...TagRouter
    ],
});
