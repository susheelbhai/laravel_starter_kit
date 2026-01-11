import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: ' User Query',
        href: '/admin/userQuery',
    },
    {
        title: ' Detail',
        href: '',
    },
];

export default function Dashboard() {
    const team =
        ((usePage<SharedData>().props as any)?.data as {
            id: number;
            name: string;
            email: string;
            is_active: number;
            phone: string;
        }) || [];
    const thead = [
        { title: 'User Query Detail', className: 'p-3' },
        { title: '', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="User Query Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Name</td>
                            <td className="p-3">{team.name}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Email</td>
                            <td className="p-3">{team.email}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Phone</td>
                            <td className="p-3">{team.phone}</td>
                        </tr>

                        {/* <tr className="border-y border-gray-200">
                            <td className="p-3" colSpan={2}>
                                <TextLink href={route('admin.userQuery.edit', team.id)}>Edit</TextLink>
                            </td>
                        </tr> */}
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
