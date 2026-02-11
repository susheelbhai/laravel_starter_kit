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
        title: 'Notifications',
        href: '/dashboard',
    },
];

interface NotificationData {
    id: string;
    created_at: string;
    read_at: string | null;
    data: {
        type: string;
        title: string;
    };
}

interface NotificationIndexPageProps extends SharedData {
    data: {
        data: NotificationData[];
        [key: string]: unknown;
    };
}

export default function Notification() {
    const { data } = usePage<NotificationIndexPageProps>().props;
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
                        {items.map((item: NotificationData) => (
                            <tr
                                key={item.id}
                                className={
                                    `border-t border-border hover:bg-muted cursor-pointer` +
                                    (!item.read_at
                                        ? ' bg-white text-foreground'
                                        : ' bg-muted text-muted-foreground')
                                }
                                onClick={() => window.location.assign(route('admin.notification.show', item.id))}
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
