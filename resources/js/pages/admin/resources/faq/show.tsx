import EditRow from '@/components/table/edit-row';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import TextLink from '@/components/text-link';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Faq',
        href: '/admin/faq',
    },
    {
        title: 'Faq Detail',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const faq =
        ((usePage<SharedData>().props as any)?.data as {
            id: number;
            name: string;
            designation: string;
            organisation: string;
            message: string;
            is_active: number;
            image: string;
        }) || [];
    const thead = [
        { title: 'Faq Detail', className: 'p-3' },
        { title: '', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Faq Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Name</td>
                            <td className="p-3">{faq.name}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Designation</td>
                            <td className="p-3">{faq.designation}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Organisation</td>
                            <td className="p-3">{faq.organisation}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Message</td>
                            <td className="p-3">{faq.message}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Image</td>
                            <td className="p-3">
                                <img src={`${faq.image}`} alt="" width={320} />
                            </td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Status</td>
                            <td className="p-3">{faq.is_active == 1 ? 'active' : 'inactive'}</td>
                        </tr>
                        <EditRow href={route('admin.faq.edit', faq.id)} buttonName="Edit Faq" />

                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
