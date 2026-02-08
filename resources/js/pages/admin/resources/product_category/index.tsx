import { Head, usePage } from '@inertiajs/react';
import { Eye } from 'lucide-react';
import Pagination from '@/components/table/pagination';
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
        title: 'Product Category',
        href: '/dashboard',
    },
];

type ProductCategoryRow = {
    id: number;
    parent_id: number | null;
    title: string;
    slug: string;
    description: string | null;
    icon: string | null;
    icon_thumb: string | null;
    banner: string | null;
    position: number;
    is_active: number;
    is_featured: number;
};

export default function Index() {
    const { data } = (usePage<SharedData>().props as any);
    const items = data?.data || [];

    const thead = [
        { title: 'Name', className: 'p-3' },
        { title: 'Slug', className: 'p-3' },
        { title: 'Parent', className: 'p-3' },
        { title: 'Position', className: 'p-3' },
        { title: 'Icon', className: 'p-3' },
        { title: 'Status', className: 'p-3' },
        { title: 'View', className: 'p-3' },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Product Category" />

            <ButtonCreate
                href={route('admin.product_category.create')}
                text="Add New"
            />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {items.map((category: any) => (
                            <tr
                                key={category.id}
                                className="border-t border-gray-200"
                            >
                                <td className="p-3">{category.title}</td>
                                <td className="p-3">{category.slug}</td>
                                <td className="p-3">
                                    {category.parent_id ?? '-'}
                                </td>
                                <td className="p-3">{category.position}</td>
                                <td className="p-3">
                                    {category.icon_thumb || category.icon ? (
                                        <img
                                            src={category.icon_thumb || category.icon || ''}
                                            alt=""
                                            width={48}
                                        />
                                    ) : (
                                        '-'
                                    )}
                                </td>
                                <td className="p-3">
                                    {category.is_active == 1
                                        ? 'active'
                                        : 'inactive'}
                                </td>
                                <td className="p-3">
                                    <TextLink
                                        href={route(
                                            'admin.product_category.show',
                                            category.id,
                                        )}
                                    >
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
