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
        title: 'Important Link',
        href: '/admin/important_links',
    },
    {
        title: 'Important Link Detail',
        href: '/dashboard',
    },
];

interface ImportantLinkData {
    id: number;
    name: string;
    href: string;
    is_active: number;
}

interface ImportantLinkShowPageProps extends SharedData {
    data: ImportantLinkData;
}

export default function Dashboard() {
    const important_links = usePage<ImportantLinkShowPageProps>().props.data || {} as ImportantLinkData;
    const thead = [
        { title: 'Important Link Detail', className: 'p-3' },
        { title: '', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Important Link Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Title</td>
                            <td className="p-3">{important_links.name}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Href</td>
                            <td className="p-3">{important_links.href}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Status</td>
                            <td className="p-3">{important_links.is_active == 1 ? 'active' : 'inactive'}</td>
                        </tr>
                        <EditRow href={route('admin.important_links.edit', important_links.id)} buttonName="Edit Important Link" />
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
