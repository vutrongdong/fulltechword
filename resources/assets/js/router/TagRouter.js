import Tag from '../components/tag/Index';
import NewTag from '../components/tag/Create';
import EditTag from '../components/tag/Edit';

export default [
    {
        path: '/tags',
        name: 'tag',
        component: Tag
    },
    {
        path: '/tags/create',
        name: 'tag.create',
        component: NewTag
    },
    {
        path: '/tags/edit/:id',
        name: 'tag.edit',
        component: EditTag
    }
];
