import { usePage } from '@inertiajs/react';
import { ChevronDown, ChevronUp } from 'lucide-react';
import { useState } from 'react';
import { Container } from '@/components/ui/container';
import { ContainerFluid } from '@/components/ui/container-fluid';
import AppLayout from '@/layouts/user/app-layout';

interface FAQ {
    id: number;
    question: string;
    answer: string;
}

interface FAQSection {
    category_title: string;
    faqs: FAQ[];
}

export default function FAQ() {
    const data = usePage().props.data as FAQSection[];
    const [openIndex, setOpenIndex] = useState<{ [key: string]: number | null }>({});

    const toggle = (category: string, index: number) => {
        setOpenIndex((prev) => ({
            ...prev,
            [category]: prev[category] === index ? null : index,
        }));
    };

    return (
        <AppLayout title="FAQ">
            <ContainerFluid>
                <Container>
                    <h1 className="mb-6 text-3xl font-bold">Help & Support Center</h1>
                    {data.map((section) => (
                        <div key={section.category_title} className="mb-6">
                            <h2 className="mb-4 text-2xl font-semibold">{section.category_title}</h2>
                            <div className="space-y-3">
                                {section.faqs.map((faq) => {
                                    const isOpen = openIndex[section.category_title] === faq.id;
                                    return (
                                        <div key={faq.id} className="cursor-pointer" onClick={() => toggle(section.category_title, faq.id)}>
                                            <div className="flex items-center justify-between rounded-t-lg bg-primary/30 p-4 text-foreground">
                                                <h3 className="text-lg font-medium">{faq.question}</h3>
                                                {isOpen ? <ChevronUp size={20} /> : <ChevronDown size={20} />}
                                            </div>
                                            {isOpen && (
                                                <div className="rounded-b-lg border-t bg-card p-4 whitespace-pre-line text-muted-foreground">
                                                    <div dangerouslySetInnerHTML={{ __html: faq.answer }} />
                                                </div>
                                            )}
                                        </div>
                                    );
                                })}
                            </div>
                        </div>
                    ))}
                </Container>
            </ContainerFluid>
        </AppLayout>
    );
}
