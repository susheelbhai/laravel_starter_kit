import InputFieldset from '@/components/form/input-fieldset';
import PreviewBasic from './_1_preview_basic';
import PreviewOrganisers from './_2_preview_organisers';
import PreviewDates from './_3_preview_dates';
import PreviewTechnical from './_4_preview_technical';
import PreviewAwards from './_5_preview_awards';
import PreviewVenues from './_6_preview_venues';
import PreviewSocial from './_7_preview_social_media';
import PreviewOtherInfo from './_8_preview_other_info';

export default function PreviewSection({ data, event_types }: { data: any; event_types: any[] }) {
    return (
        <InputFieldset legend="Preview Your Festival">
            <PreviewBasic data={data} event_types={event_types} />
            <PreviewOrganisers data={data} />
            <PreviewDates data={data} />
            <PreviewTechnical data={data} />
            <PreviewAwards data={data} />
            <PreviewVenues data={data} />
            <PreviewSocial data={data} />
            <PreviewOtherInfo data={data} />
        </InputFieldset>
    );
}
