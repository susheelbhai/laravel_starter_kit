import type { MultiValue } from 'react-select';
import Select from 'react-select';
import InputError from '@/components/input-error';
import { Label } from '@/components/ui/label';
import type { InputDivProps } from '../container/input-types';
import { InputWrapper } from '../container/input-wrapper';

export default function InputMultiSelect({
    label,
    name,
    inputDivData,
    options,
    required,
    className,
}: InputDivProps) {
    const { data, setData, errors } = inputDivData;

    const raw = data?.[name];
    const currentIds: string[] = Array.isArray(raw)
        ? raw.map(String)
        : raw
          ? [String(raw)]
          : [];

    const formattedOptions =
        (options ?? []).map((o: any) => ({
            value: String(o.id),
            label: String(o.title),
        })) ?? [];

    const selectedOptions = formattedOptions.filter((opt) =>
        currentIds.includes(opt.value),
    );

    return (
        <InputWrapper className={className}>
            <Label htmlFor={name}>
                {label}
                {required && (
                    <span className="text-xl font-bold text-red-500">*</span>
                )}
            </Label>

            <Select
                inputId={name}
                isMulti
                options={formattedOptions}
                value={selectedOptions}
                onChange={(
                    selected: MultiValue<{ value: string; label: string }>,
                ) => {
                    const ids = selected.map((s) => s.value);

                    setData(name, ids);
                }}
                placeholder="Select…"
                className="react-select-container rounded-md border-2 border-[var(--input-border)]"
                classNamePrefix="react-select"
                menuPortalTarget={document.body}
                styles={{
                    menuPortal: (base) => ({ ...base, zIndex: 9999 }),
                    menu: (base) => ({ ...base, backgroundColor: 'var(--input-bg)', border: '1px solid var(--input-border)', borderRadius: '6px' }),
                    option: (base, state) => ({
                        ...base,
                        backgroundColor:
                            state.isFocused || state.isSelected
                                ? 'var(--accent)'
                                : 'var(--input-bg)',
                        color:
                            state.isFocused || state.isSelected
                                ? 'var(--accent-foreground)'
                                : 'var(--input-text)',
                    }),
                    control: (base, state) => ({
                        ...base,
                        backgroundColor: state.isFocused ? 'var(--input-focused-bg)' : 'var(--input-bg)',
                        borderColor: state.isFocused ? 'var(--secondary)' : 'var(--input-border)',
                        '&:hover': {
                            borderColor: 'var(--secondary)',
                        },
                        color: state.isFocused ? 'var(--input-focused-text)' : 'var(--input-text)',
                    }),
                }}
            />

            <InputError message={errors[name]?.[0]} />
        </InputWrapper>
    );
}
