import AppLayout from '@/layouts/user/app-layout';
import { usePage } from '@inertiajs/react';
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
            <HeroSection />
            <AboutSection />
            <ServicesSection data={data.services} />
            <FeatureSection />
            <ProjectSection />
            <TeamSection data={data.team} />
            <TestimonialSection data={data.testimonials} />
            <NewsletterSection />
            <ClientSection data={data.clients} />
        </AppLayout>
    );
};

export default FinbizLandingPage;
