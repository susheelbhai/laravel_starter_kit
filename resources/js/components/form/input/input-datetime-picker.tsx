
import React from 'react';
import type { InputDivProps } from '../container/input-types';
import { InputWrapper } from '../container/input-wrapper';
import InputDatePicker from './input-date-picker';
import InputTimePicker from './input-time-picker';

interface InputDateTimePickerProps extends InputDivProps {
    label?: string;
    help?: string;
    readOnly?: boolean;
    className?: string;
    placeholder?: string;
    timeFormat?: '12' | '24';
}

function splitDateTime(value?: string) {
    if (!value) return { date: '', time: '' };
    const [date, time] = value.split('T');
    return { date: date || '', time: time || '' };
}

function combineDateTime(date: string, time: string) {
    if (!date && !time) return '';
    if (!date) return '';
    if (!time) return date;
    return `${date}T${time}`;
}

export default function InputDateTimePicker({
    label,
    name,
    help,
    inputDivData,
    readOnly,
    className,
    placeholder = 'Select date & time',
    timeFormat = '24',
}: InputDateTimePickerProps) {
    const { data, setData, errors } = inputDivData;
    const value = data[name] as string | undefined;
    const { date, time } = splitDateTime(value);

    const handleDateChange = (dateValue: string) => {
        setData(name, combineDateTime(dateValue, time));
    };
    const handleTimeChange = (timeValue: string) => {
        setData(name, combineDateTime(date, timeValue));
    };

    return (
        <InputWrapper>
            {label && (
                <div className="flex items-center gap-2 mb-1">
                    <span>{label}</span>
                    {help && <span className="text-muted-foreground text-xs">{help}</span>}
                </div>
            )}
            <div className="flex gap-2">
                <InputDatePicker
                    label={undefined}
                    name={name + '_date'}
                    inputDivData={{
                        ...inputDivData,
                        data: { ...data, [name + '_date']: date },
                        setData: (_key: string, v: string) => handleDateChange(v),
                    }}
                    readOnly={readOnly}
                    className={className}
                    placeholder={placeholder.split(' ')[0] || 'Select date'}
                    type="date"
                />
                <InputTimePicker
                    label={undefined}
                    name={name + '_time'}
                    inputDivData={{
                        ...inputDivData,
                        data: { ...data, [name + '_time']: time },
                        setData: (_key: string, v: string) => handleTimeChange(v),
                    }}
                    readOnly={readOnly}
                    className={className}
                    placeholder={placeholder.split(' ')[1] || 'Select time'}
                    timeFormat={timeFormat}
                    type="time"
                />
            </div>
        </InputWrapper>
    );
}
