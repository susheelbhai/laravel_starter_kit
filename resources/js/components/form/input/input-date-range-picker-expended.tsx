
import React, { useState } from 'react';
import { cn } from '@/lib/utils';
import type { InputDivProps } from '../container/input-types';
import { InputWrapper } from '../container/input-wrapper';
import Calendar from '../package/calendar';

interface InputDateTimePickerExpendedProps extends InputDivProps {
    label?: string;
    help?: string;
    readOnly?: boolean;
    className?: string;
    placeholder?: string;
}

export default function InputDateTimePickerExpended({
    label,
    name = '',
    help,
    inputDivData,
    readOnly,
    className,
    placeholder = 'Select date range',
}: InputDateTimePickerExpendedProps) {
    const { data, setData, errors } = inputDivData || { data: {}, setData: () => {}, errors: {} };
    // Store as two fields: name + '_from', name + '_to'
    const from = data[name + '_from'] || undefined;
    const to = data[name + '_to'] || undefined;
    type DateRange = { from: Date | undefined; to: Date | undefined };
    const [range, setRange] = useState<DateRange>({
        from: from ? new Date(from) : undefined,
        to: to ? new Date(to) : undefined,
    });


    function formatLocalDate(date?: Date) {
        if (!date) return '';
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    const handleSelect = (selected: { from?: Date; to?: Date } | undefined) => {
        const safeRange: DateRange = {
            from: selected?.from ?? undefined,
            to: selected?.to ?? undefined,
        };
        setRange(safeRange);
        setData(name + '_from', safeRange.from ? formatLocalDate(safeRange.from) : '');
        setData(name + '_to', safeRange.to ? formatLocalDate(safeRange.to) : '');
    };

    return (
        <InputWrapper>
            {label && (
                <div className="flex items-center gap-2 mb-1">
                    <span>{label}</span>
                    {help && <span className="text-muted-foreground text-xs">{help}</span>}
                </div>
            )}
            <Calendar
                mode="range"
                selected={range}
                onSelect={handleSelect}
                className={className}
            />
        </InputWrapper>
    );
}
