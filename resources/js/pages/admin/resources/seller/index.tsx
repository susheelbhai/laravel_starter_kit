import Button from '@/components/button';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import ButtonCreate from '@/components/ui/button-create';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Seller',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const data =
        ((usePage<SharedData>().props as any)?.data as { id: number; name: string; email: string; phone: string; profile_pic: string }[]) || [];
    const thead = [
        { title: 'ID', className: 'p-3' },
        { title: 'Name', className: 'p-3' },
        { title: 'Email', className: 'p-3' },
        { title: 'Phone', className: 'p-3' },
        { title: 'Photo', className: 'p-3' },
        { title: 'View', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Seller" />
            <ButtonCreate href={route('admin.seller.create')} text="Add New" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {data.map((user) => (
                            <tr key={user.id} className="border-t border-gray-200">
                                <td className="p-3">{user.id}</td>
                                <td className="p-3">{user.name}</td>
                                <td className="p-3">{user.email}</td>
                                <td className="p-3">{user.phone}</td>
                                <td className="p-3">
                                    <img src={user.profile_pic} alt="" className="h-10 w-10 rounded-full object-cover" />
                                </td>
                                <td className="p-3">
                                    <Button href={route('admin.seller.show', user.id)}>View</Button>
                                </td>
                            </tr>
                        ))}
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
