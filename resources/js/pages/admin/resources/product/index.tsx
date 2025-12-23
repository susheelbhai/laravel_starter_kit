import Pagination from '@/components/table/pagination';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import TextLink from '@/components/text-link';
import ButtonCreate from '@/components/ui/button-create';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { Eye } from 'lucide-react';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Products', href: '/admin/product' },
];

type Row = {
    id: number;
    seller_id: number;
    product_category_id: number;
    title: string;
    price: number;
    stock: number;
    is_active: number;
    thumbnail: string | null;
    images: string[];
};

export default function Index() {
    const { data } = (usePage<SharedData>().props as any);
    const items = data?.data || [];

    const thead = [
        { title: 'Title', className: 'p-3' },
        { title: 'Seller', className: 'p-3' },
        { title: 'Category', className: 'p-3' },
        { title: 'Price', className: 'p-3' },
        { title: 'Stock', className: 'p-3' },
        { title: 'Image', className: 'p-3' },
        { title: 'Status', className: 'p-3' },
        { title: 'View', className: 'p-3' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Products" />

            <ButtonCreate href={route('admin.product.create')} text="Add New" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {items.map((product: any) => (
                            <tr key={product.id} className="border-t border-gray-200">
                                <td className="p-3">{product.title}</td>
                                <td className="p-3">{product.seller_id}</td>
                                <td className="p-3">{product.product_category_id}</td>
                                <td className="p-3">{product.price}</td>
                                <td className="p-3">{product.stock}</td>
                                <td className="p-3">
                                    {product.thumbnail ? (
                                        <img src={product.thumbnail} alt="" width={48} />
                                    ) : (
                                        '-'
                                    )}
                                </td>
                                <td className="p-3">
                                    {product.is_active == 1 ? 'active' : 'inactive'}
                                </td>
                                <td className="p-3">
                                    <TextLink href={route('admin.product.show', product.id)}>
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
