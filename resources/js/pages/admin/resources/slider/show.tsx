import { Head, usePage } from '@inertiajs/react';
import EditRow from '@/components/table/edit-row';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import TextLink from '@/components/text-link';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Slider',
        href: '/admin/slider1',
    },
    {
        title: 'Slider Detail',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const slider =
        ((usePage<SharedData>().props as any)?.data as {
            id: number;
            name: string;
            url: string;
            is_active: number;
            logo: string;
        }) || [];
    const thead = [
        { title: 'Slider Detail', className: 'p-3' },
        { title: '', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Slider Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Name</td>
                            <td className="p-3">{slider.name}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Url</td>
                            <td className="p-3">{slider.url}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Logo</td>
                            <td className="p-3">
                                <img src={`/storage/${slider.logo}`} alt="" width={320} />
                            </td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Status</td>
                            <td className="p-3">{slider.is_active == 1 ? 'active' : 'inactive'}</td>
                        </tr>
                        <EditRow href={route('admin.slider.edit', slider.id)} />

                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
