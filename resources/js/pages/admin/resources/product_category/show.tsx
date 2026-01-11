import EditRow from '@/components/table/edit-row';
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
        title: 'Product Category',
        href: '/admin/product_category',
    },
    {
        title: 'Product Category Detail',
        href: '/dashboard',
    },
];

type ProductCategoryDetail = {
    id: number;
    parent_id: number | null;
    title: string;
    slug: string;
    description: string | null;
    icon: string | null;
    banner: string | null;
    position: number;
    is_active: number;
    is_featured: number;
    meta_title: string | null;
    meta_description: string | null;
};

export default function Dashboard() {
    const product_category =
        ((usePage<SharedData>().props as any)?.data as ProductCategoryDetail) ||
        ({} as ProductCategoryDetail);

    const thead = [
        { title: 'Product Category Detail', className: 'p-3' },
        { title: '', className: 'p-3' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Product Category Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Title</td>
                            <td className="p-3">{product_category.title}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Slug</td>
                            <td className="p-3">{product_category.slug}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Parent ID</td>
                            <td className="p-3">
                                {product_category.parent_id ?? '-'}
                            </td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Position</td>
                            <td className="p-3">{product_category.position}</td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Description</td>
                            <td className="p-3">
                                {product_category.description ?? '-'}
                            </td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Meta Title</td>
                            <td className="p-3">
                                {product_category.meta_title ?? '-'}
                            </td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Meta Description</td>
                            <td className="p-3">
                                {product_category.meta_description ? (
                                    <div
                                        dangerouslySetInnerHTML={{
                                            __html: product_category.meta_description,
                                        }}
                                    />
                                ) : (
                                    '-'
                                )}
                            </td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Icon</td>
                            <td className="p-3">
                                {product_category.icon ? (
                                    <img
                                        src={product_category.icon}
                                        alt=""
                                        width={120}
                                    />
                                ) : (
                                    '-'
                                )}
                            </td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Banner</td>
                            <td className="p-3">
                                {product_category.banner ? (
                                    <img
                                        src={product_category.banner}
                                        alt=""
                                        width={320}
                                    />
                                ) : (
                                    '-'
                                )}
                            </td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Active</td>
                            <td className="p-3">
                                {product_category.is_active == 1
                                    ? 'active'
                                    : 'inactive'}
                            </td>
                        </tr>

                        <tr className="border-y border-gray-200">
                            <td className="p-3">Featured</td>
                            <td className="p-3">
                                {product_category.is_featured == 1
                                    ? 'yes'
                                    : 'no'}
                            </td>
                        </tr>

                        <EditRow
                            href={route(
                                'admin.product_category.edit',
                                product_category.id,
                            )}
                        />
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
