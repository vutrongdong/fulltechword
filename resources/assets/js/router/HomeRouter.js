import Home from '../components/Home.vue';
import Profile from '../components/Profile.vue';

export default [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/profile',
        name: 'profile',
        component: Profile
    }
];
