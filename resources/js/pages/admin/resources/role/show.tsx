import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import TextLink from '@/components/text-link';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';
import { Head, usePage } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Role',
        href: '/admin/role',
    },
    {
        title: 'Role Detail',
        href: '/dashboard',
    },
];

export default function Dashboard() {
    const role =
        ((usePage<SharedData>().props as any)?.data as {
            id: number;
            membership_type?: { title: string };
            name: string;
            dob: string;
            profile_pic: string;
            permanent_address: string;
            current_address: string;
            city: string;
            state: string;
            email: string;
            phone: string;
            course: string;
            enrollment_number: string;
            college: string;
            university?: { name: string };
            is_active: number;
        }) || {};

    const thead = [
        { title: 'Role Detail', className: 'p-3', colSpan: 1 },
        { title: '', className: 'p-3', colSpan: 1 },
    ];

    const membershipTitle = role.membership_type?.title || 'N/A';
    const universityName = role.university?.name || 'N/A';

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Role Detail" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Membership Type</td>
                            <td className="p-3">{membershipTitle}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Name</td>
                            <td className="p-3">{role.name}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Date of Birth</td>
                            <td className="p-3">{role.dob}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Email</td>
                            <td className="p-3">{role.email}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Phone</td>
                            <td className="p-3">{role.phone}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Profile Picture</td>
                            <td className="p-3">
                                <img className='w-16' src={role.profile_pic} alt="Profile" width={320} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Permanent Address</td>
                            <td className="p-3">{role.permanent_address}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Current Address</td>
                            <td className="p-3">{role.current_address}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">City</td>
                            <td className="p-3">{role.city}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">State</td>
                            <td className="p-3">{role.state}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Course</td>
                            <td className="p-3">{role.course}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Enrollment Number</td>
                            <td className="p-3">{role.enrollment_number}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">College</td>
                            <td className="p-3">{role.college}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">University</td>
                            <td className="p-3">{universityName}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Status</td>
                            <td className="p-3">{role.is_active === 1 ? 'active' : 'inactive'}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3" colSpan={2}>
                                <TextLink href={route('admin.role.edit', role.id)}>Edit</TextLink>
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3" colSpan={2}>
                                <a
                                    href={route('admin.idCard.generate', role.id)}
                                    className="bg-primary text-primary-foreground rounded px-6 py-3"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    Download ID Card
                                </a>
                            </td>
                        </tr>
                    </TBody>
                </Table>
            </TableCard>
        </AppLayout>
    );
}
