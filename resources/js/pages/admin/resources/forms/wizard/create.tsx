import { Button } from '@/components/ui/button';
import { Container } from '@/components/ui/container';
import { ContainerFluid } from '@/components/ui/container-fluid';
import { SharedData } from '@/types';
import { useForm, usePage } from '@inertiajs/react';
import { FormEventHandler, useEffect, useState } from 'react';

import AppLayout from '@/layouts/admin/app-layout';
import { initForm } from './_init_form';
import BasicDetails from './input-group/_1_basic-details';
import BankDetail from './input-group/_2_bank';
import Education from './input-group/_3_education';
import OtherInfoSection from './input-group/_4_other_info';
import PreviewSection from './preview-group/index';
// steps definition
const steps = [
    { id: 1, title: 'Basic Details', Component: BasicDetails },
    { id: 2, title: 'Bank Detail', Component: BankDetail },
    { id: 3, title: 'Education', Component: Education },
    { id: 4, title: 'Other Info', Component: OtherInfoSection },
    { id: 5, title: 'Preview', Component: PreviewSection },
];

// Helpers
const jsonStringifyNested = (d: EditEventForm) =>
    ({
        ...d,
        courses: JSON.stringify(d.courses ?? []),
        _method: 'PATCH',
    }) as unknown as EditEventForm;

const mapErrors = (errs: Record<string, string>) =>
    Object.fromEntries(Object.entries(errs).map(([k, v]) => [k, v ? [v] : []]));

export default function EditEvent() {
    const { data: event } = usePage<SharedData>().props as any;
    const { setData, post, processing, errors, reset, data, transform } =
        useForm<EditEventForm>(initForm(event));

    const [step, setStep] = useState(0);
    const [completedSteps, setCompletedSteps] = useState<number[]>([]);

    const inputDivData = { data, setData, errors: mapErrors(errors) };

    // ✅ Submit entire form to partial_update route on each step
    const saveStep = (stepIndex: number) => {
        const stepInfo = steps[stepIndex];
        const stepKey = stepInfo.title.toLowerCase().replace(/\s+/g, '_'); // e.g. basic_details
        transform(jsonStringifyNested);

        post(
            route('admin.forms.wizard.partial_update', {
                id: event.id,
                field: stepKey,
            }),
            {
                forceFormData: true,
                preserveScroll: true,
                onFinish: () => transform((x) => x),
                onSuccess: () => {
                    setCompletedSteps((prev) => [
                        ...new Set([...prev, stepIndex]),
                    ]);
                    if (stepIndex < steps.length - 1) setStep(stepIndex + 1);
                },
            },
        );
    };

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        transform(jsonStringifyNested);
        post(route('admin.forms.wizard.submit', event.id), {
            // ✅ updated route
            forceFormData: true,
            preserveScroll: true,
            onFinish: () => transform((x) => x),
            onSuccess: () => reset(),
        });
    };

    const CurrentStepComponent = steps[step].Component as React.FC<any>;

    // after const CurrentStepComponent = steps[step].Component;
    useEffect(() => {
        const handleEnter = (e: KeyboardEvent) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                const active = document.activeElement as HTMLElement;
                const tag = active?.tagName?.toLowerCase();
                if (tag === 'textarea' || tag === 'select') return;
                e.preventDefault();
                saveStep(step);
            }
        };
        window.addEventListener('keydown', handleEnter);
        return () => window.removeEventListener('keydown', handleEnter);
    }, [step, data]);

    return (
        <AppLayout title="Form Wizard">
            <ContainerFluid>
                <Container>
                    <h1 className="mb-6 text-center text-2xl font-bold text-primary">
                        Student Registration Form
                    </h1>

                    {/* Step Tabs */}
                    <div className="mb-6 flex overflow-hidden rounded-md bg-[#fdf8f2]">
                        {steps.map((s, idx) => {
                            let classes =
                                'flex-1 border-r border-white p-3 text-sm font-medium last:border-r-0 ';
                            if (idx === step) {
                                classes += 'bg-[#E2BE68] text-white'; // current step
                            } else if (completedSteps.includes(idx)) {
                                classes += 'bg-[#A3D86F] text-white'; // completed
                            } else {
                                classes +=
                                    'bg-background2 text-gray-700 hover:bg-gray-100';
                            }

                            return (
                                <button
                                    key={s.id}
                                    type="button"
                                    onClick={() => setStep(idx)}
                                    className={classes}
                                >
                                    {s.title}
                                </button>
                            );
                        })}
                    </div>

                    <form onSubmit={submit}>
                        <CurrentStepComponent
                            inputDivData={inputDivData}
                            data={data}
                            setData={setData}
                        />

                        {/* Navigation buttons */}
                        <div className="mt-6 flex justify-between">
                            {step > 0 && (
                                <Button
                                    type="button"
                                    onClick={() => setStep(step - 1)}
                                >
                                    Previous
                                </Button>
                            )}
                            {step < steps.length - 1 ? (
                                <Button
                                    type="button"
                                    onClick={() => saveStep(step)}
                                    disabled={processing}
                                >
                                    {processing ? 'Saving...' : 'Save & Next'}
                                </Button>
                            ) : (
                                <Button type="submit" disabled={processing}>
                                    {processing ? 'Submitting...' : 'Submit'}
                                </Button>
                            )}
                        </div>
                    </form>
                </Container>
            </ContainerFluid>
        </AppLayout>
    );
}
