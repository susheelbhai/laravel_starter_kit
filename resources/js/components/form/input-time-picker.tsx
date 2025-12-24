import '../../../css/picker.css';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from '@/components/ui/popover';
import { cn } from '@/lib/utils';
import { ChevronDown, Clock } from 'lucide-react';
import React, { useEffect, useMemo, useRef, useState } from 'react';
import HelpTooltip from './input-help-tool';
import { InputDivProps } from './input-types';
import { InputWrapper } from './input-wrapper';

interface TimePickerProps extends InputDivProps {
    timeFormat?: '12' | '24'; // 12-hour or 24-hour format
}

interface CustomTimeDropdownProps {
    value: number;
    onChange: (value: number) => void;
    options: { value: number; label: string }[];
    isOpen: boolean;
    setIsOpen: (open: boolean) => void;
}

function CustomTimeDropdown({
    value,
    onChange,
    options,
    isOpen,
    setIsOpen,
}: CustomTimeDropdownProps) {
    const containerRef = useRef<HTMLDivElement>(null);
    const selectedRef = useRef<HTMLButtonElement>(null);
    const dropdownRef = useRef<HTMLDivElement>(null);
    const isScrollingRef = useRef(false);

    // Only loop for hour/minute, not AM/PM
    const isPeriodDropdown = options.length === 2 && options[0].label === 'AM' && options[1].label === 'PM';
    const infiniteOptions = isPeriodDropdown ? options : useMemo(() => {
        return [...options, ...options, ...options];
    }, [options]);

    useEffect(() => {
        const handleClickOutside = (event: MouseEvent) => {
            if (
                containerRef.current &&
                !containerRef.current.contains(event.target as Node)
            ) {
                setIsOpen(false);
            }
        };
        if (isOpen) {
            document.addEventListener('mousedown', handleClickOutside);
            // Scroll to center set (second copy of options) with selected item
            setTimeout(() => {
                if (selectedRef.current && dropdownRef.current) {
                    const container = dropdownRef.current;
                    const selected = selectedRef.current;
                    container.scrollTop =
                        selected.offsetTop -
                        container.clientHeight / 2 +
                        selected.clientHeight / 2;
                }
            }, 10);
        }
        return () => document.removeEventListener('mousedown', handleClickOutside);
    }, [isOpen, setIsOpen]);

    // Handle infinite scroll
    useEffect(() => {
        if (!isOpen || !dropdownRef.current) return;

        const container = dropdownRef.current;
        const singleSetHeight = container.scrollHeight / 3;

        const handleScroll = () => {
            if (isScrollingRef.current) return;

            const scrollTop = container.scrollTop;

            // If scrolled to top, jump to middle set
            if (scrollTop < singleSetHeight * 0.1) {
                isScrollingRef.current = true;
                container.scrollTop = scrollTop + singleSetHeight;
                setTimeout(() => {
                    isScrollingRef.current = false;
                }, 50);
            }
            // If scrolled to bottom, jump to middle set
            else if (
                scrollTop >
                singleSetHeight * 2 -
                    container.clientHeight +
                    singleSetHeight * 0.1
            ) {
                isScrollingRef.current = true;
                container.scrollTop = scrollTop - singleSetHeight;
                setTimeout(() => {
                    isScrollingRef.current = false;
                }, 50);
            }
        };

        container.addEventListener('scroll', handleScroll);
        return () => container.removeEventListener('scroll', handleScroll);
    }, [isOpen]);

    const selectedOption = options.find((opt) => opt.value === value);

    return (
        <div className="relative inline-block" ref={containerRef}>
            <button
                type="button"
                onClick={() => setIsOpen(!isOpen)}
                className="flex items-center gap-1 text-sm font-medium hover:text-primary transition-colors bg-transparent border-none outline-none p-0 min-w-[40px] justify-center"
            >
                {selectedOption?.label || value}
                <ChevronDown className="h-3 w-3" />
            </button>
            {isOpen && (
                <div className="absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 bg-background border border-border shadow-lg rounded-md max-h-[200px] z-50 min-w-[80px] py-3 overflow-hidden">
                    <div
                        ref={dropdownRef}
                        className="max-h-[176px] overflow-y-auto scrollbar-hide"
                        style={{
                            scrollbarWidth: 'none',
                            msOverflowStyle: 'none',
                        }}
                    >
                        {infiniteOptions.map((option, index) => {
                            let isSelected;
                            if (isPeriodDropdown) {
                                isSelected = option.value === value;
                            } else {
                                const isMiddleSet = index >= options.length && index < options.length * 2;
                                isSelected = option.value === value && isMiddleSet;
                            }
                            return (
                                <button
                                    key={`${option.value}-${index}`}
                                    ref={isSelected ? selectedRef : null}
                                    type="button"
                                    onClick={() => {
                                        onChange(option.value);
                                        setIsOpen(false);
                                    }}
                                    className={cn(
                                        'w-full text-center px-3 py-1.5 text-sm transition-colors border-none outline-none cursor-pointer time-dropdown-item',
                                        isSelected &&
                                            'bg-primary text-primary-foreground selected-item',
                                    )}
                                >
                                    {option.label}
                                </button>
                            );
                        })}
                    </div>
                </div>
            )}
        </div>
    );
}

export default function InputTimePicker({
    label,
    name,
    help,
    inputDivData,
    readOnly,
    className,
    placeholder = 'Select time',
    timeFormat = '24',
}: TimePickerProps) {
    const { data, setData, errors } = inputDivData;
    const [isOpen, setIsOpen] = useState(false);
    const [lastValue, setLastValue] = useState('');
    const [hourDropdownOpen, setHourDropdownOpen] = useState(false);
    const [minuteDropdownOpen, setMinuteDropdownOpen] = useState(false);
    const [periodDropdownOpen, setPeriodDropdownOpen] = useState(false);

    // Parse time from string (HH:MM or HH:MM:SS format)
    const parseTime = (
        timeString: string | null | undefined,
    ): { hour: number; minute: number; period?: 'AM' | 'PM' } | null => {
        if (!timeString) return null;
        const parts = timeString.split(':');
        if (parts.length < 2) return null;

        let hour = parseInt(parts[0]);
        const minute = parseInt(parts[1]);

        if (isNaN(hour) || isNaN(minute)) return null;
        if (hour < 0 || hour > 23 || minute < 0 || minute > 59) return null;

        if (timeFormat === '12') {
            const period: 'AM' | 'PM' = hour >= 12 ? 'PM' : 'AM';
            hour = hour % 12 || 12; // Convert 0 to 12 for 12-hour format
            return { hour, minute, period };
        }

        return { hour, minute };
    };

    // Format time for display and storage
    const formatTime = (
        hour: number,
        minute: number,
        period?: 'AM' | 'PM',
    ): string => {
        if (timeFormat === '12' && period) {
            // Convert to 24-hour for storage
            let hour24 = hour;
            if (period === 'PM' && hour !== 12) hour24 += 12;
            if (period === 'AM' && hour === 12) hour24 = 0;
            return `${hour24.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
        }
        return `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
    };

    const currentTime = parseTime(data[name] as string);

    // Generate hour options
    const hourOptions = useMemo(() => {
        const max = timeFormat === '12' ? 12 : 23;
        const start = timeFormat === '12' ? 1 : 0;
        return Array.from({ length: max - start + 1 }, (_, i) => {
            const value = start + i;
            return {
                value,
                label: value.toString().padStart(2, '0'),
            };
        });
    }, [timeFormat]);

    // Generate minute options (0-59)
    const minuteOptions = useMemo(() => {
        return Array.from({ length: 60 }, (_, i) => ({
            value: i,
            label: i.toString().padStart(2, '0'),
        }));
    }, []);

    // Period options (AM/PM)
    const periodOptions = [
        { value: 0, label: 'AM' },
        { value: 1, label: 'PM' },
    ];

    // Handle time selection
    const handleTimeChange = (
        newHour?: number,
        newMinute?: number,
        newPeriod?: 'AM' | 'PM',
    ) => {
        const hour = newHour ?? currentTime?.hour ?? 0;
        const minute = newMinute ?? currentTime?.minute ?? 0;
        const period =
            newPeriod ?? currentTime?.period ?? (timeFormat === '12' ? 'AM' : undefined);

        const formatted = formatTime(hour, minute, period);
        setData(name, formatted);
        setLastValue(formatted);
    };

    // Handle manual input with validation
    const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        let value = e.target.value;
        const isDeleting = value.length < lastValue.length;

        // Remove any non-digit characters except colons
        value = value.replace(/[^\d:]/g, '');

        // Don't auto-format if user is deleting
        if (!isDeleting) {
            // Auto-format as HH:MM
            if (value.length >= 2 && value[2] !== ':') {
                value = value.slice(0, 2) + ':' + value.slice(2);
            }
        }

        // Limit to HH:MM format (5 characters)
        value = value.slice(0, 5);

        // Validate hour as user types
        if (value.length >= 2) {
            const hour = parseInt(value.substring(0, 2));
            const maxHour = timeFormat === '12' ? 12 : 23;
            if (hour > maxHour) {
                return; // Don't update if hour is invalid
            }
            if (value.length === 1 && parseInt(value[0]) > 2) {
                // If first digit is > 2, max is 23, so invalid for 24-hour
                if (timeFormat === '24') return;
            }
            if (value.length === 1 && parseInt(value[0]) > 1 && timeFormat === '12') {
                // For 12-hour, first digit > 1 means max is 19, but 13-19 are invalid
                return;
            }
        }

        // Validate minute as user types
        if (value.length >= 4) {
            const minute = parseInt(value.substring(3, 5));
            if (minute > 59) {
                return; // Don't update if minute > 59
            }
            if (value.length === 4 && parseInt(value[3]) > 5) {
                return; // First digit of minute must be 0-5
            }
        }

        setData(name, value);
        setLastValue(value);

        // If complete time, validate and format
        if (value.length === 5) {
            const parsed = parseTime(value);
            if (parsed) {
                const formatted = formatTime(
                    parsed.hour,
                    parsed.minute,
                    parsed.period,
                );
                setData(name, formatted);
                setLastValue(formatted);
            }
        }
    };

    // Display time in the input
    const displayTime = () => {
        if (!currentTime) return '';
        if (timeFormat === '12') {
            return `${currentTime.hour.toString().padStart(2, '0')}:${currentTime.minute.toString().padStart(2, '0')} ${currentTime.period}`;
        }
        return `${currentTime.hour.toString().padStart(2, '0')}:${currentTime.minute.toString().padStart(2, '0')}`;
    };

    return (
        <InputWrapper>
            {label && (
                <Label htmlFor={name}>
                    {label}
                    {help && <HelpTooltip help={help} />}
                </Label>
            )}
            <Popover open={isOpen} onOpenChange={setIsOpen}>
                <PopoverTrigger asChild>
                    <Button
                        type="button"
                        variant={'outline'}
                        className={cn(
                            'w-full justify-start text-left font-normal',
                            !data[name] && 'text-muted-foreground',
                            className,
                        )}
                        disabled={readOnly}
                    >
                        <Clock className="mr-2 h-4 w-4" />
                        {data[name] ? displayTime() : placeholder}
                    </Button>
                </PopoverTrigger>
                <PopoverContent className="w-auto p-4" align="start">
                    <div className="flex items-center justify-center gap-2">
                        <CustomTimeDropdown
                            value={currentTime?.hour ?? (timeFormat === '12' ? 12 : 0)}
                            onChange={(hour) =>
                                handleTimeChange(hour, undefined, undefined)
                            }
                            options={hourOptions}
                            isOpen={hourDropdownOpen}
                            setIsOpen={setHourDropdownOpen}
                        />
                        <span className="text-2xl font-bold">:</span>
                        <CustomTimeDropdown
                            value={currentTime?.minute ?? 0}
                            onChange={(minute) =>
                                handleTimeChange(undefined, minute, undefined)
                            }
                            options={minuteOptions}
                            isOpen={minuteDropdownOpen}
                            setIsOpen={setMinuteDropdownOpen}
                        />
                        {timeFormat === '12' && (
                            <CustomTimeDropdown
                                value={currentTime?.period === 'PM' ? 1 : 0}
                                onChange={(value) =>
                                    handleTimeChange(
                                        undefined,
                                        undefined,
                                        value === 1 ? 'PM' : 'AM',
                                    )
                                }
                                options={periodOptions}
                                isOpen={periodDropdownOpen}
                                setIsOpen={setPeriodDropdownOpen}
                            />
                        )}
                    </div>
                    <div className="mt-3">
                        <Input
                            type="text"
                            placeholder={timeFormat === '12' ? 'HH:MM' : 'HH:MM'}
                            value={data[name] || ''}
                            onChange={handleInputChange}
                            className="text-center"
                        />
                    </div>
                </PopoverContent>
            </Popover>
            <InputError message={errors[name]?.[0]} />
        </InputWrapper>
    );
}
