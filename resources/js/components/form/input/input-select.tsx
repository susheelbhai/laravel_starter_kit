import InputError from '@/components/input-error';
import { Label } from '@/components/ui/label';
import { cn } from '@/lib/utils';
import HelpTooltip from './input-help-tool';
import { InputDivProps } from '../container/input-types';
import { InputWrapper } from '../container/input-wrapper';

export default function InputSelect({
    label,
    name,
    options,
    inputDivData,
    required,
    help,
    className,
    children,
}: InputDivProps) {
    const { data, setData, errors } = inputDivData;

    const getOptionValue = (item: any) => item?.id ?? item?.value ?? item;
    const getOptionLabel = (item: any) =>
        item?.title ?? item?.name ?? String(getOptionValue(item));

    return (
        <InputWrapper className={className}>
            <Label htmlFor={name}>
                {label}
                {required && (
                    <span className="text-xl font-bold text-red-500">*</span>
                )}
            </Label>
            {help && <HelpTooltip help={help} />}

            <select
                id={name}
                value={data?.[name] ?? ''}
                onChange={(e) => setData(name, e.target.value)}
                required={required}
                className={cn(
                    'flex h-10 w-full rounded-md border-2 border-primary bg-white px-3 py-2 text-sm text-gray-900',
                    'focus:border-secondary/60 focus:outline-none',
                    'disabled:cursor-not-allowed disabled:opacity-50',
                    className,
                )}
            >
                <option value="">Select an option</option>
                {options?.map((item: any) => {
                    const value = getOptionValue(item);
                    const label = getOptionLabel(item);
                    return (
                        <option key={String(value)} value={String(value)}>
                            {label}
                        </option>
                    );
                })}
                {children}
            </select>

            <InputError message={errors[name]?.[0]} />
        </InputWrapper>
    );
}
