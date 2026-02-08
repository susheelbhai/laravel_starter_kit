import { Head, usePage } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem, SharedData } from '@/types';

type UploadValue = File | string | null;

type FormType = {
    id: number;
    parent_id: string; // dropdown value as string
    title: string;
    slug: string;
    description: string;
    icon: UploadValue;
    banner: UploadValue;
    position: number;
    is_active: number;
    is_featured: number;
    meta_title: string;
    meta_description: string;
};

type ParentOption = {
    id: number;
    title: string;
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Product Category',
        href: '/admin/product_category',
    },
    {
        title: 'Edit',
        href: '/admin/product_category/edit',
    },
];

export default function Edit() {
    const product_category = (usePage<SharedData>().props as any)?.data as any;

    const parents =
        ((usePage<SharedData>().props as any)?.parents as ParentOption[]) || [];

    const initialValues: FormType = {
        id: product_category?.id || 0,
        parent_id:
            product_category?.parent_id !== null &&
            product_category?.parent_id !== undefined
                ? String(product_category.parent_id)
                : '',
        title: product_category?.title || '',
        slug: product_category?.slug || '',
        description: product_category?.description || '',
        icon: product_category?.icon || null,
        banner: product_category?.banner || null,
        position: product_category?.position || 0,
        is_active: product_category?.is_active ?? 1,
        is_featured: product_category?.is_featured ?? 0,
        meta_title: product_category?.meta_title || '',
        meta_description: product_category?.meta_description || '',
    };

    // ✅ prevent TS deep instantiation
    const form = useFormHandler<FormType>({
        url: route('admin.product_category.update', {
            id: product_category?.id,
        }),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Product category updated successfully!'),
    });

    const { submit, inputDivData, processing } = form;

    const parentOptions = [
        { value: '', title: 'No Parent (Top level)' },
        ...parents.map((p) => ({
            value: String(p.id),
            title: p.title,
        })),
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Edit Product Category" />

            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    type="select"
                    label="Parent Category"
                    name="parent_id"
                    options={parentOptions}
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="text"
                    label="Title"
                    name="title"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="text"
                    label="Slug"
                    name="slug"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="textarea"
                    label="Description"
                    name="description"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="image"
                    label="Icon"
                    name="icon"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="image"
                    label="Banner"
                    name="banner"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="number"
                    label="Position"
                    name="position"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="switch"
                    label="Active"
                    name="is_active"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="switch"
                    label="Featured"
                    name="is_featured"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="text"
                    label="Meta Title"
                    name="meta_title"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="textarea"
                    label="Meta Description"
                    name="meta_description"
                    inputDivData={inputDivData}
                />

            </FormContainer>
        </AppLayout>
    );
}
