import PreviewItem from "../components/PreviewItem";
import PreviewSection from "../components/PreviewSection";

export default function PreviewOtherInfo({ data }: { data: any }) {
    return (
        <PreviewSection
            title="Other Information"
            description="Additional commitments, statements, or notes shared with The Film Sub team."
        >
            <PreviewItem
                label="Code of Conduct"
                value={data.code_of_conduct}
                isHtml
            />
            <PreviewItem
                label="Diversity Statement"
                value={data.diversity_statement}
                isHtml
            />
            <PreviewItem
                label="Accessibility Commitment"
                value={data.accessibility_commitment}
                isHtml
            />
            <PreviewItem
                label="Additional Notes for The Film Sub Team"
                value={data.additional_notes}
                isHtml
            />
        </PreviewSection>
    );
}
