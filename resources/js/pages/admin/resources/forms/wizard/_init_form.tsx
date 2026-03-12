import type { EditEventForm } from './types';

export const initForm = (event: Record<string, unknown>): EditEventForm => ({
    name: (event.name as string) ?? '',
    email: (event.email as string) ?? '',
    phone: (event.phone as string) ?? '',
    address1: (event.address1 as string) ?? '',
    address2: (event.address2 as string) ?? '',
    city: (event.city as string) ?? '',
    pin_code: (event.pin_code as string) ?? '',
    state: (event.state as string) ?? '',
    country: (event.country as string) ?? '',
    profile_pic: (event.profile_pic as string | File) ?? '',

    bank_account_holder_name: (event.bank_account_holder_name as string) ?? '',
    bank_account_number: (event.bank_account_number as string) ?? '',
    bank_ifsc: (event.bank_ifsc as string) ?? '',
    bank_upi_id: (event.bank_upi_id as string) ?? '',

    courses: (event.courses as EditEventForm['courses']) ?? [],

    short_description: (event.short_description as string) ?? '',
    biodata: (event.biodata as string) ?? '',
});
