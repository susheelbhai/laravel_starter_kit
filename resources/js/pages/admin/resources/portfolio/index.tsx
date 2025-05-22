import Button from '@/components/button';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import TextLink from '@/components/text-link';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { Eye } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Portfolio',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const data =
        ((usePage<SharedData>().props as any)?.data as { id: number; name:string;  url: string; is_active: number; logo: string }[]) || [];
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

            <Button href={route('admin.portfolio.create')}>Add New</Button>

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {data.map((portfolio) => (
                            <tr key={portfolio.id} className="border-t border-gray-200">
                                <td className="p-3">{portfolio.name}</td>
                                <td className="p-3">{portfolio.url}</td>
                                <td className="p-3">
                                    <img src={`/storage/${portfolio.logo}`} alt="" width={48} />
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
            </TableCard>
        </AppLayout>
    );
}
