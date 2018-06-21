import User from '../components/User';
import NewUser from '../components/NewUser';

export default [
    {
        path: '/users',
        name: 'user',
        component: User
    },
    {
        path: '/users/create',
        name: 'user.create',
        component: NewUser
    }
];
