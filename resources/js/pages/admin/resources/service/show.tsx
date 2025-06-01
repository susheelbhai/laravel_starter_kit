import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import BtnLink from '@/components/btn-link';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Service',
        href: '/admin/service',
    },
    {
        title: 'Service Detail',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const service =
        ((usePage<SharedData>().props as any)?.data as {
            id: number;
            title: string;
            author: string;
            tags: string;
            short_description: string;
            long_description1: string;
            long_description2: string;
            long_description3: string;
            category: string;
            is_active: number;
            display_img: string;
            ad_img: string;
        }) || [];
    const thead = [
        { title: 'Service Detail', className: 'p-3', colSpan: 2 },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Service Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Title</td>
                            <td className="p-3">{service.title}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Author</td>
                            <td className="p-3">{service.author}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Tags</td>
                            <td className="p-3">{service.tags}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">category</td>
                            <td className="p-3">{service.category}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Short Description</td>
                            <td className="p-3">{service.short_description}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Long Description 1</td>
                            <td className="p-3">
                                <div dangerouslySetInnerHTML={{ __html: service.long_description1 }} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Long Description 2</td>
                            <td className="p-3">
                                <div dangerouslySetInnerHTML={{ __html: service.long_description2 }} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Long Description 3</td>
                            <td className="p-3">
                                <div dangerouslySetInnerHTML={{ __html: service.long_description3 }} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Image</td>
                            <td className="p-3">
                                <img src={`${service.display_img}`} alt="" width={320} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Ad Image</td>
                            <td className="p-3">
                                <img src={`${service.ad_img}`} alt="" width={320} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Status</td>
                            <td className="p-3">{service.is_active == 1 ? 'active' : 'inactive'}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">
                                <BtnLink href={route('admin.service.edit', service.id)}>Edit</BtnLink>
                            </td>
                        </tr>
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
