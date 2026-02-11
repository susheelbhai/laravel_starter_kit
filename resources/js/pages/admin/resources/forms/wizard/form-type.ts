export type EditEventForm = {
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

    courses: { title: string; name: string }[];
    short_description?: string;
    biodata?: string;
};
