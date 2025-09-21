import AppLayout from '@/layouts/user/app-layout';
import { usePage } from '@inertiajs/react';
import AboutSection from './pages/home/about';
import ClientSection from './pages/home/clients';
import FeatureSection from './pages/home/features';
import HeroSection from './pages/home/hero';
import NewsletterSection from './pages/home/newsletter';
import ProjectSection from './pages/home/projects';
import ServicesSection from './pages/home/services';
import TeamSection from './pages/home/team';
import TestimonialSection from './pages/home/testimonials';

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
