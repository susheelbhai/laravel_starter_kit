import PreviewItem from "../components/PreviewItem";
import PreviewSection from "../components/PreviewSection";

export default function PreviewOtherInfo({ data }: { data: Record<string, unknown> }) {
    return (
        <PreviewSection
            title="Other Information"
            description="Additional commitments, statements, or notes shared with The Film Sub team."
        >
            <PreviewItem
                label="Code of Conduct"
                value={data.code_of_conduct as string}
                isHtml
            />
            <PreviewItem
                label="Diversity Statement"
                value={data.diversity_statement as string}
                isHtml
            />
            <PreviewItem
                label="Accessibility Commitment"
                value={data.accessibility_commitment as string}
                isHtml
            />
            <PreviewItem
                label="Additional Notes for The Film Sub Team"
                value={data.additional_notes as string}
                isHtml
            />
        </PreviewSection>
    );
}
