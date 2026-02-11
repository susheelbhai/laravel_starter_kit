import { usePage } from '@inertiajs/react';
import { ChevronDown, ChevronRight } from 'lucide-react';
import { useState } from 'react';
import PreviewItem from '../components/PreviewItem';
import PreviewSection from '../components/PreviewSection';

// helper to get ordinal suffix
const getOrdinal = (n: number): string => {
    const j = n % 10;
    const k = n % 100;
    if (k >= 11 && k <= 13) return 'th';
    if (j === 1) return 'st';
    if (j === 2) return 'nd';
    if (j === 3) return 'rd';
    return 'th';
};

// helper to format a date string as "2nd August 2025"
const formatDate = (dateStr: string): string => {
    if (!dateStr) return '—';
    const date = new Date(dateStr);
    const day = date.getDate();
    const suffix = getOrdinal(day);
    const month = date.toLocaleString('default', { month: 'long' });
    const year = date.getFullYear();
    return `${day}${suffix} ${month} ${year}`;
};

export default function PreviewImportantDates({ data }: { data: Record<string, unknown> }) {
    const { event }: { event: Record<string, unknown> } = usePage().props as { event: Record<string, unknown> };

    // ✅ fallback (direct page vs form navigation)
    const deadlines =
        Array.isArray(data?.deadlines) && data.deadlines.length > 0 ? data.deadlines : Array.isArray(event?.deadlines) ? event.deadlines : [];

    const categories =
        Array.isArray(data?.categories) && data.categories.length > 0 ? data.categories : Array.isArray(event?.categories) ? event.categories : [];

    const [expanded, setExpanded] = useState<Record<number, boolean>>({});
    const [hoveredCategoryId, setHoveredCategoryId] = useState<number | null>(null);
    const [hoveredRowId, setHoveredRowId] = useState<number | null>(null);
    const toggle = (id: number) => setExpanded((prev) => ({ ...prev, [id]: !prev[id] }));

    const now = new Date();

    return (
        <>
            {/* === Festival Dates === */}
            <PreviewSection title="Festival Dates & Location" description="Timeline and important dates for submissions and events.">
                <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <PreviewItem label="Opening Date" value={formatDate(data.opening_date || event?.opening_date)} />
                    <PreviewItem label="Notification Date" value={formatDate(data.notification_date || event?.notification_date)} />
                    <PreviewItem label="Event Start Date" value={formatDate(data.start_date || event?.start_date)} />
                    <PreviewItem label="Event End Date" value={formatDate(data.end_date || event?.end_date)} />
                </div>

                {deadlines.length > 0 && (
                    <div className="mt-6">
                        <h3 className="text-md mb-2 font-semibold text-gray-700">Submission Deadlines</h3>
                        <ul className="ml-3 list-inside list-disc text-sm text-gray-800">
                            {deadlines.map((d: Record<string, unknown>, i: number) => (
                                <li key={i}>
                                    <span className="font-semibold">{d.name as string}</span> — {formatDate(d.date as string)}
                                </li>
                            ))}
                        </ul>
                    </div>
                )}
            </PreviewSection>

            {/* === Categories & Entry Fees === */}
            <PreviewSection title="Categories & Entry Fees" description="Competition categories with their respective entry fees and deadlines.">
                {categories.length > 0 ? (
                    <div className="overflow-x-auto rounded-lg border border-gray-200 bg-white shadow-sm">
                        <table className="min-w-full divide-y divide-gray-200 rounded-lg">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Category</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Deadline</th>
                                    <th className="px-6 py-3 text-right text-xs font-medium tracking-wider text-gray-500 uppercase">Standard Fee</th>
                                    <th className="px-6 py-3 text-right text-xs font-medium tracking-wider text-gray-500 uppercase">Student Fee</th>
                                    <th className="px-6 py-3 text-right text-xs font-medium tracking-wider text-gray-500 uppercase">Gold Fee</th>
                                </tr>
                            </thead>
                            <tbody className="bg-white">
                                {categories.map((category: Record<string, unknown>) => {
                                    const deadlines =
                                        (category.category_deadlines as Array<Record<string, unknown>>)?.sort(
                                            (a, b) => new Date(a.deadline_date as string).getTime() - new Date(b.deadline_date as string).getTime(),
                                        ) || [];

                                    const next = deadlines.find((d) => new Date(d.deadline_date as string).getTime() > now.getTime()) || deadlines[0];

                                    const isExpanded = !!expanded[category.id as number];
                                    const rows = isExpanded ? deadlines : next ? [next] : [];

                                    return rows.map((d, idx: number) => {
                                        const dateString = formatDate(d.deadline_date as string);
                                        const dateObj = new Date(d.deadline_date as string);
                                        const isPast = dateObj < now;
                                        const isNext = d.id === next?.id;
                                        const textClass = isPast ? 'text-gray-400' : isNext ? 'text-green-600' : 'text-gray-900';

                                        const isCatHover = hoveredCategoryId === category.id;
                                        const isRowHover = hoveredRowId === d.id;

                                        return (
                                            <tr key={`${category.id}-${d.id}`} className="border-b border-gray-200">
                                                {idx === 0 && (
                                                    <td
                                                        rowSpan={rows.length}
                                                        onMouseEnter={() => setHoveredCategoryId(category.id as number)}
                                                        onMouseLeave={() => setHoveredCategoryId(null)}
                                                        className={`px-6 py-4 align-middle text-sm font-medium whitespace-nowrap text-gray-900 ${
                                                            isCatHover ? 'bg-gray-100' : ''
                                                        }`}
                                                    >
                                                        <button
                                                            type="button" // ✅ prevents submit
                                                            onClick={() => toggle(category.id as number)}
                                                            className="inline-flex cursor-pointer items-center hover:text-blue-600 focus:outline-none"
                                                        >
                                                            {isExpanded ? <ChevronDown size={16} /> : <ChevronRight size={16} />}
                                                            <span className="ml-2">{category.name as string}</span>
                                                        </button>
                                                    </td>
                                                )}

                                                <td
                                                    onMouseEnter={() => setHoveredRowId(d.id as number)}
                                                    onMouseLeave={() => setHoveredRowId(null)}
                                                    className={`px-6 py-4 whitespace-nowrap ${textClass} ${
                                                        isRowHover || isCatHover ? 'bg-gray-100' : ''
                                                    }`}
                                                >
                                                    <div className="text-sm font-medium">{d.deadline_title as string}</div>
                                                    <div className="text-xs text-gray-500">{dateString}</div>
                                                </td>
                                                <td
                                                    className={`px-6 py-4 text-right whitespace-nowrap ${textClass} ${
                                                        isRowHover || isCatHover ? 'bg-gray-100' : ''
                                                    }`}
                                                >
                                                    {(d.standard_fee as string) ?? '—'}
                                                </td>
                                                <td
                                                    className={`px-6 py-4 text-right whitespace-nowrap ${textClass} ${
                                                        isRowHover || isCatHover ? 'bg-gray-100' : ''
                                                    }`}
                                                >
                                                    {(d.student_fee as string) ?? '—'}
                                                </td>
                                                <td
                                                    className={`px-6 py-4 text-right whitespace-nowrap ${textClass} ${
                                                        isRowHover || isCatHover ? 'bg-gray-100' : ''
                                                    }`}
                                                >
                                                    {(d.gold_fee as string) ?? '—'}
                                                </td>
                                            </tr>
                                        );
                                    });
                                })}
                            </tbody>
                        </table>
                    </div>
                ) : (
                    <p className="text-sm text-gray-600">No categories defined.</p>
                )}
            </PreviewSection>
        </>
    );
}
