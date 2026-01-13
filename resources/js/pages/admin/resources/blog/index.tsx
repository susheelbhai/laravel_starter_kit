import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import TextLink from '@/components/text-link';
import ButtonCreate from '@/components/ui/button-create';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { Eye } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Blog',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const data =
        ((usePage<SharedData>().props as any)?.data as { id: number; title:string; short_description: string; category: string; is_active: number; display_img: string }[]) || [];
    const thead = [
        { title: 'Title', className: 'p-3' },
        { title: 'Category', className: 'p-3' },
        { title: 'Description', className: 'p-3' },
        { title: 'Image', className: 'p-3' },
        { title: 'Status', className: 'p-3' },
        { title: 'View', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Blog" />
            <ButtonCreate href={route('admin.blog.create')} text="Add New" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {data.map((blog) => (
                            <tr key={blog.id} className="border-t border-gray-200">
                                <td className="p-3">{blog.title}</td>
                                <td className="p-3">{blog.category}</td>
                                <td className="p-3">{blog.short_description}</td>
                                <td className="p-3">
                                    <img src={`${blog.display_img}`} alt="" width={48} />
                                </td>
                                <td className="p-3">{blog.is_active ==1 ? 'active' : 'inactive'}</td>
                                <td className="p-3">
                                     <TextLink href={route('admin.blog.show', blog.id)}>
                                        <Eye className="h-4 w-4" />
                                    </TextLink>
                                </td>
                            </tr>
                        ))}
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
