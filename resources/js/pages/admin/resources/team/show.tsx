import { Head, usePage } from '@inertiajs/react';
import EditRow from '@/components/table/edit-row';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Team',
        href: '/admin/team',
    },
    {
        title: 'Team Detail',
        href: '/dashboard',
    },
];

interface TeamData {
    id: number;
    name: string;
    designation: string;
    is_active: number;
    image: string;
}

interface TeamShowPageProps extends SharedData {
    data: TeamData;
}

export default function Dashboard() {
    const team = usePage<TeamShowPageProps>().props.data || {} as TeamData;
    const thead = [
        { title: 'Team Detail', className: 'p-3' },
        { title: '', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Team Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Name</td>
                            <td className="p-3">{team.name}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Designation</td>
                            <td className="p-3">{team.designation}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Image</td>
                            <td className="p-3">
                                <img src={`${team.image}`} alt="" width={320} />
                            </td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Status</td>
                            <td className="p-3">{team.is_active == 1 ? 'active' : 'inactive'}</td>
                        </tr>
                        <EditRow href={route('admin.team.edit', team.id)}>Edit</EditRow>

                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
