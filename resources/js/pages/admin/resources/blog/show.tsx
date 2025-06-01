import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import TextLink from '@/components/text-link';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Blog',
        href: '/admin/blog',
    },
    {
        title: 'Blog Detail',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const blog =
        ((usePage<SharedData>().props as any)?.data as {
            id: number;
            title: string;
            author: string;
            tags: string;
            short_description: string;
            long_description1: string;
            long_description2: string;
            long_description3: string;
            highlighted_text1: string;
            highlighted_text2: string;
            category: string;
            is_active: number;
            display_img: string;
            ad_img: string;
        }) || [];
    const thead = [
        { title: 'Blog Detail', className: 'p-3' },
        { title: '', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Blog Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Title</td>
                            <td className="p-3">{blog.title}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Author</td>
                            <td className="p-3">{blog.author}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Tags</td>
                            <td className="p-3">{blog.tags}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">category</td>
                            <td className="p-3">{blog.category}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Short Description</td>
                            <td className="p-3">{blog.short_description}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Long Description 1</td>
                            <td className="p-3">
                                <div dangerouslySetInnerHTML={{ __html: blog.long_description1 }} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Long Description 2</td>
                            <td className="p-3">
                                <div dangerouslySetInnerHTML={{ __html: blog.long_description2 }} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Long Description 3</td>
                            <td className="p-3">
                                <div dangerouslySetInnerHTML={{ __html: blog.long_description3 }} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Hilighted Text 1</td>
                            <td className="p-3">{blog.highlighted_text1}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Hilighted Text 2</td>
                            <td className="p-3">{blog.highlighted_text2}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Image</td>
                            <td className="p-3">
                                <img src={blog.display_img} alt="" width={320} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Ad Image</td>
                            <td className="p-3">
                                <img src={blog.ad_img} alt="" width={320} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Status</td>
                            <td className="p-3">{blog.is_active == 1 ? 'active' : 'inactive'}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">category</td>
                            <td className="p-3">
                                <TextLink href={route('admin.blog.edit', blog.id)}>Edit</TextLink>
                            </td>
                        </tr>
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
