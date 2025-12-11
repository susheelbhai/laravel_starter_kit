import Button from '@/components/button';
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
        title: 'Important Link',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const data =
        ((usePage<SharedData>().props as any)?.data as { id: number; name:string; href: string; is_active: number; display_img: string }[]) || [];
    const thead = [
        { title: 'Name', className: 'p-3' },
        { title: 'Href', className: 'p-3' },
        { title: 'Status', className: 'p-3' },
        { title: 'View', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Important Link" />

            <ButtonCreate href={route('admin.important_links.create')} text="Add New" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {data.map((important_links) => (
                            <tr key={important_links.id} className="border-t border-gray-200">
                                <td className="p-3">{important_links.name}</td>
                                <td className="p-3">{important_links.href}</td>
                               
                                <td className="p-3">{important_links.is_active ==1 ? 'active' : 'inactive'}</td>
                                <td className="p-3">
                                     <TextLink href={route('admin.important_links.show', important_links.id)}>
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
