import { ChevronDown, ChevronLeft, ChevronRight } from 'lucide-react';
import * as React from 'react';
import { DayPicker } from 'react-day-picker';
import 'react-day-picker/style.css';


import '../../../../css/picker.css';
import { cn } from '@/lib/utils';

export type CalendarProps = React.ComponentProps<typeof DayPicker>;

interface DropdownOption {
    value: number;
    label: string;
    disabled: boolean;
}

interface CustomDropdownProps {
    value?: string | number | readonly string[];
    onChange?: (e: React.ChangeEvent<HTMLSelectElement>) => void;
    options?: DropdownOption[];
    components?: Record<string, unknown>;
    classNames?: Record<string, string>;
}

function CustomDropdown({
    value,
    onChange,
    options = [],
}: CustomDropdownProps) {
    const [isOpen, setIsOpen] = React.useState(false);
    const containerRef = React.useRef<HTMLDivElement>(null);
    const selectedRef = React.useRef<HTMLButtonElement>(null);
    const dropdownRef = React.useRef<HTMLDivElement>(null);
    const isScrollingRef = React.useRef(false);

    // Create infinite loop by tripling the options
    const infiniteOptions = React.useMemo(() => {
        return [...options, ...options, ...options];
    }, [options]);

    React.useEffect(() => {
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
        return () =>
            document.removeEventListener('mousedown', handleClickOutside);
    }, [isOpen]);

    // Handle infinite scroll
    React.useEffect(() => {
        if (!isOpen || !dropdownRef.current) return;

        const container = dropdownRef.current;
        const singleSetHeight = container.scrollHeight / 3;

        const handleScroll = () => {
            if (isScrollingRef.current) return;

            const scrollTop = container.scrollTop;
            const clientHeight = container.clientHeight;

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
                singleSetHeight * 2 - clientHeight + singleSetHeight * 0.1
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

    const numericValue = typeof value === 'number' ? value : Number(value);
    const selectedOption = options.find((opt) => opt.value === numericValue);

    return (
        <div className="relative inline-block" ref={containerRef}>
            <button
                type="button"
                onClick={() => setIsOpen(!isOpen)}
                className="flex items-center gap-1 border-none bg-transparent p-0 text-sm font-medium transition-colors outline-none hover:text-primary"
            >
                {selectedOption?.label || value}
                <ChevronDown className="h-3 w-3" />
            </button>
            {isOpen && (
                <div className="absolute top-1/2 left-1/2 z-50 max-h-[200px] min-w-[100px] -translate-x-1/2 -translate-y-1/2 overflow-hidden rounded-md border border-border bg-background py-3 shadow-lg">
                    <div
                        ref={dropdownRef}
                        className="scrollbar-hide max-h-[176px] overflow-y-auto"
                        style={{
                            scrollbarWidth: 'none',
                            msOverflowStyle: 'none',
                        }}
                    >
                        {infiniteOptions.map((option, index) => {
                            const isMiddleSet =
                                index >= options.length &&
                                index < options.length * 2;
                            const isSelected =
                                option.value === numericValue && isMiddleSet;
                            return (
                                <button
                                    key={`${option.value}-${index}`}
                                    ref={isSelected ? selectedRef : null}
                                    type="button"
                                    disabled={option.disabled}
                                    onClick={() => {
                                        if (!option.disabled) {
                                            const event = {
                                                target: {
                                                    value: String(option.value),
                                                },
                                            } as React.ChangeEvent<HTMLSelectElement>;
                                            onChange?.(event);
                                            setIsOpen(false);
                                        }
                                    }}
                                    className={cn(
                                        'w-full border-none px-3 py-1.5 text-center text-sm transition-colors outline-none',
                                        option.disabled
                                            ? 'cursor-not-allowed opacity-50'
                                            : 'dropdown-item-hover cursor-pointer',
                                        isSelected &&
                                            'selected-item bg-primary text-primary-foreground',
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

function Calendar({
    className,
    classNames,
    showOutsideDays = true,
    ...props
}: CalendarProps) {
    return (
        <DayPicker
            showOutsideDays={showOutsideDays}
            className={cn(className)}
            classNames={{
                day_today: 'bg-accent text-accent-foreground',
                ...classNames,
            }}
            captionLayout="dropdown"
            fromYear={0}
            toYear={3000}
            components={{
                Chevron: ({ orientation }) => {
                    const Icon =
                        orientation === 'left' ? ChevronLeft : ChevronRight;
                    return <Icon className="h-4 w-4" />;
                },
                Dropdown: CustomDropdown,
            }}
            {...props}
        />
    );
}

Calendar.displayName = 'Calendar';
export default Calendar;
