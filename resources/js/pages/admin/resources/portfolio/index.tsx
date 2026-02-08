import { Head, usePage } from '@inertiajs/react';
import { Eye } from 'lucide-react';
import Button from '@/components/button';
import Pagination from '@/components/table/pagination';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import TextLink from '@/components/text-link';
import ButtonCreate from '@/components/ui/button-create';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Portfolio',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const { data } = (usePage<SharedData>().props as any);
    const items = data?.data || [];
    const thead = [
        { title: 'Name', className: 'p-3' },
        { title: 'Url', className: 'p-3' },
        { title: 'Logo', className: 'p-3' },
        { title: 'Status', className: 'p-3' },
        { title: 'View', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Portfolio" />
            <ButtonCreate href={route('admin.portfolio.create')} text="Add New" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {items.map((portfolio: any) => (
                            <tr key={portfolio.id} className="border-t border-gray-200">
                                <td className="p-3">{portfolio.name}</td>
                                <td className="p-3">{portfolio.url}</td>
                                <td className="p-3">
                                    <img src={`${portfolio.logo}`} alt="" width={48} />
                                </td>
                                <td className="p-3">{portfolio.is_active ==1 ? 'active' : 'inactive'}</td>
                                <td className="p-3">
                                     <TextLink href={route('admin.portfolio.show', portfolio.id)}>
                                        <Eye className="h-4 w-4" />
                                    </TextLink>
                                </td>
                            </tr>
                        ))}
                    </TBody>
                </Table>
                <Pagination data={data} />
            </TableCard>
        </AppLayout>
    );
}
