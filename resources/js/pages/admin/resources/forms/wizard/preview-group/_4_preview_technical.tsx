import { usePage } from "@inertiajs/react";
import PreviewItem from "../components/PreviewItem";
import PreviewSection from "../components/PreviewSection";

export default function PreviewSubmissionRequirements({ data }: { data: any }) {
    // ✅ Same as form — get all lists from Inertia props
    const genres = usePage().props.genres as any[];
    const screener_formats = usePage().props.screener_formats as any[];
    const projection_masters = usePage().props.projection_masters as any[];
    const audio_specifications = usePage().props.audio_specifications as any[];

    // ✅ Helper to map selected IDs to titles (handles strings vs numbers)
    const getTitles = (ids: any, list: any[]) => {
        if (!Array.isArray(list) || !ids) return [];
        const normalizedIds = Array.isArray(ids)
            ? ids.map((v) => parseInt(v))
            : typeof ids === "string"
            ? ids.split(",").map((v) => parseInt(v))
            : [];
        return list
            .filter((item) => normalizedIds.includes(parseInt(item.id)))
            .map((item) => item.title);
    };

    // ✅ Resolved names for all multi-select fields
    const acceptedGenres = getTitles(data.genre_ids, genres);
    const acceptedScreenerFormats = getTitles(data.screener_format_ids, screener_formats);
    const acceptedProjectionMasters = getTitles(data.projection_master_ids, projection_masters);
    const acceptedAudioSpecs = getTitles(data.audio_specification_ids, audio_specifications);

    return (
        <PreviewSection
            title="Technical & Delivery"
            description="Submission formats, technical specifications, and delivery details."
        >
            {/* === Genres === */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <PreviewItem label="Accepted Film Genres" value={acceptedGenres} />
                <PreviewItem label="Custom Film Genres" value={data.custom_genres} />
            </div>

            {/* === Screener Formats === */}
            <div className="mt-6">
                <h3 className="text-md font-semibold text-gray-700 mb-2">Accepted Screener Formats</h3>
                {acceptedScreenerFormats.length > 0 ? (
                    <ul className="list-disc list-inside text-gray-800 ml-3">
                        {acceptedScreenerFormats.map((f) => (
                            <li key={f}>{f}</li>
                        ))}
                    </ul>
                ) : (
                    <p className="text-gray-600 text-sm">—</p>
                )}
            </div>

            {/* === Projection Masters === */}
            <div className="mt-4">
                <h3 className="text-md font-semibold text-gray-700 mb-2">Projection Masters</h3>
                {acceptedProjectionMasters.length > 0 ? (
                    <ul className="list-disc list-inside text-gray-800 ml-3">
                        {acceptedProjectionMasters.map((m) => (
                            <li key={m}>{m}</li>
                        ))}
                    </ul>
                ) : (
                    <p className="text-gray-600 text-sm">—</p>
                )}
            </div>

            {/* === Audio Specs === */}
            <div className="mt-4">
                <h3 className="text-md font-semibold text-gray-700 mb-2">Audio Specifications</h3>
                {acceptedAudioSpecs.length > 0 ? (
                    <ul className="list-disc list-inside text-gray-800 ml-3">
                        {acceptedAudioSpecs.map((a) => (
                            <li key={a}>{a}</li>
                        ))}
                    </ul>
                ) : (
                    <p className="text-gray-600 text-sm">—</p>
                )}
            </div>

            {/* === Other Technical Fields === */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                <PreviewItem label="Subtitle Requirements" value={data.subtitle_requirements} />
                <PreviewItem label="Language Requirements" value={data.language_requirements} />
                <PreviewItem label="Age Restrictions (if any)" value={data.age_restrictions} />
            </div>

            {/* === Optional Policies === */}
            <div className="mt-6">
                <PreviewItem label="Watermark / DRM Policy" value={data.watermark_drm_policy} isHtml />
                <PreviewItem label="Shipping / Upload Instructions" value={data.shipping_upload_instruction} isHtml />
            </div>
        </PreviewSection>
    );
}
