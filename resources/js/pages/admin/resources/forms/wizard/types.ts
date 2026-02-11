// Form wizard types
export interface EditEventForm {
    name: string;
    email: string;
    phone: string;
    address1: string;
    address2: string;
    city: string;
    pin_code: string;
    state: string;
    country: string;
    profile_pic: string | File;

    bank_account_holder_name?: string;
    bank_account_number?: string;
    bank_ifsc?: string;
    bank_upi_id?: string;

    courses: CourseData[];
    short_description?: string;
    biodata?: string;
}

export interface CourseData {
    name: string;
    university: string;
    marks: number;
    passing_year: number;
}

export interface InputDivData {
    data: Record<string, unknown>;
    setData: (key: string, value: unknown) => void;
    errors: Record<string, string[]>;
}

export interface WizardComponentProps {
    inputDivData: InputDivData;
    data?: EditEventForm;
    setData?: (data: EditEventForm) => void;
}

export interface PreviewComponentProps {
    data: Record<string, unknown>;
    event_types?: Array<{ id: number; title: string }>;
    event_primary_foci?: Array<{ id: number; title: string }>;
}