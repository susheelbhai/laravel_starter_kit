import PreviewImages from '../components/PreviewImages';
import PreviewItem from '../components/PreviewItem';
import PreviewSection from '../components/PreviewSection';
import type { PreviewComponentProps } from '../types';

export default function PreviewBasicDetails({ data, event_types, event_primary_foci }: PreviewComponentProps) {
    const getTitles = (ids: unknown[], list: Array<{ id: number; title: string }>) =>
        Array.isArray(ids) && Array.isArray(list) ? list.filter((x) => ids.includes(x.id)).map((x) => x.title) : [];

    const festivalTypes = getTitles(data.event_type_ids as unknown[], event_types || []);
    const primaryFocus = getTitles(data.event_primary_focus_ids as unknown[], event_primary_foci || []);

    return (
        <PreviewSection title="Festival Profile" description="A quick summary of your festival’s identity and presentation.">
            <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                <PreviewItem label="Festival Name" value={data.title} />
                <PreviewItem label="Edition" value={data.edition} />
            </div>

            <PreviewItem label="Tagline" value={data.tagline} />
            <PreviewItem label="Festival Overview" value={data.description} isHtml />

            <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                <PreviewItem label="Festival Type" value={festivalTypes} />
                <PreviewItem label="Primary Focus" value={primaryFocus} />
            </div>

            <PreviewItem label="Years Running" value={data.years_running} />

            <PreviewItem label="Festival Website / Social Media" value={data.website} />
            <PreviewImages label="Logo" urls={data.logo || data.media} single />
            <PreviewImages label="Cover Pic" urls={data.cover_pic || data.media} single />
            <PreviewImages label="Gallery Images" urls={data.gallery_images || data.media} />
        </PreviewSection>
    );
}
