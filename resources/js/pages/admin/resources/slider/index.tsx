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
        title: 'Slider',
        href: '/dashboard',
    },
];

interface SliderData {
    id: number;
    heading1: string;
    btn_name: string;
    is_active: number;
    image1: string;
}

interface SliderIndexPageProps extends SharedData {
    data: SliderData[];
}

export default function Dashboard() {
    const data = usePage<SliderIndexPageProps>().props.data || [];
    const thead = [
        { title: 'Heading', className: 'p-3' },
        { title: 'Button', className: 'p-3' },
        { title: 'Image', className: 'p-3' },
        { title: 'Status', className: 'p-3' },
        { title: 'View', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Slider" />
            <ButtonCreate href={route('admin.slider1.create')} text="Add New" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {data.map((slider) => (
                            <tr key={slider.id} className="border-t border-gray-200">
                                <td className="p-3">{slider.heading1}</td>
                                <td className="p-3">{slider.btn_name}</td>
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
