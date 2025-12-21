type FormType = {
    seller_id: number;
    product_category_id: number;

    title: string;
    slug: string;
    sku: string;

    short_description: string;
    description: string;

    price: number;
    mrp: number;

    stock: number;
    manage_stock: number;

    thumbnail: UploadValue;
    gallery: string;

    is_active: number;
    is_featured: number;

    meta_title: string;
    meta_description: string;
};

type UploadValue = File | string | null;
type CategoryOption = {
    id: number;
    title: string;
};