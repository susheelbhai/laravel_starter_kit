import Button from '@/components/button';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Permission',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const data =
        ((usePage<SharedData>().props as any)?.data as {
            id: number;
            name: string;
            roles: { name: string }[];
        }[]) || [];

    const thead = [
        { title: 'ID', className: 'p-3' },
        { title: 'Name', className: 'p-3' },
        { title: 'Roles', className: 'p-3' },
        { title: 'Action', className: 'p-3' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Permission" />

            <Button href={route('admin.permission.create')}>Add New</Button>

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {data.map((permission) => (
                            <tr key={permission.id} className="border-t border-gray-200">
                                <td className="p-3">{permission.id}</td>
                                <td className="p-3">{permission.name}</td>
                                <td className="p-3">
                                    {permission.roles.map((perm) => (
                                        <span key={perm.name} className="mr-1 mb-1 inline-block rounded bg-gray-200 px-2 py-1 text-xs text-gray-800">
                                            {perm.name}
                                        </span>
                                    ))}
                                </td>
                                <td className="p-3">
                                    <Button href={route('admin.permission.edit', permission.id)}>Edit</Button>
                                </td>
                            </tr>
                        ))}
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
