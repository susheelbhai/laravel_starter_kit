import Button from '@/components/button';
import InputDiv from '@/components/form/input-div';

export default function Form({
    submit,
    inputDivData,
    processing,
    categories,
}: {
    submit: (e: React.FormEvent) => void;
    inputDivData: any;
    processing: boolean;
    categories: any[];
}) {
    return (
        <form onSubmit={submit} className="space-y-6 p-6">
            <InputDiv
                type="select"
                label="Category"
                name="product_category_id"
                options={categories}
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
                type="text"
                label="SKU"
                name="sku"
                inputDivData={inputDivData}
            />

            <InputDiv
                type="textarea"
                label="Short Description"
                name="short_description"
                inputDivData={inputDivData}
            />
            <InputDiv
                type="editor"
                label="Description"
                name="description"
                inputDivData={inputDivData}
            />

            <InputDiv
                type="number"
                label="Price"
                name="price"
                inputDivData={inputDivData}
            />
            <InputDiv
                type="number"
                label="MRP"
                name="mrp"
                inputDivData={inputDivData}
            />

            <InputDiv
                type="number"
                label="Stock"
                name="stock"
                inputDivData={inputDivData}
            />
            <InputDiv
                type="switch"
                label="Manage Stock"
                name="manage_stock"
                inputDivData={inputDivData}
            />
            
            <InputDiv
                type="images"
                label="Images"
                name="images"
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

            <Button type="submit" disabled={processing}>
                {processing ? 'Submitting...' : 'Submit'}
            </Button>
        </form>
    );
}
