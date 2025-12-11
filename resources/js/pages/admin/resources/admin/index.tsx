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
        title: 'Admin',
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
        <AppLayout breadcrumbs={breadcrumbs} title="Admin">
            <ButtonCreate href={route('admin.admin.create')} text="Add New" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {data.map((admin) => (
                            <tr key={admin.id} className="border-t border-gray-200">
                                <td className="p-3">{admin.id}</td>
                                <td className="p-3">{admin.name}</td>
                                <td className="p-3">{admin.email}</td>
                                <td className="p-3">{admin.phone}</td>
                                <td className="p-3 w-3">
                                    <img src={admin.profile_pic} alt="" className="h-10 w-10 rounded-full object-cover" />
                                </td>
                                <td className="p-3">
                                    <Button href={route('admin.admin.show', admin.id)}>
                                        View
                                    </Button>
                                </td>
                            </tr>
                        ))}
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
