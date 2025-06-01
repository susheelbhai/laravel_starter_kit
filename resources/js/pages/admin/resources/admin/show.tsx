import BtnLink from '@/components/btn-link';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/admin',
    },
    {
        title: 'Admin Detail',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const admin =
        ((usePage<SharedData>().props as any)?.data as {
            id: number;
            name: string;
            dob: string;
            profile_pic: string;
            address: string;
            city: string;
            state: string;
            email: string;
            phone: string;
            university?: { name: string };
            is_active: number;
            roles: Array<{
                id: number;
                name: string;
                permissions: Array<{
                    id: number;
                    name: string;
                }>;
            }>;
            permissions: Array<{
                id: number;
                name: string;
            }>;
        }) || {};

    const thead = [
        { title: 'Admin Detail', className: 'p-3', colSpan: 1 },
        { title: '', className: 'p-3', colSpan: 1 },
    ];

    const universityName = admin.university?.name || 'N/A';

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Admin Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Name</td>
                            <td className="p-3">{admin.name}</td>
                        </tr>
                        {/* <tr className="border-t border-gray-200">
                            <td className="p-3">Date of Birth</td>
                            <td className="p-3">{admin.dob}</td>
                        </tr> */}
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Email</td>
                            <td className="p-3">{admin.email}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Phone</td>
                            <td className="p-3">{admin.phone}</td>
                        </tr>
                        {/* <tr className="border-t border-gray-200">
                            <td className="p-3">Profile Picture</td>
                            <td className="p-3">
                                <img className="w-16" src={admin.profile_pic} alt="Profile" width={320} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Address</td>
                            <td className="p-3">{admin.address}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">City</td>
                            <td className="p-3">{admin.city}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">State</td>
                            <td className="p-3">{admin.state}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">University</td>
                            <td className="p-3">{universityName}</td>
                        </tr>
                         */}
<tr className="border-t border-gray-200">
                            <td className="p-3">Roles</td>
                            <td className="space-y-2 p-3">
                                {admin.roles.map((role: any) => (
                                    <div key={role.id}>
                                        <span className="font-semibold">{role.name}</span>
                                        <div className="mt-1 ml-2 flex flex-wrap gap-2">
                                            {role.permissions.map((perm: any) => (
                                                <span key={perm.id} className="inline-block rounded bg-gray-100 px-2 py-1 text-sm text-gray-700">
                                                    {perm.name}
                                                </span>
                                            ))}
                                        </div>
                                    </div>
                                ))}
                            </td>
                        </tr>

                        <tr className="border-t border-gray-200">
                            <td className="p-3">Permissions</td>
                            <td className="p-3">
                                {admin.permissions.map((perm: any) => (
                                    <span key={perm.id} className="inline-block rounded bg-gray-100 px-2 py-1 text-sm text-gray-700">
                                        {perm.name}
                                    </span>
                                ))}
                            </td>
                        </tr>
                        
                        <tr className="border-t p- border-gray-200">
                            <td className="p-6 text-center" colSpan={2}>
                                <BtnLink href={route('admin.admin.edit', admin.id)}>Edit</BtnLink>
                            </td>
                        </tr>
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
