import { Head, usePage } from '@inertiajs/react';
import { Eye } from 'lucide-react';
import Button from '@/components/button';
import Pagination from '@/components/table/pagination';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Enquiry',
        href: '',
    },
];

interface ProductEnquiryData {
    id: number;
    name: string;
    email: string;
    phone?: string;
    status: string;
    product?: {
        title: string;
    };
}

interface ProductEnquiryPageProps {
    data: {
        data: ProductEnquiryData[];
        [key: string]: unknown;
    };
}

export default function ProductEnquiryIndex() {
    const { data } = (usePage<SharedData>().props as ProductEnquiryPageProps);
    const items = data?.data || [];
    const thead = [
        { title: 'ID', className: 'p-3' },
        { title: 'Product', className: 'p-3' },
        { title: 'Name', className: 'p-3' },
        { title: 'Email', className: 'p-3' },
        { title: 'Phone', className: 'p-3' },
        { title: 'Status', className: 'p-3' },
        { title: 'View', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Product Enquiry" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {items.map((enquiry: ProductEnquiryData) => (
                            <tr
                                key={enquiry.id}
                                className="border-t border-gray-200"
                            >
                                <td className="p-3">{enquiry.id}</td>
                                <td className="p-3">{enquiry.product?.title || '-'}</td>
                                <td className="p-3">{enquiry.name}</td>
                                <td className="p-3">{enquiry.email}</td>
                                <td className="p-3">{enquiry.phone || '-'}</td>
                                <td className="p-3">
                                    <span className={`px-2 py-1 rounded-full text-xs ${
                                        enquiry.status === 'pending' 
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : enquiry.status === 'contacted'
                                            ? 'bg-blue-100 text-blue-800'
                                            : 'bg-green-100 text-green-800'
                                    }`}>
                                        {enquiry.status}
                                    </span>
                                </td>
                                <td className="p-3 text-right">
                                    <Button
                                        href={route('admin.productEnquiry.show', enquiry.id)}
                                        className="bg-transparent hover:bg-transparent text-blue-600 hover:text-blue-800"
                                    >
                                        <Eye />
                                    </Button>
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
