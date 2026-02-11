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
        title: 'Testimonial',
        href: '/admin/testimonial',
    },
    {
        title: 'Testimonial Detail',
        href: '/dashboard',
    },
];

interface TestimonialData {
    id: number;
    name: string;
    designation: string;
    organisation: string;
    message: string;
    is_active: number;
    image: string;
}

interface TestimonialShowPageProps extends SharedData {
    data: TestimonialData;
}

export default function Dashboard() {
    const testimonial = usePage<TestimonialShowPageProps>().props.data || {} as TestimonialData;
    const thead = [
        { title: 'Testimonial Detail', className: 'p-3' },
        { title: '', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Testimonial Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Name</td>
                            <td className="p-3">{testimonial.name}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Designation</td>
                            <td className="p-3">{testimonial.designation}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Organisation</td>
                            <td className="p-3">{testimonial.organisation}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Message</td>
                            <td className="p-3">{testimonial.message}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Image</td>
                            <td className="p-3">
                                <img src={`${testimonial.image}`} alt="" width={320} />
                            </td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Status</td>
                            <td className="p-3">{testimonial.is_active == 1 ? 'active' : 'inactive'}</td>
                        </tr>
                        <EditRow href={route('admin.testimonial.edit', testimonial.id)}>Edit</EditRow>

                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
