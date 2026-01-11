import { FormContainer } from '@/components/form/container/form-container';
import { InputDiv } from '@/components/form/container/input-div';
import AppLayout from '@/layouts/admin/app-layout';
import { useFormHandler } from '@/lib/use-form-handler';
import { BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';

type FormType = {
    // basic text inputs
    text: string;
    number: string;
    email: string;
    password: string;
    tel: string;

    // hidden
    hidden_field: string;

    // choice inputs
    radio: string;
    select: string;
    multiselect: Array<number> | '';
    tag: string;
    checkbox: number; // 0/1
    multicheckbox: string[];

    // file / image
    image: string | File;
    images: (string | File)[];
    file: string | File;
    files: (string | File)[];

    // switch
    switch: number;

    // default input
    default_input: string;
};

const initialValues: FormType = {
    text: '',
    number: '',
    email: '',
    password: '',
    tel: '',

    hidden_field: 'hidden-value',

    radio: 'option1',
    select: '',
    multiselect: [],
    tag: '',
    checkbox: 0,
    multicheckbox: [],

    image: '',
    images: [],
    file: '',
    files: [],

    switch: 1,

    default_input: '',
};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Simple Form', href: '/admin/team' },
    { title: 'Create', href: '/admin/team/create' },
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
                {/* Radio */}
                <InputDiv
                    type="radio"
                    label="Radio Options"
                    name="radio"
                    inputDivData={inputDivData}
                    options={[
                        { title: 'Option 1', value: 'option1' },
                        { title: 'Option 2', value: 'option2' },
                        { title: 'Option 3', value: 'option3' },
                    ]}
                />

                {/* Select */}
                <InputDiv
                    type="select"
                    label="Select"
                    name="select"
                    inputDivData={inputDivData}
                    options={states}
                />

                {/* Multi Select */}
                <InputDiv
                    type="multiselect"
                    label="Multi Select"
                    name="multiselect"
                    inputDivData={inputDivData}
                    options={states}
                />

                {/* Checkbox (single) */}
                <InputDiv
                    type="checkbox"
                    label="Checkbox (Single)"
                    name="checkbox"
                    inputDivData={inputDivData}
                />

                {/* Multi Checkbox */}
                <InputDiv
                    type="multicheckbox"
                    label="Multi Checkbox"
                    name="multicheckbox"
                    inputDivData={inputDivData}
                    options={[
                        { label: 'Check 1', value: 'c1' },
                        { label: 'Check 2', value: 'c2' },
                        { label: 'Check 3', value: 'c3' },
                    ]}
                />

                <InputDiv
                    type="tags"
                    label="Tag"
                    name="tags"
                    inputDivData={inputDivData}
                />

                {/* Switch */}
                <InputDiv
                    type="switch"
                    label="Switch"
                    name="switch"
                    inputDivData={inputDivData}
                />
            </FormContainer>
        </AppLayout>
    );
}
