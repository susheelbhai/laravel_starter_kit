import { usePage } from "@inertiajs/react";
import PreviewItem from "../components/PreviewItem";
import PreviewSection from "../components/PreviewSection";

export default function PreviewAwards({ data }: { data: Record<string, unknown> }) {
    const { judging_methods, event }: { judging_methods: Array<{ id: number; title: string }>; event: Record<string, unknown> } = usePage().props as { judging_methods: Array<{ id: number; title: string }>; event: Record<string, unknown> };

    // ✅ 1. Detect awards from both data and event props
    const awards =
        Array.isArray(data?.awards) && data.awards.length > 0
            ? data.awards
            : Array.isArray(event?.awards) && event.awards.length > 0
            ? event.awards
            : [];

    // ✅ 2. Resolve judging method title
    const judgingMethod =
        judging_methods?.find(
            (m) =>
                parseInt(String(m.id)) === parseInt(String(data.judging_method_id ?? event?.judging_method_id))
        )?.title || "—";

    return (
        <PreviewSection
            title="Judging & Awards"
            description="Overview of the judging process, awards, and festival policies."
        >
            {/* === Judging Method === */}
            <PreviewItem label="Judging Method" value={judgingMethod} />

            {/* === Awards === */}
            {awards.length > 0 ? (
                <div className="mt-6">
                    <h3 className="text-md font-semibold text-gray-700 mb-3">
                        Awards & Prizes
                    </h3>
                    <div className="space-y-4">
                        {awards.map((award: Record<string, unknown>, i: number) => (
                            <div
                                key={i}
                                className="rounded-lg border border-gray-200 bg-gray-50 p-4 shadow-sm"
                            >
                                <h4 className="font-semibold text-base text-gray-800 mb-1">
                                    {(award.title as string) || `Award ${i + 1}`}
                                </h4>
                                <p className="text-gray-700 text-sm mb-1">
                                    <span className="font-semibold">Prize:</span>{" "}
                                    {(award.prize as string) || "—"}
                                </p>
                                <p className="text-gray-700 text-sm">
                                    {(award.description as string) || "—"}
                                </p>
                            </div>
                        ))}
                    </div>
                </div>
            ) : (
                <p className="text-gray-600 text-sm mt-4">No awards defined.</p>
            )}

            {/* === Judging Process === */}
            <div className="mt-6">
                <PreviewItem
                    label="How Are Films Judged?"
                    value={data.judging_process || event?.judging_process}
                    isHtml
                />
            </div>

            {/* === Judges === */}
            <div className="mt-4">
                <PreviewItem
                    label="Panel of Judges"
                    value={data.judges || event?.judges}
                    isHtml
                />
            </div>

            {/* === Laurel Policy === */}
            <div className="mt-4">
                <PreviewItem
                    label="Laurel Usage Policy"
                    value={data.laurel_uses_policy || event?.laurel_uses_policy}
                    isHtml
                />
            </div>

            {/* === Deliverables === */}
            <div className="mt-4">
                <PreviewItem
                    label="Deliverables on Selection"
                    value={data.deliverable_on_selection || event?.deliverable_on_selection}
                    isHtml
                />
            </div>

            {/* === Rules === */}
            <div className="mt-4">
                <PreviewItem
                    label="Rules & Terms"
                    value={data.rules || event?.rules}
                    isHtml
                />
            </div>
        </PreviewSection>
    );
}
