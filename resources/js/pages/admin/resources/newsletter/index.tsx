import { Head, usePage } from '@inertiajs/react';
import Pagination from '@/components/table/pagination';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Newsletter',
        href: '/admin',
    },
];

export default function Dashboard() {
    const { data } = (usePage<SharedData>().props as any);
    const items = data?.data || [];
    const thead = [
        { title: 'ID', className: 'p-3' },
        { title: 'Email', className: 'p-3' },
        { title: 'Status', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Newsletter" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {items.map((user: any) => (
                            <tr
                                key={user.id}
                                className="border-t border-gray-200"
                            >
                                <td className="p-3">{user.id}</td>
                                <td className="p-3">{user.email}</td>
                                <td className="p-3">
                                    {user.is_active == 1
                                        ? 'active'
                                        : 'inactive'}
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
