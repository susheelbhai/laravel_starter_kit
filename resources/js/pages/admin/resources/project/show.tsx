import { Head, usePage } from '@inertiajs/react';
import EditRow from '@/components/table/edit-row';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Project',
        href: '/admin/project',
    },
    {
        title: 'Project Detail',
        href: '/dashboard',
    },
];

interface ProjectDetailData {
    id: number;
    title: string;
    author: string;
    tags: string;
    short_description: string;
    long_description1: string;
    long_description2: string;
    long_description3: string;
    category: string;
    is_active: number;
    images: Array<{ url: string }>;
    ad_img: string;
    ad_url: string;
    views: string;
    highlighted_text1: string;
    highlighted_text2: string;
}

export default function Dashboard() {
    const project = ((usePage<SharedData>().props as { data: ProjectDetailData })?.data) || {} as ProjectDetailData;
    const thead = [
        { title: 'Project Detail', className: 'p-3', colSpan: 2 },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Project Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Title</td>
                            <td className="p-3">{project.title}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Author</td>
                            <td className="p-3">{project.author}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Tags</td>
                            <td className="p-3">{project.tags}</td>
                        </tr>
                        {/* Category removed, not in migration */}
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Ad URL</td>
                            <td className="p-3">{project.ad_url}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Views</td>
                            <td className="p-3">{project.views}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Highlighted Text 1</td>
                            <td className="p-3"><div dangerouslySetInnerHTML={{ __html: project.highlighted_text1 }} /></td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Highlighted Text 2</td>
                            <td className="p-3"><div dangerouslySetInnerHTML={{ __html: project.highlighted_text2 }} /></td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Short Description</td>
                            <td className="p-3">{project.short_description}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Long Description 1</td>
                            <td className="p-3">
                                <div dangerouslySetInnerHTML={{ __html: project.long_description1 }} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Long Description 2</td>
                            <td className="p-3">
                                <div dangerouslySetInnerHTML={{ __html: project.long_description2 }} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Long Description 3</td>
                            <td className="p-3">
                                <div dangerouslySetInnerHTML={{ __html: project.long_description3 }} />
                            </td>
                        </tr>
                        <tr className="border-y border-gray-200">
                            <td className="p-3">Gallery</td>
                            <td className="p-3">
                                {project.images && project.images.length > 0 ? (
                                    <div className="flex flex-wrap gap-2">
                                        {project.images.map((img: ProjectDetailData['images'][0], index: number) => (
                                            <img key={index} src={img.url} alt="" width={160} />
                                        ))}
                                    </div>
                                ) : (
                                    '-'
                                )}
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Ad Image</td>
                            <td className="p-3">
                                <img src={`${project.ad_img}`} alt="" width={320} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Status</td>
                            <td className="p-3">{project.is_active == 1 ? 'active' : 'inactive'}</td>
                        </tr>
                        <EditRow href={route('admin.project.edit', project.id)}>Edit</EditRow>

                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
