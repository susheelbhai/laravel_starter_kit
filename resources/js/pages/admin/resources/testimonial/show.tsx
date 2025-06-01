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
        title: 'Testimonial',
        href: '/admin/testimonial',
    },
    {
        title: 'Testimonial Detail',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const testimonial =
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
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Name</td>
                            <td className="p-3">{testimonial.name}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Designation</td>
                            <td className="p-3">{testimonial.designation}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Organisation</td>
                            <td className="p-3">{testimonial.organisation}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Message</td>
                            <td className="p-3">{testimonial.message}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Image</td>
                            <td className="p-3">
                                <img src={`${testimonial.image}`} alt="" width={320} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Status</td>
                            <td className="p-3">{testimonial.is_active == 1 ? 'active' : 'inactive'}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3" colSpan={2}>
                                <TextLink href={route('admin.testimonial.edit', testimonial.id)}>Edit</TextLink>
                            </td>
                        </tr>
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
