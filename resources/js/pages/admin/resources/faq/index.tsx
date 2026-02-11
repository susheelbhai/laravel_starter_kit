import { Head, usePage } from '@inertiajs/react';
import { Eye } from 'lucide-react';
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
        title: 'Faq',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const data =
        ((usePage<SharedData>().props as SharedData & { data: Array<{ id: number; category: { title: string }; question: string; is_active: number }> })?.data) || [];
    const thead = [
        { title: 'Category', className: 'p-3' },
        { title: 'Question', className: 'p-3' },
        { title: 'Status', className: 'p-3' },
        { title: 'Edit', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Faq" />
            <ButtonCreate href={route('admin.faq.create')} text="Add New" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {data.map((faq) => (
                            <tr key={faq.id} className="border-t border-gray-200">
                                <td className="p-3">{faq.category.title}</td>
                                <td className="p-3">{faq.question}</td>
                                <td className="p-3">{faq.is_active ==1 ? 'active' : 'inactive'}</td>
                                
                                <td className="p-3">
                                     <TextLink href={route('admin.faq.edit', faq.id)}>
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
