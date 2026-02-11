import { usePage } from '@inertiajs/react';
import AppLayout from '@/layouts/user/app-layout';
import AboutSection from './about';
import ClientSection from './clients';
import FeatureSection from './features';
import HeroSection from './hero';
import NewsletterSection from './newsletter';
import ProjectSection from './projects';
import ServicesSection from './services';
import TeamSection from './team';
import TestimonialSection from './testimonials';

interface HomePageData {
    data: unknown;
    services: unknown[];
    projects: unknown[];
    team: unknown[];
    testimonials: unknown[];
    clients: unknown[];
    [key: string]: unknown;
}

const FinbizLandingPage = () => {
    const data = usePage().props as HomePageData;
    return (
        <AppLayout title="Home">
            <HeroSection data={data} />
            <AboutSection data={data.data} />
            <ServicesSection data={data.services} />
            <FeatureSection data={data.data} />
            <ProjectSection data={data.projects} />
            <TeamSection data={data.team} />
            <TestimonialSection data={data.testimonials} />
            <NewsletterSection />
            <ClientSection data={data.clients} />
        </AppLayout>
    );
};

export default FinbizLandingPage;
