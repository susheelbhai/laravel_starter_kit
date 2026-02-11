import { Head, usePage } from '@inertiajs/react';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { type BreadcrumbItem, type SharedData } from '@/types';
import Form from './Form';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Products', href: '/admin/product' },
    { title: 'Edit', href: '/admin/product' },
];

interface ProductData {
    id: number;
    seller_id: string;
    product_category_id: number;
    title: string;
    slug: string;
    sku: string;
    short_description: string;
    description: string;
    long_description2: string;
    long_description3: string;
    features: string[];
    price: number;
    original_price: number;
    mrp: number;
    stock: number;
    manage_stock: number;
    images: string[] | null;
    is_active: number;
    is_featured: number;
    meta_title: string;
    meta_description: string;
}

interface CategoryOption {
    id: number;
    title: string;
}

interface FormType {
    seller_id: string;
    product_category_id: number | string;
    title: string;
    slug: string;
    sku: string;
    short_description: string;
    description: string;
    long_description2: string;
    long_description3: string;
    features: string[];
    price: number;
    original_price: number;
    mrp: number;
    stock: number;
    manage_stock: number;
    images: string[] | null;
    is_active: number;
    is_featured: number;
    meta_title: string;
    meta_description: string;
}

export default function Edit() {
    const product = ((usePage<SharedData>().props as { data: ProductData })?.data) || {} as ProductData;
    const categories = ((usePage<SharedData>().props as { categories: CategoryOption[] })?.categories) || [];

    const initialValues: FormType = {
        seller_id: product.seller_id || '',
        product_category_id: product.product_category_id ?? '',

        title: product.title ?? '',
        slug: product.slug ?? '',
        sku: product.sku ?? '',

        short_description: product.short_description ?? '',
        description: product.description ?? '',
        long_description2: product.long_description2 ?? '',
        long_description3: product.long_description3 ?? '',
        features: product.features ?? [],

        price: Number(product.price ?? 0),
        original_price: Number(product.original_price ?? 0),
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
