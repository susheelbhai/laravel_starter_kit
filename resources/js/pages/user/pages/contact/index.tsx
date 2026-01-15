import { usePage } from '@inertiajs/react';
import { Clock, LoaderCircle, Mail, MapPin, Phone } from 'lucide-react';

import { InputDiv } from '@/components/form/container/input-div';
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/user/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';

type FormType = {
    name: string;
    email: string;
    phone: string;
    subject: string;
    message: string;
};

export default function Create() {
    const initialValues: FormType = {
        name: '',
        email: '',
        phone: '',
        subject: '',
        message: '',
    };

    const page = usePage();
    const appData = (page.props as any).appData;
    const contactData = (page.props as any).data as any;

    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('contact'),
        initialValues,
        method: 'POST',
        onSuccess: () => console.log('Contact form created successfully!'),
    });
    let processing1 = processing;
    if(appData.debug){
        processing1 = false;
    }
    return (
        <AppLayout title="Contact Us">
            <div className="min-h-screen bg-background  text-foreground">
                <div className="mx-auto max-w-6xl px-4 py-12 lg:py-16">
                    {/* Page Heading */}
                    <div className="mb-10 text-center">
                        <span className="inline-flex items-center rounded-full bg-muted px-3 py-1 text-xs font-medium tracking-wide text-muted-foreground uppercase">
                            Get in touch
                        </span>
                        <h1 className="mt-4 text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">
                            We&apos;d love to hear from you
                        </h1>
                        <p className="mx-auto mt-3 max-w-2xl text-sm text-muted-foreground sm:text-base">
                            Have a question, suggestion, or need support? Send
                            us a message and we&apos;ll get back to you as soon
                            as possible.
                        </p>
                    </div>

                    {/* Main Card */}
                    <div className="grid gap-10 rounded-3xl bg-card p-6 shadow-[0_24px_60px_rgba(0,0,0,0.08)] ring-1 ring-border md:grid-cols-5 md:p-8 lg:p-10">
                        {/* Left: Contact Info */}
                        <div className="space-y-6 border-b border-border pb-6 md:col-span-2 md:border-r md:border-b-0 md:pr-8 md:pb-0">
                            <h2 className="text-xl font-semibold">
                                Contact Information
                            </h2>
                            <p className="text-sm text-muted-foreground">
                                Reach out to us via phone, email, or visit us
                                during working hours.
                            </p>

                            <div className="space-y-4">
                                {/* Phone */}
                                <div className="flex gap-3 rounded-2xl bg-muted/80 p-3.5">
                                    <div className="flex h-10 w-10 items-center justify-center rounded-2xl bg-primary/10">
                                        <Phone className="h-5 w-5 text-primary" />
                                    </div>
                                    <div>
                                        <p className="text-xs font-medium tracking-wide text-muted-foreground uppercase">
                                            Phone
                                        </p>
                                        <a
                                            href={`tel:${appData.phone}`}
                                            className="text-sm font-semibold hover:text-accent"
                                        >
                                            {appData.phone}
                                        </a>
                                    </div>
                                </div>

                                {/* Email */}
                                <div className="flex gap-3 rounded-2xl bg-muted/80 p-3.5">
                                    <div className="flex h-10 w-10 items-center justify-center rounded-2xl bg-primary/10">
                                        <Mail className="h-5 w-5 text-primary" />
                                    </div>
                                    <div>
                                        <p className="text-xs font-medium tracking-wide text-muted-foreground uppercase">
                                            Email
                                        </p>
                                        <a
                                            href={`mailto:${appData.email}`}
                                            className="text-sm font-semibold break-all hover:text-accent"
                                        >
                                            {appData.email}
                                        </a>
                                    </div>
                                </div>

                                {/* Address */}
                                <div className="flex gap-3 rounded-2xl bg-muted/80 p-3.5">
                                    <div className="flex h-10 w-10 items-center justify-center rounded-2xl bg-primary/10">
                                        <MapPin className="h-5 w-5 text-primary" />
                                    </div>
                                    <div>
                                        <p className="text-xs font-medium tracking-wide text-muted-foreground uppercase">
                                            Address
                                        </p>
                                        <p className="text-sm font-semibold whitespace-pre-line">
                                            {appData.address}
                                        </p>
                                    </div>
                                </div>

                                {/* Working Hours */}
                                <div className="flex gap-3 rounded-2xl bg-muted/80 p-3.5">
                                    <div className="flex h-10 w-10 items-center justify-center rounded-2xl bg-primary/10">
                                        <Clock className="h-5 w-5 text-primary" />
                                    </div>
                                    <div>
                                        <p className="text-xs font-medium tracking-wide text-muted-foreground uppercase">
                                            Working Hours
                                        </p>
                                        <p className="text-sm font-semibold">
                                            {contactData.working_hour}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <p className="pt-2 text-xs text-muted-foreground">
                                We usually respond within{' '}
                                <span className="font-semibold">
                                    24–48 business hours.
                                </span>
                            </p>
                        </div>

                        {/* Right: Contact Form */}
                        <div className="md:col-span-3 md:pl-6 lg:pl-10">
                            <h2 className="mb-4 text-xl font-semibold">
                                Send us a message
                            </h2>
                            <p className="mb-6 text-sm text-muted-foreground">
                                Fill out the form below and we&apos;ll get back
                                to you as soon as we can.
                            </p>

                            <form
                                className="flex flex-col gap-4"
                                onSubmit={submit}
                            >
                                <div className="grid gap-4 md:grid-cols-2">
                                    <InputDiv
                                        type="text"
                                        label="Name"
                                        name="name"
                                        inputDivData={inputDivData}
                                    />
                                    <InputDiv
                                        type="email"
                                        label="Email"
                                        name="email"
                                        inputDivData={inputDivData}
                                    />
                                </div>

                                <div className="grid gap-4 md:grid-cols-2">
                                    <InputDiv
                                        type="tel"
                                        label="Phone"
                                        name="phone"
                                        inputDivData={inputDivData}
                                    />
                                    <InputDiv
                                        type="text"
                                        label="Subject"
                                        name="subject"
                                        inputDivData={inputDivData}
                                    />
                                </div>

                                <InputDiv
                                    type="textarea"
                                    label="Message"
                                    name="message"
                                    inputDivData={inputDivData}
                                />

                                <div className="pt-2">
                                    <Button
                                        type="submit"
                                        className="relative mt-2 flex w-full items-center justify-center gap-2 rounded-2xl bg-primary px-6 py-2.5 text-sm font-semibold text-primary-foreground shadow hover:bg-accent/90 disabled:opacity-70 md:w-auto"
                                        tabIndex={4}
                                        disabled={processing1}
                                    >
                                        {processing1 && (
                                            <LoaderCircle className="h-4 w-4 animate-spin" />
                                        )}
                                        {processing1
                                            ? 'Sending...'
                                            : 'Submit Message'}
                                    </Button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {/* Google Map */}
                    <div className="mt-10 lg:mt-12">
                        <h3 className="mb-3 text-base font-semibold">
                            Find us on the map
                        </h3>
                        <div className="overflow-hidden rounded-3xl border border-border bg-card shadow-[0_20px_45px_rgba(0,0,0,0.08)]">
                            <iframe
                                src={contactData.map_embad_url}
                                width="100%"
                                height="380"
                                style={{ border: 0 }}
                                loading="lazy"
                                allowFullScreen
                                referrerPolicy="no-referrer-when-downgrade"
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
