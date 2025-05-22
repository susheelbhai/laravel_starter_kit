import { useForm, usePage } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import { FormEventHandler } from 'react';

import { Button } from '@/components/ui/button';
import { InputDiv } from '@/components/ui/input-div';
import AppLayout from '@/layouts/user/app-layout';

type CreateForm = {
    name: string;
    email: string;
    phone: string;
    subject: string;
    message: string;
};

export default function Create() {
    const { setData, post, processing, errors, reset, data } = useForm<Required<CreateForm>>({
        name: '',
        email: '',
        phone: '',
        subject: '',
        message: '',
    });

    const inputDivData = {
        data,
        setData,
        errors: Object.fromEntries(Object.entries(errors).map(([key, value]) => [key, value ? [value] : []])),
    };
    const appData = (usePage().props as any).appData ;
    const contactData = usePage().props.data as any;

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        const submitUrl = route('contact');
        if (submitUrl) {
            post(submitUrl, {
                onFinish: () => reset('name', 'email', 'phone'),
                onError: (errors) => {
                    console.log('Validation Errors:', errors);
                    // You may want to manually log or set state for errors if needed
                },
                onSuccess: () => {
                    reset(); // Only reset after successful submission
                },
            });
        } else {
            console.error('Submit URL is not defined.');
        }
    };

    return (
        <AppLayout title="Contact Us">
            <div className="bg-white font-['Urbanist'] text-[#0E1339]">
                {/* Container */}
                <div className="mx-auto max-w-7xl px-4 py-12">
                    <h2 className="mb-8 text-center text-4xl font-bold">Contact Us</h2>

                    {/* Grid Section */}
                    <div className="grid grid-cols-1 gap-10 md:grid-cols-2">
                        {/* Left: Contact Info */}
                        <div className="space-y-6">
                            <div>
                                <h4 className="text-lg font-semibold">Phone</h4>
                                <a href={`tel:${appData.phone}`} className="text-gray-700">{appData.phone}</a>
                            </div>
                            <div>
                                <h4 className="text-lg font-semibold">Email</h4>
                                <a href={`mailto:${appData.email}`} className="text-gray-700">{appData.email}</a>
                            </div>
                            <div>
                                <h4 className="text-lg font-semibold">Address</h4>
                                <p className="text-gray-700">
                                    {appData.address}
                                </p>
                            </div>
                            <div>
                                <h4 className="text-lg font-semibold">Working Hours</h4>
                                <p className="text-gray-700">{contactData.working_hour}</p>
                            </div>
                        </div>

                        {/* Right: Contact Form */}
                        <div>
                            <form className="flex flex-col gap-6" onSubmit={submit}>
                                <InputDiv type="text" label="Name" name="name" inputDivData={inputDivData} />
                                <InputDiv type="email" label="Email" name="email" inputDivData={inputDivData} />
                                <InputDiv type="tel" label="Phone" name="phone" inputDivData={inputDivData} />
                                <InputDiv type="text" label="Subject" name="subject" inputDivData={inputDivData} />
                                <InputDiv type="textarea" label="Message" name="message" inputDivData={inputDivData} />

                                <Button type="submit" className="mt-4 w-full" tabIndex={4} disabled={processing}>
                                    {processing && <LoaderCircle className="h-4 w-4 animate-spin" />}
                                    Submit
                                </Button>
                            </form>
                        </div>
                    </div>

                    {/* Google Map */}
                    <div className="mt-12">
                        <iframe
                            src={contactData.map_embad_url}
                            width="100%"
                            height="400"
                            style={{ border: 0 }}
                            loading="lazy"
                            allowFullScreen
                            referrerPolicy="no-referrer-when-downgrade"
                        ></iframe>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
