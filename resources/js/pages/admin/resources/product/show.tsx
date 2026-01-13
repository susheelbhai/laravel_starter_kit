import EditRow from '@/components/table/edit-row';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Products', href: '/admin/product' },
    { title: 'Product Detail', href: '/dashboard' },
];

export default function Show() {
    const product =
        ((usePage<SharedData>().props as any)?.data as any) || {};

    const thead = [
        { title: 'Product Detail', className: 'p-3' },
        { title: '', className: 'p-3' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Product Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Title</td>
                            <td className="p-3">{product.title}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Slug</td>
                            <td className="p-3">{product.slug}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Seller ID</td>
                            <td className="p-3">{product.seller_id}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Category ID</td>
                            <td className="p-3">{product.product_category_id}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">SKU</td>
                            <td className="p-3">{product.sku ?? '-'}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Short Description</td>
                            <td className="p-3">{product.short_description ?? '-'}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Description</td>
                            <td className="p-3">
                                {product.description ? (
                                    <div
                                        dangerouslySetInnerHTML={{
                                            __html: product.description,
                                        }}
                                    />
                                ) : (
                                    '-'
                                )}
                            </td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Price</td>
                            <td className="p-3">{product.price}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">MRP</td>
                            <td className="p-3">{product.mrp ?? '-'}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Stock</td>
                            <td className="p-3">{product.stock}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Manage Stock</td>
                            <td className="p-3">{product.manage_stock == 1 ? 'yes' : 'no'}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Thumbnail</td>
                            <td className="p-3">
                                {product.images && product.images.length > 0 ? (
                                    <img src={product.images[0]} alt="" width={320} />
                                ) : (
                                    '-'
                                )}
                            </td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Gallery</td>
                            <td className="p-3">
                                {product.images && product.images.length > 0 ? (
                                    <div className="flex flex-wrap gap-2">
                                        {product.images.map((img: string, index: number) => (
                                            <img key={index} src={img} alt="" width={160} />
                                        ))}
                                    </div>
                                ) : (
                                    '-'
                                )}
                            </td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Active</td>
                            <td className="p-3">{product.is_active == 1 ? 'active' : 'inactive'}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Featured</td>
                            <td className="p-3">{product.is_featured == 1 ? 'yes' : 'no'}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Meta Title</td>
                            <td className="p-3">{product.meta_title ?? '-'}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Meta Description</td>
                            <td className="p-3">{product.meta_description ?? '-'}</td>
                        </tr>

                        <EditRow href={route('admin.product.edit', product.id)} buttonName="Edit Product" />

                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
