import { format } from 'date-fns';
import { Calendar as CalendarIcon } from 'lucide-react';
import React, { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import type { InputDivProps } from '../container/input-types';
import { InputWrapper } from '../container/input-wrapper';
import Calendar from '../package/calendar';

function formatLocalDate(date?: Date) {
    if (!date) return '';
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

export default function InputDateRangePicker({
    label,
    name,
    help,
    inputDivData,
    readOnly,
    className,
    placeholder = 'Select date range',
}: InputDivProps) {
    const { data, setData, errors } = inputDivData;
    const from = data[name + '_from'] || '';
    const to = data[name + '_to'] || '';
    type DateRange = { from: Date | undefined; to: Date | undefined };
    const [range, setRange] = useState<DateRange>({
        from: from ? new Date(from) : undefined,
        to: to ? new Date(to) : undefined,
    });
    const [isOpen, setIsOpen] = useState(false);

    const handleSelect = (selected: { from?: Date; to?: Date } | undefined) => {
        const safeRange: DateRange = {
            from: selected?.from ?? undefined,
            to: selected?.to ?? undefined,
        };
        setRange(safeRange);
        setData(name + '_from', safeRange.from ? formatLocalDate(safeRange.from) : '');
        setData(name + '_to', safeRange.to ? formatLocalDate(safeRange.to) : '');
        // Only close if both from and to are selected and they are not the same day
        if (safeRange.from && safeRange.to && safeRange.from.getTime() !== safeRange.to.getTime()) {
            setIsOpen(false);
        }
    };

    let displayValue = placeholder;
    if (range.from && range.to) {
        displayValue = `${format(range.from, 'yyyy-MM-dd')} to ${format(range.to, 'yyyy-MM-dd')}`;
    } else if (range.from) {
        displayValue = format(range.from, 'yyyy-MM-dd');
    }

    return (
        <InputWrapper>
            {label && (
                <label className="mb-1 block font-medium">
                    {label}
                    {help && <span className="ml-2 text-xs text-muted-foreground">{help}</span>}
                </label>
            )}
            <Popover open={isOpen} onOpenChange={setIsOpen}>
                <PopoverTrigger asChild>
                    <Button
                        type="button"
                        variant="outline"
                        className={className + ' w-full justify-start text-left font-normal bg-input-bg border-input-border text-input-text hover:bg-input-hover-bg'}
                        disabled={readOnly}
                    >
                        <CalendarIcon className="mr-2 h-4 w-4" />
                        {displayValue}
                    </Button>
                </PopoverTrigger>
                <PopoverContent className="w-auto p-0" align="start">
                    <Calendar
                        mode="range"
                        selected={range}
                        onSelect={handleSelect}
                        className="rounded-lg border bg-background p-2"
                        initialFocus
                    />
                </PopoverContent>
            </Popover>
        </InputWrapper>
    );
}
