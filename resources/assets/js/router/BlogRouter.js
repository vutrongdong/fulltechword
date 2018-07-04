import Blog from '../components/blog/Index';
import NewBlog from '../components/blog/Create';
import EditBlog from '../components/blog/Edit';

export default [
    {
        path: '/blogs',
        name: 'blog',
        component: Blog
    },
    {
        path: '/blogs/create',
        name: 'blog.create',
        component: NewBlog
    },
    {
        path: '/blogs/edit/:id',
        name: 'blog.edit',
        component: EditBlog
    }
];
