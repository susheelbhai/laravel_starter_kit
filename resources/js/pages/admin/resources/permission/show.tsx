import { Head, usePage } from '@inertiajs/react';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import TextLink from '@/components/text-link';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Permission',
        href: '/admin/permission',
    },
    {
        title: 'Permission Detail',
        href: '/dashboard',
    },
];

interface PermissionDetailData {
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
}

export default function Dashboard() {
    const permission = ((usePage<SharedData>().props as { data: PermissionDetailData })?.data) || {
        id: 0,
        name: '',
        dob: '',
        profile_pic: '',
        permanent_address: '',
        current_address: '',
        city: '',
        state: '',
        email: '',
        phone: '',
        course: '',
        enrollment_number: '',
        college: '',
        is_active: 0,
    };

    const thead = [
        { title: 'Permission Detail', className: 'p-3', colSpan: 1 },
        { title: '', className: 'p-3', colSpan: 1 },
    ];

    const membershipTitle = permission.membership_type?.title || 'N/A';
    const universityName = permission.university?.name || 'N/A';

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Permission Detail" />

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
                            <td className="p-3">{permission.name}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Date of Birth</td>
                            <td className="p-3">{permission.dob}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Email</td>
                            <td className="p-3">{permission.email}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Phone</td>
                            <td className="p-3">{permission.phone}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Profile Picture</td>
                            <td className="p-3">
                                <img className='w-16' src={permission.profile_pic} alt="Profile" width={320} />
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Permanent Address</td>
                            <td className="p-3">{permission.permanent_address}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Current Address</td>
                            <td className="p-3">{permission.current_address}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">City</td>
                            <td className="p-3">{permission.city}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">State</td>
                            <td className="p-3">{permission.state}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Course</td>
                            <td className="p-3">{permission.course}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Enrollment Number</td>
                            <td className="p-3">{permission.enrollment_number}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">College</td>
                            <td className="p-3">{permission.college}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">University</td>
                            <td className="p-3">{universityName}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3">Status</td>
                            <td className="p-3">{permission.is_active === 1 ? 'active' : 'inactive'}</td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3" colSpan={2}>
                                <TextLink href={route('admin.permission.edit', permission.id)}>Edit</TextLink>
                            </td>
                        </tr>
                        <tr className="border-t border-gray-200">
                            <td className="p-3" colSpan={2}>
                                <a
                                    href={route('admin.idCard.generate', permission.id)}
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
