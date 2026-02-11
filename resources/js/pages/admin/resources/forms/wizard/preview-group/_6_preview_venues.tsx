import { usePage } from "@inertiajs/react";
import PreviewItem from "../components/PreviewItem";
import PreviewSection from "../components/PreviewSection";

export default function PreviewVenues({ data }: { data: Record<string, unknown> }) {
    const { event }: { event: Record<string, unknown> } = usePage().props as { event: Record<string, unknown> };

    // ✅ Fallback handling — prefer `data` first, then `event`
    const venueType = data.venue_type || event?.venue_type || "—";
    const venues =
        Array.isArray(data.venues) && data.venues.length > 0
            ? data.venues
            : Array.isArray(event?.venues)
            ? event.venues
            : [];

    const virtualPlatform =
        data.venue_virtual_platform || event?.venue_virtual_platform || "—";

    const drmProtection = !!(data.drm_protection ?? event?.drm_protection);
    const geoBlocking = !!(data.geo_blocking ?? event?.geo_blocking);

    return (
        <PreviewSection
            title="Format & Venues"
            description="Information about event format, venue details, and virtual platforms."
        >
            {/* === Event Format === */}
            <PreviewItem label="Event Format" value={venueType} />

            {/* === Physical / Hybrid Venues === */}
            {(venueType === "Physical" || venueType === "Hybrid") && (
                <div className="mt-6">
                    <h3 className="text-md font-semibold text-gray-700 mb-3">
                        Physical Venues
                    </h3>

                    {venues.length > 0 ? (
                        <div className="space-y-4">
                            {venues.map((venue: Record<string, unknown>, i: number) => (
                                <div
                                    key={i}
                                    className="rounded-lg border border-gray-200 bg-gray-50 p-4 shadow-sm"
                                >
                                    <h4 className="font-semibold text-base text-gray-800 mb-1">
                                        {(venue.name as string) || `Venue ${i + 1}`}
                                    </h4>
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <PreviewItem
                                            label="Seating Capacity"
                                            value={venue.sitting_capacity as string}
                                        />
                                        <PreviewItem
                                            label="Projection Type"
                                            value={venue.projection_type as string}
                                        />
                                        <PreviewItem
                                            label="Audio System"
                                            value={venue.audio_system as string}
                                        />
                                        <PreviewItem
                                            label="Address"
                                            value={venue.address as string}
                                        />
                                    </div>

                                    {/* Accessibility */}
                                    <div className="mt-2">
                                        <h5 className="text-sm font-semibold text-gray-700">
                                            Accessibility
                                        </h5>
                                        <ul className="list-disc list-inside text-gray-700 ml-3 text-sm">
                                            {venue.wheelchair && (
                                                <li>Wheelchair Access</li>
                                            )}
                                            {venue.caption && (
                                                <li>Caption Equipment</li>
                                            )}
                                            {venue.hearing && (
                                                <li>Hearing Loop</li>
                                            )}
                                            {!venue.wheelchair &&
                                                !venue.caption &&
                                                !venue.hearing && (
                                                    <li>—</li>
                                                )}
                                        </ul>
                                    </div>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <p className="text-gray-600 text-sm">
                            No venue details added.
                        </p>
                    )}
                </div>
            )}

            {/* === Virtual Platform (for Online / Hybrid) === */}
            {(venueType === "Online" || venueType === "Hybrid") && (
                <div className="mt-6">
                    <h3 className="text-md font-semibold text-gray-700 mb-3">
                        Virtual Platform
                    </h3>

                    <PreviewItem
                        label="Platform"
                        value={virtualPlatform}
                    />

                    <div className="mt-2">
                        <h5 className="text-sm font-semibold text-gray-700 mb-1">
                            Security Features
                        </h5>
                        <ul className="list-disc list-inside text-gray-700 ml-3 text-sm">
                            {drmProtection && <li>DRM Protection Enabled</li>}
                            {geoBlocking && <li>Geo-blocking (India only)</li>}
                            {!drmProtection && !geoBlocking && (
                                <li>None</li>
                            )}
                        </ul>
                    </div>
                </div>
            )}
        </PreviewSection>
    );
}
