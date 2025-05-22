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
        title: 'Portfolio',
        href: '/admin/portfolio',
    },
    {
        title: 'Portfolio Detail',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const portfolio =
        ((usePage<SharedData>().props as any)?.data as {
            id: number;
            name: string;
            url: string;
            is_active: number;
            logo: string;
        }) || [];
    const thead = [
        { title: 'Portfolio Detail', className: 'p-3' },
        { title: '', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Portfolio Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Name</td>
                            <td className="p-3">{portfolio.name}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Url</td>
                            <td className="p-3">{portfolio.url}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Logo</td>
                            <td className="p-3">
                                <img src={`/storage/${portfolio.logo}`} alt="" width={320} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Status</td>
                            <td className="p-3">{portfolio.is_active == 1 ? 'active' : 'inactive'}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3" colSpan={2}>
                                <TextLink href={route('admin.portfolio.edit', portfolio.id)}>Edit</TextLink>
                            </td>
                        </tr>
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
