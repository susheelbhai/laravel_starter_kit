import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from '@/components/ui/popover';
import { format } from 'date-fns';
import { Calendar as CalendarIcon } from 'lucide-react';
import React, { useState } from 'react';
import Calendar from './calendar';
import HelpTooltip from './input-help-tool';
import { InputDivProps } from './input-types';
import { InputWrapper } from './input-wrapper';

export default function InputDatePicker({
    label,
    name,
    type,
    help,
    inputDivData,
    readOnly,
    className,
    placeholder,
}: InputDivProps) {
    const { data, setData, errors } = inputDivData;
    const [isOpen, setIsOpen] = useState(false);
    const [lastValue, setLastValue] = useState('');

    // Parse date from string (YYYY-MM-DD format from Laravel)
    const parseDate = (
        dateString: string | null | undefined,
    ): Date | undefined => {
        if (!dateString) return undefined;
        const date = new Date(dateString);
        return isNaN(date.getTime()) ? undefined : date;
    };

    // Format date to YYYY-MM-DD for Laravel
    const formatForLaravel = (date: Date | undefined): string => {
        if (!date) return '';
        return format(date, 'yyyy-MM-dd');
    };

    // Handle date selection
    const handleDateSelect = (date: Date | undefined) => {
        const formatted = formatForLaravel(date);
        setData(name, formatted);
        setLastValue(formatted);
        setIsOpen(false);
    };

    // Handle manual input with validation
    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        let value = e.target.value;
        const isDeleting = value.length < lastValue.length;

        // Remove any non-digit characters except hyphens
        value = value.replace(/[^\d-]/g, '');

        // Don't auto-format if user is deleting
        if (!isDeleting) {
            // Auto-format as YYYY-MM-DD
            if (value.length >= 4 && value[4] !== '-') {
                value = value.slice(0, 4) + '-' + value.slice(4);
            }
            if (value.length >= 7 && value[7] !== '-') {
                value = value.slice(0, 7) + '-' + value.slice(7);
            }
        }

        // Limit to YYYY-MM-DD format (10 characters)
        value = value.slice(0, 10);

        // Validate month as user types (when entering 5th or 6th character)
        if (value.length >= 6) {
            const month = parseInt(value.substring(5, 7));
            if (month > 12) {
                return; // Don't update if month > 12
            }
            if (value.length === 6 && value[5] > '1') {
                // If first digit of month is > 1, month will be > 12
                return;
            }
        }

        // Validate day as user types (when entering 8th or 9th character)
        if (value.length >= 9) {
            const month = parseInt(value.substring(5, 7));
            const day = parseInt(value.substring(8, 10));

            if (month >= 1 && month <= 12) {
                const year = parseInt(value.substring(0, 4)) || 2000;
                const daysInMonth = new Date(year, month, 0).getDate();

                if (day > daysInMonth) {
                    return; // Don't update if day exceeds days in month
                }

                // Check first digit of day
                if (value.length === 9) {
                    const firstDayDigit = parseInt(value[8]);
                    if (firstDayDigit > 3) {
                        return; // First digit of day can't be > 3
                    }
                    if (firstDayDigit === 3 && daysInMonth < 30) {
                        return; // If first digit is 3, month must have at least 30 days
                    }
                }
            }
        }

        // Final validation if complete date
        if (value.length === 10) {
            const [year, month, day] = value.split('-').map(Number);

            if (!year || !month || !day) {
                return;
            }

            if (month < 1 || month > 12) {
                return;
            }

            const daysInMonth = new Date(year, month, 0).getDate();
            if (day < 1 || day > daysInMonth) {
                return;
            }

            const testDate = new Date(year, month - 1, day);
            if (
                testDate.getFullYear() !== year ||
                testDate.getMonth() !== month - 1 ||
                testDate.getDate() !== day
            ) {
                return;
            }
        }

        setLastValue(value);
        setData(name, value);
    };

    // Handle keydown for better UX
    const handleKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
        // Allow: backspace, delete, tab, escape, enter, arrows
        if ([8, 9, 27, 13, 46, 37, 39].includes(e.keyCode)) {
            return;
        }

        // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
        if ((e.ctrlKey || e.metaKey) && [65, 67, 86, 88].includes(e.keyCode)) {
            return;
        }

        // Ensure it's a number or hyphen
        if (!/[\d-]/.test(e.key)) {
            e.preventDefault();
        }
    };

    const selectedDate = parseDate(data?.[name]);

    return (
        <InputWrapper className={className}>
            <div className="relative w-full">
                <Label htmlFor={name}>{label}</Label>
                {help && <HelpTooltip help={help} />}

                <div className="relative">
                    <Input
                        id={name}
                        type="text"
                        value={data?.[name] ?? ''}
                        onChange={handleInputChange}
                        onKeyDown={handleKeyDown}
                        placeholder={placeholder || 'YYYY-MM-DD'}
                        readOnly={readOnly}
                        className="pr-10"
                        maxLength={10}
                    />

                    <Popover open={isOpen} onOpenChange={setIsOpen}>
                        <PopoverTrigger asChild>
                            <Button
                                type="button"
                                variant="ghost"
                                size="icon"
                                disabled={readOnly}
                                className="absolute top-0 right-0 h-full px-3 hover:bg-transparent"
                            >
                                <CalendarIcon className="h-4 w-4 text-muted-foreground" />
                            </Button>
                        </PopoverTrigger>
                        <PopoverContent className="w-auto p-0" align="end">
                            <Calendar
                                mode="single"
                                selected={selectedDate}
                                onSelect={handleDateSelect}
                                initialFocus
                            />
                        </PopoverContent>
                    </Popover>
                </div>

                <InputError message={errors[name]?.[0]} />
            </div>
        </InputWrapper>
    );
}
