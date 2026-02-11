import { Head, usePage } from '@inertiajs/react';
import { Eye } from 'lucide-react';
import Button from '@/components/button';
import Pagination from '@/components/table/pagination';
import Table from '@/components/table/table';
import TableCard from '@/components/table/table-card';
import TBody from '@/components/table/tbody';
import THead from '@/components/table/thead';
import AppLayout from '@/layouts/admin/app-layout';
import { type BreadcrumbItem, type SharedData } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
   
    {
        title: 'User Query',
        href: '',
    },
];

interface UserQueryData {
    id: number;
    name: string;
    email: string;
    phone: string;
}

interface UserQueryPageProps {
    data: {
        data: UserQueryData[];
        [key: string]: unknown;
    };
}

export default function Dashboard() {
    const { data } = (usePage<SharedData>().props as UserQueryPageProps);
    const queries = data?.data || [];
    
    const thead = [
        { title: 'ID', className: 'p-3' },
        { title: 'Name', className: 'p-3' },
        { title: 'Email', className: 'p-3' },
        { title: 'Phone', className: 'p-3' },
        { title: 'View', className: 'p-3' },
    ];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="User Query" />

            <TableCard>
                <Table>
                    <THead data={thead} />
                    <TBody>
                        {queries.map((user: UserQueryData) => (
                            <tr
                                key={user.id}
                                className="border-t border-border"
                            >
                                <td className="p-3">{user.id}</td>
                                <td className="p-3">{user.name}</td>
                                <td className="p-3">{user.email}</td>
                                <td className="p-3">{user.phone}</td>
                                <td className="p-3 text-right">
                                    <Button
                                        href={route('admin.userQuery.show', user.id)}
                                        className="bg-transparent hover:bg-transparent text-primary hover:text-primary/80"
                                    >
                                        <Eye />
                                    </Button>
                                </td>
                            </tr>
                        ))}
                    </TBody>
                </Table>
                
                <Pagination data={data} />
            </TableCard>
        </AppLayout>
    );
}
