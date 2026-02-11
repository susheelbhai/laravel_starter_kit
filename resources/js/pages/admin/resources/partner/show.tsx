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
        title: 'Partner',
        href: '/admin/partner',
    },
    {
        title: 'Detail',
        href: '/dashboard',
    },
];

interface PartnerData {
    id: number;
    name: string;
    email: string;
    phone: string;
    is_active: number;
    profile_pic: string;
}

interface PartnerShowPageProps extends SharedData {
    data: PartnerData;
}

export default function Dashboard() {
    const team = usePage<PartnerShowPageProps>().props.data || {} as PartnerData;
    const thead = [
        { title: 'Partner Detail', className: 'p-3' },
        { title: '', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Partner Detail" />

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
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Image</td>
                            <td className="p-3">
                                <img
                                    src={`${team.profile_pic}`}
                                    alt=""
                                    width={120}
                                />
                            </td>
                        </tr>
                        <EditRow href={route('admin.partner.edit', team.id)} buttonName="Edit Partner" />

                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
