import { Head, usePage } from '@inertiajs/react';
import Pagination from '@/components/table/pagination';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import AppLayout from '@/layouts/partner/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Notifications',
        href: '/dashboard',
    },
];

export default function Notification() {
    const { data } = (usePage<SharedData>().props as any);
    const items = data?.data || [];
    const thead = [
        { title: 'Date', className: 'p-3' },
        { title: 'Category', className: 'p-3' },
        { title: 'Title', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Notifications" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {items.map((item: any) => (
                            <tr
                                key={item.id}
                                className="border-t border-gray-200 hover:bg-gray-50 cursor-pointer"
                                onClick={() => window.location.assign(route('partner.notification.show', item.id))}
                                tabIndex={0}
                                style={{ transition: 'background 0.2s' }}
                            >
                                <td className="p-3">{item.created_at}</td>
                                <td className="p-3">{item.data.type}</td>
                                <td className="p-3">{item.data.title}</td>
                               
                            </tr>
                        ))}
                    </TBody>
                </Table>
                <Pagination data={data} />
            </TableCard>
        </AppLayout>
    );
}
