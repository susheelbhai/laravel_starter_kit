import { usePage } from '@inertiajs/react';
import { Container } from '@/components/ui/container';
import AppLayout from '@/layouts/user/app-layout';

const Dashboard = () => {
    const data = usePage().props.data as any;
    return (
        <AppLayout title="Refund Policy">
             <Container className="py-10 text-foreground">
                <p className='font-bold text-2xl'> {data.title} </p>
                <p className='font-bold'> Last Updated : {data.updated_at} </p>

                <div dangerouslySetInnerHTML={{ __html: data.content }} />
            </Container>
        </AppLayout>
    );
};

export default Dashboard;
