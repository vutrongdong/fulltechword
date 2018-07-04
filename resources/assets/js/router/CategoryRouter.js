import Category from '../components/category/Index';
import NewCategory from '../components/category/Create';
import EditCategory from '../components/category/Edit';

export default [
    {
        path: '/categories',
        name: 'category',
        component: Category
    },
    {
        path: '/categories/create',
        name: 'category.create',
        component: NewCategory
    },
    {
        path: '/categories/edit/:id',
        name: 'category.edit',
        component: EditCategory
    }
];
