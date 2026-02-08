import { Head, usePage } from '@inertiajs/react';
import { Eye } from 'lucide-react';
import Button from '@/components/button';
import Pagination from '@/components/table/pagination';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import TextLink from '@/components/text-link';
import ButtonCreate from '@/components/ui/button-create';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Team',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const { data } = (usePage<SharedData>().props as any);
    const items = data?.data || [];
    const thead = [
        { title: 'Name', className: 'p-3' },
        { title: 'Designation', className: 'p-3' },
        { title: 'Image', className: 'p-3' },
        { title: 'Status', className: 'p-3' },
        { title: 'View', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Team" />
            <ButtonCreate href={route('admin.team.create')} text="Add New" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {items.map((team: any) => (
                            <tr key={team.id} className="border-t border-gray-200">
                                <td className="p-3">{team.name}</td>
                                <td className="p-3">{team.designation}</td>
                                <td className="p-3">
                                    <img src={team.image_thumb || team.image} alt="" width={48} />
                                </td>
                                <td className="p-3">{team.is_active ==1 ? 'active' : 'inactive'}</td>
                                <td className="p-3">
                                     <TextLink href={route('admin.team.show', team.id)}>
                                        <Eye className="h-4 w-4" />
                                    </TextLink>
                                </td>
                            </tr>
                        ))}
                    </TBody>
                </Table>
                <Pagination data={data} />
            </TableCard>
        </AppLayout>
    );
}
