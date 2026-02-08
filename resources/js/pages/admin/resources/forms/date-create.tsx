import { Head, usePage } from '@inertiajs/react';
import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import type { BreadcrumbItem } from '@/types';

type FormType = {
    date: string;
    datetime: string;
};

const initialValues: FormType = {
    date: '',
    datetime: '',
};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Simple Form', href: '/admin' },
    { title: 'Create', href: '/admin/forms/date-create' },
];

export default function CreateForm() {
    const { submit, inputDivData, processing } = useFormHandler<FormType>({
        url: route('admin.forms.simple.store'),
        initialValues,
        method: 'PATCH',
        onSuccess: () => console.log('Simple form created successfully!'),
    });
    const states = usePage().props.states as { id: string; title: string }[];
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Simple Form" />
            <FormContainer onSubmit={submit} processing={processing}>
                <InputDiv
                    type="date"
                    label="Date"
                    name="date"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="datetime-local"
                    label="Date & Time"
                    name="datetime"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="date-picker"
                    label="Date Picker"
                    name="date_picker"
                    inputDivData={inputDivData}
                />
                
                <InputDiv
                    type="date-range-picker"
                    label="Date Range Picker"
                    name="date_range_picker"
                    inputDivData={inputDivData}
                />
                
                <InputDiv
                    type="date-range-picker-expended"
                    label="Date Range Picker Expended"
                    name="date_range_picker_expended"
                    inputDivData={inputDivData}
                />

                <InputDiv
                    type="time-picker"
                    timeFormat="12"
                    label="Time Picker"
                    name="time_picker"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="clock-time-picker"
                    label="Clock Time Picker"
                    name="clock_time_picker"
                    inputDivData={inputDivData}
                />
                <InputDiv
                    type="date-time-picker"
                    timeFormat="12"
                    label="Date & Time Picker"
                    name="datetime_picker"
                    inputDivData={inputDivData}
                />
            </FormContainer>
        </AppLayout>
    );
}
