import type { EditEventForm } from './types';

export const initForm = (event: Record<string, unknown>): EditEventForm => ({
    name: event.name ?? '',
    email: event.email ?? '',
    phone: event.phone ?? '',
    address1: event.address1 ?? '',
    address2: event.address2 ?? '',
    city: event.city ?? '',
    pin_code: event.pin_code ?? '',
    state: event.state ?? '',
    country: event.country ?? '',
    profile_pic: event.profile_pic ?? '',

    bank_account_holder_name: event.bank_account_holder_name ?? '',
    bank_account_number: event.bank_account_number ?? '',
    bank_ifsc: event.bank_ifsc ?? '',
    bank_upi_id: event.bank_upi_id ?? '',

    courses: (event.courses as EditEventForm['courses']) ?? [],

    short_description: event.short_description ?? '',
    biodata: event.biodata ?? '',
});
