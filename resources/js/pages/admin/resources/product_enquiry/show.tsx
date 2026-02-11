import { Head, usePage } from '@inertiajs/react';
import { InputDiv } from '@/components/form/container/input-div';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Enquiry',
        href: '/admin/productEnquiry',
    },
    {
        title: 'Detail',
        href: '',
    },
];

type FormType = {
    status: string;
};

interface ProductEnquiryDetailData {
    id: number;
    name: string;
    email: string;
    phone: string;
    message: string;
    status: string;
    product: {
        id: number;
        title: string;
        slug: string;
    };
    created_date_time: string;
}

export default function ProductEnquiryShow() {
    const enquiry = ((usePage<SharedData>().props as { data: ProductEnquiryDetailData })?.data) || {} as ProductEnquiryDetailData;

    const initialValues: FormType = {
        status: enquiry.status || 'pending',
    };

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.productEnquiry.update', enquiry.id),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Status updated successfully!'),
    });

    const thead = [
        { title: 'Product Enquiry Detail', className: 'p-3' },
        { title: '', className: 'p-3' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Product Enquiry Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Product</td>
                            <td className="p-3">{enquiry.product?.title || '-'}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Name</td>
                            <td className="p-3">{enquiry.name}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Email</td>
                            <td className="p-3">{enquiry.email}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Phone</td>
                            <td className="p-3">{enquiry.phone || '-'}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Message</td>
                            <td className="p-3">{enquiry.message || '-'}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Created At</td>
                            <td className="p-3">{enquiry.created_date_time}</td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Status</td>
                            <td className="p-3">
                                <form onSubmit={submit} className="flex gap-2 items-center">
                                    <InputDiv
                                        type="select"
                                        name="status"
                                        inputDivData={inputDivData}
                                        options={[
                                            { value: 'pending', label: 'Pending' },
                                            { value: 'contacted', label: 'Contacted' },
                                            { value: 'completed', label: 'Completed' },
                                        ]}
                                    />
                                    <Button type="submit" disabled={processing}>
                                        {processing ? 'Updating...' : 'Update'}
                                    </Button>
                                </form>
                            </td>
                        </tr>
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
