import Role from '../components/Role';
import NewRole from '../components/NewRole';

export default [
    {
        path: '/role',
        name: 'role',
        component: Role
    },
    {
        path: '/role/create',
        name: 'role.create',
        component: NewRole
    },
    {
        path: '/role/:id/edit',
        name: 'role.edit',
        component: NewRole
    }
];
