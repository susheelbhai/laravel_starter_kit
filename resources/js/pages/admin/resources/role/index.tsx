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
        title: 'Role',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const data =
        ((usePage<SharedData>().props as any)?.data as {
            id: number;
            name: string;
            permissions: { name: string }[];
        }[]) || [];

    const thead = [
        { title: 'ID', className: 'p-3' },
        { title: 'Name', className: 'p-3' },
        { title: 'Permissions', className: 'p-3' },
        { title: 'Action', className: 'p-3' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Role" />

            <Button href={route('admin.role.create')}>Add New</Button>

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {data.map((role) => (
                            <tr key={role.id} className="border-t border-gray-200">
                                <td className="p-3">{role.id}</td>
                                <td className="p-3">{role.name}</td>
                                <td className="p-3">
                                    {role.permissions.map((perm) => (
                                        <span
                                            key={perm.name}
                                            className="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded mr-1 mb-1"
                                        >
                                            {perm.name}
                                        </span>
                                    ))}
                                </td>
                                <td className="">
                                    <Button href={route('admin.role.edit', role.id)}>
                                        Edit
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
