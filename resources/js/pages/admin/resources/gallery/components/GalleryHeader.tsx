import { Edit, Trash2 } from 'lucide-react';
import Button from '@/components/button';

interface GalleryHeaderProps {
    item: any;
}

export function GalleryHeader({ item }: GalleryHeaderProps) {
    return (
        <div className="mb-6 flex items-center justify-between border-b">
            <div className="p-6">
                <h1 className="mb-2 text-3xl font-bold text-gray-800">
                    {item.title}
                </h1>
                <p className="text-gray-600">{item.description}</p>
                <p className="mt-2 text-sm text-gray-500">
                    {item.created_date_time}
                </p>
            </div>
            <div className="flex gap-3">
                <Button
                    className="rounded bg-yellow-600 px-3 py-2 text-white hover:bg-yellow-700"
                    href={route('admin.gallery.edit', item.id)}
                >
                    <Edit className="h-4 w-4" />
                    Edit
                </Button>
                <Button
                    method="delete"
                    className="rounded bg-red-600 px-3 py-2 text-white hover:bg-red-700"
                    href={route('admin.gallery.destroy', item.id)}
                >
                    <Trash2 className="h-4 w-4" />
                    Delete
                </Button>
            </div>
        </div>
    );
}

