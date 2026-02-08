import { Head, usePage } from '@inertiajs/react';
import { Edit, Eye, Trash2 } from 'lucide-react';
import Button from '@/components/button';
import Pagination from '@/components/table/pagination';
import ButtonCreate from '@/components/ui/button-create';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Gallery',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const data = (usePage<SharedData>().props as any)?.data as any;

    return (
        <AppLayout breadcrumbs={breadcrumbs} title="Gallery">
            <Head title="Gallery" />
            <div className="mb-6">
                <ButtonCreate
                    href={route('admin.gallery.create')}
                    text="Add New"
                />
            </div>

            {data.length > 0 ? (
                <>
                    <div className="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        {data.map((item: any) => (
                            <div
                                key={item.id}
                                className="overflow-hidden rounded-lg bg-white shadow-md transition-shadow hover:shadow-lg"
                            >
                                {/* Images Grid */}
                                <div className="relative h-48 bg-gray-200">
                                    {item.media && item.media.length > 0 ? (
                                        <div className="grid h-full grid-cols-2 gap-1 p-1">
                                            {item.media
                                                .slice(0, 4)
                                                .map(
                                                    (
                                                        media: any,
                                                        index: number,
                                                    ) => (
                                                        <div
                                                            key={media.id}
                                                            className={`relative overflow-hidden bg-gray-100 ${
                                                                item.media
                                                                    .length ===
                                                                1
                                                                    ? 'col-span-2'
                                                                    : ''
                                                            } ${
                                                                item.media
                                                                    .length ===
                                                                    3 &&
                                                                index === 0
                                                                    ? 'col-span-2'
                                                                    : ''
                                                            }`}
                                                        >
                                                            <img
                                                                src={
                                                                    media.original_url
                                                                }
                                                                alt={media.name}
                                                                className="h-full w-full object-cover"
                                                            />
                                                            {/* Show count overlay on last image if more than 4 */}
                                                            {index === 3 &&
                                                                item.media
                                                                    .length >
                                                                    4 && (
                                                                    <div className="bg-opacity-60 absolute inset-0 flex items-center justify-center bg-black">
                                                                        <span className="text-2xl font-bold text-white">
                                                                            +
                                                                            {item
                                                                                .media
                                                                                .length -
                                                                                4}
                                                                        </span>
                                                                    </div>
                                                                )}
                                                        </div>
                                                    ),
                                                )}
                                        </div>
                                    ) : (
                                        <div className="flex h-full w-full items-center justify-center text-gray-400">
                                            No Images
                                        </div>
                                    )}
                                    {/* Image count badge */}
                                    {item.media && item.media.length > 0 && (
                                        <div className="bg-opacity-70 absolute top-2 right-2 rounded bg-black px-2 py-1 text-xs font-semibold text-white">
                                            {item.media.length}{' '}
                                            {item.media.length === 1
                                                ? 'image'
                                                : 'images'}
                                        </div>
                                    )}
                                </div>

                                {/* Content */}
                                <div className="p-4">
                                    <h3 className="mb-2 line-clamp-1 text-lg font-semibold text-gray-800">
                                        {item.title}
                                    </h3>
                                    <p className="mb-3 line-clamp-2 text-sm text-gray-600">
                                        {item.description}
                                    </p>
                                    <p className="mb-4 text-xs text-gray-500">
                                        {item.created_date_time}
                                    </p>

                                    {/* Actions */}
                                    <div className="flex gap-2">
                                        <Button
                                            className="rounded bg-blue-600 px-3 py-2 text-white hover:bg-blue-700"
                                            href={route(
                                                'admin.gallery.show',
                                                item.id,
                                            )}
                                        >
                                            <Eye className="h-4 w-4" />
                                            View
                                        </Button>
                                        <Button
                                            className="rounded bg-yellow-600 px-3 py-2 text-white hover:bg-yellow-700"
                                            href={route(
                                                'admin.gallery.edit',
                                                item.id,
                                            )}
                                        >
                                            <Edit className="h-4 w-4" />
                                            Edit
                                        </Button>
                                        <Button
                                            method="delete"
                                            className="rounded bg-red-600 px-3 py-2 text-white hover:bg-red-700"
                                            href={route(
                                                'admin.gallery.destroy',
                                                item.id,
                                            )}
                                        >
                                            <Trash2 className="h-4 w-4" />
                                        </Button>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>

                    {/* Pagination */}
                    {data?.links && (
                        <div className="mt-8">
                            <Pagination data={data} />
                        </div>
                    )}
                </>
            ) : (
                <div className="rounded-lg bg-white p-8 text-center shadow">
                    <p className="text-lg text-gray-500">
                        No gallery items found.
                    </p>
                    <p className="mt-2 text-sm text-gray-400">
                        Click "Add New" to create your first gallery item.
                    </p>
                </div>
            )}
        </AppLayout>
    );
}

