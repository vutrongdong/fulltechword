import Vue from 'vue';
import Router from 'vue-router';
import { concat } from 'lodash';

import HomeRouter from './HomeRouter.js';
import RoleRouter from './RoleRouter.js';
import SettingRouter from './SettingRouter.js';
import UserRouter from './UserRouter.js';

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: '/admin',
    routes: concat(HomeRouter, RoleRouter, SettingRouter, UserRouter),
});
