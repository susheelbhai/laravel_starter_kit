import { usePage } from '@inertiajs/react';
import AppLayout from '@/layouts/user/app-layout';
import AboutSection from './pages/home/about';
import ClientSection from './pages/home/clients';
import FeatureSection from './pages/home/features';
import HeroSection from './pages/home/hero';
import NewsletterSection from './pages/home/newsletter';
import ProjectSection from './pages/home/projects';
import ServicesSection from './pages/home/services';
import TeamSection from './pages/home/team';
import TestimonialSection from './pages/home/testimonials';
import type { SharedData } from '@/types';

interface ServiceData {
    title: string;
    desc: string;
    display_img_converted: { thumb: string };
}

interface TeamMember {
    id: number;
    name: string;
    designation: string;
    image_converted: { small: string };
}

interface TestimonialData {
    id: number;
    name: string;
    organisation: string;
    designation: string;
    message: string;
    image: string;
}

interface ClientLogo {
    id: number;
    name: string;
    url: string;
    logo: string;
}

interface AboutData {
    about_image_converted: { medium: string };
    about_heading: string;
    about_description: string;
}

interface FeatureData {
    why_us_heading: string;
    why_us_description: string;
    why_us_image_converted: { medium: string };
}

interface ProjectData {
    image: string;
    title: string;
    category: string;
}

interface DashboardPageProps extends SharedData {
    appData: {
        name: string;
        whatsapp: string;
    };
    data: {
        banner_image: string;
        banner_heading: string;
        banner_description: string;
    } & AboutData & FeatureData;
    services: ServiceData[];
    projects: ProjectData[];
    team: TeamMember[];
    testimonials: TestimonialData[];
    clients: ClientLogo[];
}

const Page = () => {
    const pageData = usePage<DashboardPageProps>().props;
    return (
        <AppLayout title="Home">
            <HeroSection data={{ appData: pageData.appData, data: pageData.data }} />
            <AboutSection data={pageData.data} />
            <ServicesSection data={pageData.services} />
            <FeatureSection data={pageData.data} />
            <ProjectSection data={pageData.projects} />
            <TeamSection data={pageData.team} />
            <TestimonialSection data={pageData.testimonials} />
            <NewsletterSection />
            <ClientSection data={pageData.clients} />
        </AppLayout>
    );
};

export default Page;
