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
        title: 'Slider',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const data =
        ((usePage<SharedData>().props as any)) || [];
    const thead = [
        { title: 'Name', className: 'p-3' },
        { title: 'Url', className: 'p-3' },
        { title: 'Logo', className: 'p-3' },
        { title: 'Status', className: 'p-3' },
        { title: 'View', className: 'p-3' },
    ];
    console.log(data.slider1);
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Slider" />

            <Button href={route('admin.slider1.create')}>Add New</Button>

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {data.slider1.map((slider: any) => (
                            <tr key={slider.id} className="border-t border-gray-200">
                                <td className="p-3">{slider.heading1}</td>
                                <td className="p-3">{slider.heading2}</td>
                                <td className="p-3">
                                    <img src={`${slider.image1}`} alt="" width={48} />
                                </td>
                                <td className="p-3">{slider.is_active ==1 ? 'active' : 'inactive'}</td>
                                <td className="p-3">
                                     <TextLink href={route('admin.slider1.edit', slider.id)}>
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
