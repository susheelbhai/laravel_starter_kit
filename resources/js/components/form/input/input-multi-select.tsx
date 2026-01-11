import InputError from '@/components/input-error';
import { Label } from '@/components/ui/label';
import Select, { MultiValue } from 'react-select';
import { InputDivProps } from '../container/input-types';
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
                className="react-select-container rounded-md border-2 border-primary"
                classNamePrefix="react-select"
                menuPortalTarget={document.body}
                styles={{
                    menuPortal: (base) => ({ ...base, zIndex: 9999 }),
                    menu: (base) => ({ ...base, backgroundColor: '#fff' }),
                    option: (base, state) => ({
                        ...base,
                        backgroundColor:
                            state.isFocused || state.isSelected
                                ? '#2563eb'
                                : '#fff',
                        color:
                            state.isFocused || state.isSelected
                                ? '#fff'
                                : '#111827',
                    }),
                    control: (base, state) => ({
                        ...base,
                        backgroundColor: '#fff',
                        borderColor: state.isFocused
                            ? '#2563eb'
                            : base.borderColor,
                    }),
                }}
            />

            <InputError message={errors[name]?.[0]} />
        </InputWrapper>
    );
}
