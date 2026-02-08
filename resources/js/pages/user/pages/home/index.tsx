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

const FinbizLandingPage = () => {
    const data = usePage().props as any;
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
