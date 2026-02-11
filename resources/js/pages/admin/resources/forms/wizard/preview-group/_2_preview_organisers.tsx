import PreviewImages from "../components/PreviewImages";
import PreviewItem from "../components/PreviewItem";
import PreviewSection from "../components/PreviewSection";

export default function PreviewOrganisers({ data }: { data: Record<string, unknown> }) {
    const organisers = Array.isArray(data.eventOrganisers) ? data.eventOrganisers : [];

    // Detect possible file URL/object for proof_of_address
    const getFileUrl = (file: unknown): string | null => {
        if (!file) return null;
        if (typeof file === "string") return file;
        if (typeof file === 'object' && file !== null) {
            const fileObj = file as Record<string, unknown>;
            if (fileObj.original_url && typeof fileObj.original_url === 'string') return fileObj.original_url;
            if (fileObj.url && typeof fileObj.url === 'string') return fileObj.url;
        }
        if (Array.isArray(file) && file.length > 0) return getFileUrl(file[0]);
        if (Array.isArray(data.media)) {
            const mediaFile = (data.media as Array<Record<string, unknown>>).find((m) => m.collection_name === "proof_of_address");
            return (mediaFile?.original_url as string) || null;
        }
        return null;
    };

    const proofUrl = getFileUrl(data.proof_of_address);

    return (
        <PreviewSection
            title="Organizer & Legal"
            description="Official details of the organisation and its key representatives."
        >
            {/* Basic Org Details */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <PreviewItem label="Organization / Legal Entity" value={data.organization_name} />
                <PreviewItem label="Registered Address" value={data.organization_address} />
                <PreviewItem label="Primary Contact Name" value={data.primary_contact_name} />
                <PreviewItem label="Role/Title" value={data.role} />
                <PreviewItem label="Email" value={data.email} />
                <PreviewItem label="Phone" value={data.phone} />
                <PreviewItem label="GSTIN" value={data.gstin} />
                <PreviewItem label="PAN" value={data.pan} />
            </div>

            {/* Event Organisers */}
            {organisers.length > 0 && (
                <div>
                    <h3 className="text-md font-semibold text-gray-700 mt-6 mb-2">Event Organisers</h3>
                    <div className="space-y-2">
                        {organisers.map((org: Record<string, unknown>, i: number) => (
                            <div key={i} className="flex items-center justify-between rounded border p-2">
                                <span className="font-medium text-gray-700">{(org.title as string) || "—"}</span>
                                <span className="text-gray-800">{(org.name as string) || "—"}</span>
                            </div>
                        ))}
                    </div>
                </div>
            )}

            {/* Optional Bank Details */}
            {(data.bank_account_holder_name ||
                data.bank_account_number ||
                data.bank_ifsc ||
                data.bank_upi_id) && (
                <>
                    <h3 className="text-md font-semibold text-gray-700 mt-6 mb-2">Bank Details</h3>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <PreviewItem label="Account Holder Name" value={data.bank_account_holder_name} />
                        <PreviewItem label="Account Number" value={data.bank_account_number} />
                        <PreviewItem label="IFSC Code" value={data.bank_ifsc} />
                        <PreviewItem label="UPI ID" value={data.bank_upi_id} />
                    </div>
                </>
            )}

            {/* Proof of Address */}
            {proofUrl && (
                <div>
                    <h3 className="text-md font-semibold text-gray-700 mt-6 mb-2">
                        Proof of Address / Incorporation
                    </h3>
                    {proofUrl.match(/\.(jpg|jpeg|png|gif|webp)$/i) ? (
                        <PreviewImages label="Proof of Address" urls={[proofUrl]} single />
                    ) : (
                        <a
                            href={proofUrl}
                            target="_blank"
                            rel="noopener noreferrer"
                            className="text-blue-600 underline"
                        >
                            View Uploaded File
                        </a>
                    )}
                </div>
            )}
        </PreviewSection>
    );
}
