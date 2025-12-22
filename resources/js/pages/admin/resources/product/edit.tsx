import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import Form from './Form';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Products', href: '/admin/product' },
    { title: 'Edit', href: '/admin/product' },
];

export default function Edit() {
    const product = ((usePage<SharedData>().props as any)?.data as any) || {};
    const categories =
        ((usePage<SharedData>().props as any)?.categories as any[]) || [];

    const initialValues: FormType = {
        seller_id: product.seller_id || '',
        product_category_id: product.product_category_id ?? '',

        title: product.title ?? '',
        slug: product.slug ?? '',
        sku: product.sku ?? '',

        short_description: product.short_description ?? '',
        description: product.description ?? '',

        price: Number(product.price ?? 0),
        mrp: Number(product.mrp ?? 0),

        stock: Number(product.stock ?? 0),
        manage_stock: Number(product.manage_stock ?? 1),

        images: product.images ?? null,

        is_active: Number(product.is_active ?? 1),
        is_featured: Number(product.is_featured ?? 0),

        meta_title: product.meta_title ?? '',
        meta_description: product.meta_description ?? '',
    };

    const form = useFormHandler<FormType>({
        url: route('admin.product.update', product.id),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Product updated successfully!'),
    });

    const { submit, inputDivData, processing } = form;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Product" />

            <Form
                submit={submit}
                inputDivData={inputDivData}
                processing={processing}
                categories={categories}
            />
        </AppLayout>
    );
}
