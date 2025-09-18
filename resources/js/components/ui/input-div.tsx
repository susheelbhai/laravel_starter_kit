import InputError from '@/components/input-error';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import CkEditor4Component from '../CkEditor4Component';
import ActiveToggle from './input-switch';
import ImageUploader from './input-image';
import FileUploader from './input-file';
import React, { InputHTMLAttributes } from 'react'
import Select, { MultiValue } from 'react-select';
import { useRef, useCallback, useEffect, useMemo } from 'react';
import HelpTooltip from './input-help-tool';

export interface InputDivProps
  extends InputHTMLAttributes<HTMLInputElement> {
  type: string;
  label: string;
  help?: string;
  inputDivData: {
    data: Record<string, any>;
    setData: (key: string, value: any) => void;
    errors: Record<string, string[]>;
  };
  name: string;
  children?: React.ReactNode;
  options?: any[];
  widthMultiplier?: number;
  heightMultiplier?: number;
  readOnly?: boolean;
  placeholder?: string;
  className?: string;
};

const InputWrapper = ({ children, className = '' }: { children: React.ReactNode; className?: string }) => {
  return <div className={`mb-4 space-y-1 ${className}`}>{children}</div>;
};

export function InputDiv({
  children,
  type = 'text',
  label,
  help,
  inputDivData,
  name,
  options,
  widthMultiplier,
  heightMultiplier,
  readOnly,
  required,
  ...props
}: InputDivProps) {
  const { data, setData, errors } = inputDivData;

   // Guarded setter: prevents no-op updates that can loop with chatty inputs
  const prevRef = useRef<any>(data?.[name]);
  useEffect(() => {
    prevRef.current = data?.[name];
  }, [data?.[name]]);

  const set = useCallback(
    (next: any) => {
      if (Object.is(prevRef.current, next)) return;
      prevRef.current = next;
      setData(name, next);
    },
    [name, setData]
  );

  // For children that expect (key, value)
  const setDataGuarded = useCallback(
    (key: string, value: any) => {
      if (key === name) set(value);
      else setData(key, value);
    },
    [name, set, setData]
  );

  // Helper to normalize option fields
  const getOptionValue = (item: any) => (item?.id ?? item?.value ?? item);
  const getOptionLabel = (item: any) => (item?.title ?? item?.name ?? String(getOptionValue(item)));

  switch (type) {
    case 'text':
    case 'email':
    case 'password':
    case 'tel':
    case 'number':
      return (
        <InputWrapper>
          <Label htmlFor={name}>
            {label}
            {required && <span className="text-red-500 font-bold text-xl">*</span>}
          </Label>
          {help &&  <HelpTooltip help={help} />}

          <Input
            id={name}
            type={type}
            value={data[name]}
            onChange={(e) => setData(name, e.target.value)}
            readOnly={readOnly}
            {...props}
          />
          <InputError message={errors[name]?.[0]} />
        </InputWrapper>
      );

    case 'hidden':
      return (
        <Input
          id={name}
          type={type}
          value={data[name]}
          onChange={(e) => setData(name, e.target.value)}
        />
      );

    case 'editor':
      return (
        <InputWrapper>
          <Label htmlFor={name}>{label} {required && <span className="text-red-500 font-bold text-xl">*</span>}</Label>
          {help &&  <HelpTooltip help={help} />}

          <CkEditor4Component
            value={data?.[name]}
            onChange={(newData) => setData(name, newData)}
            id={name}
          />
          <InputError message={errors[name]?.[0]} />
        </InputWrapper>
      );

    case 'textarea':
      return (
        <InputWrapper>
          <Label htmlFor={name}>{label} {required && <span className="text-red-500 font-bold text-xl">*</span>}</Label>
          <textarea
            id={name}
            value={data?.[name]}
            onChange={(e) => setData(name, e.target.value)}
            readOnly={readOnly}
            className="w-full rounded-md border p-2"
            rows={5}
          />
          <InputError message={errors[name]?.[0]} />
        </InputWrapper>
      );

    case 'date':
    case 'datetime-local':

       {
      const inputRef = useRef<HTMLInputElement>(null);
      const handleClick = (e: React.MouseEvent<HTMLDivElement>) => {
        const input = inputRef.current;
        if (!input) return;

        const rect = input.getBoundingClientRect();
        const clickX = e.clientX - rect.left;

        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        if (!ctx) return;

        const style = getComputedStyle(input);
        ctx.font = `${style.fontWeight} ${style.fontSize} ${style.fontFamily}`;

        const value = input.value || input.placeholder || '00/00/0000';
        const textWidth = ctx.measureText(value).width;

        const paddingLeft = parseFloat(style.paddingLeft) || 0;
        const buffer = 8;
        const textEnd = paddingLeft + textWidth + buffer;

        if (clickX > textEnd || clickX < paddingLeft - buffer) {
          e.preventDefault();
          input.showPicker?.();
          input.focus();
        }
      };

      return (
        <div className="relative w-full" onMouseDown={handleClick}>
          <Label htmlFor={name}>{label}</Label>
          {help &&  <HelpTooltip help={help} />}

          <Input
            id={name}
            ref={inputRef}
            type={type}
            value={data?.[name] ?? ''}
            onChange={(e) => set(e.target.value)}
            readOnly={readOnly}
            {...props}
          />
          <InputError message={errors[name]?.[0]} />
        </div>
      );
    }

    case 'select':
      return (
        <InputWrapper>
          <Label htmlFor={name}>{label} {required && <span className="text-red-500 font-bold text-xl">*</span>}</Label>
          <select
            id={name}
            value={data?.[name] ?? ''}
            onChange={(e) => setData(name, e.target.value)}
            required={required}
            className="w-full rounded-md border p-2"
          >
            <option className="text-black" value="">
              Select an option
            </option>
            {options &&
              options.map((item: any) => {
                const value = getOptionValue(item);
                const label = getOptionLabel(item);
                return (
                  <option className="text-black" key={String(value)} value={String(value)}>
                    {label}
                  </option>
                );
              })}
            {children}
          </select>
          <InputError message={errors[name]?.[0]} />
        </InputWrapper>
      );
case 'multiselect': {
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
    }));

  const selectedOptions = formattedOptions.filter(opt =>
    currentIds.includes(opt.value)
  );

  return (
    <InputWrapper>
      <Label htmlFor={name}>
        {label} {required && <span className="text-red-500 font-bold text-xl">*</span>}
      </Label>

      <Select
        inputId={name}
        isMulti
        options={formattedOptions}
        value={selectedOptions}
        onChange={(selected: MultiValue<{ value: string; label: string }>) => {
          const ids = selected.map(s => Number(s.value));
          setData(name, ids);
        }}
        placeholder="Select…"
        className="react-select-container"
        classNamePrefix="react-select"
        menuPortalTarget={document.body}
        styles={{
          menuPortal: (base) => ({ ...base, zIndex: 9999 }),
          menu: (base) => ({ ...base, backgroundColor: '#fff' }),
          option: (base, state) => ({
            ...base,
            backgroundColor: (state.isFocused || state.isSelected) ? '#2563eb' : '#fff',
            color: (state.isFocused || state.isSelected) ? '#fff' : '#111827',
            ':active': { ...base[':active'], backgroundColor: '#2563eb', color: '#fff' },
          }),
          control: (base, state) => ({
            ...base,
            backgroundColor: '#fff',
            color: '#111827',
            borderColor: state.isFocused ? '#2563eb' : base.borderColor,
          }),
          singleValue: (base) => ({ ...base, color: '#111827' }),
          input: (base) => ({ ...base, color: '#111827' }),
          placeholder: (base) => ({ ...base, color: '#6b7280' }),
        }}
      />

      <InputError message={errors[name]?.[0]} />
    </InputWrapper>
  );
}


    case 'checkbox':
      function handleCheckboxChange(value: string, checked: boolean) {
        const currentValues: string[] = data[name] || [];
        if (checked) {
          setData(name, [...new Set([...currentValues, value])]);
        } else {
          setData(name, currentValues.filter((v) => v !== value));
        }
      }

      return (
        <InputWrapper>
          <Label htmlFor={name}>{label} {required && <span className="text-red-500 font-bold text-xl">*</span>}</Label>
          <div className="space-y-2" id={name}>
            {options?.map((item: any) => {
              const itemValue = getOptionLabel(item);
              const checked = Array.isArray(data[name]) && data[name].includes(itemValue);

              return (
                <label key={getOptionValue(item)} className="flex items-center space-x-2">
                  <input
                    type="checkbox"
                    value={itemValue}
                    checked={checked}
                    onChange={(e) => handleCheckboxChange(itemValue, e.target.checked)}
                  />
                  <span>{itemValue}</span>
                </label>
              );
            })}
          </div>
          <InputError message={errors[name]?.[0]} />
        </InputWrapper>
      );

    case 'image':
      return (
        <InputWrapper>
          <Label htmlFor={name}>{label} {required && <span className="text-red-500 font-bold text-xl">*</span>}</Label>
          <ImageUploader
            name={name}
            value1={data?.[name]}
            setData={setData}
            widthMultiplier={widthMultiplier}
            heightMultiplier={heightMultiplier}
          />
          <InputError message={errors[name]?.[0]} />
        </InputWrapper>
      );

    case 'file':
      return (
        <InputWrapper>
          <Label htmlFor={name}>{label} {required && <span className="text-red-500 font-bold text-xl">*</span>}</Label>
          <FileUploader name={name} value1={data?.[name]} setData={setData} />
          <InputError message={errors[name]?.[0]} />
        </InputWrapper>
      );

    case 'switch':
      return (
        <InputWrapper>
          <Label htmlFor={name}>{label} {required && <span className="text-red-500 font-bold text-xl">*</span>}</Label>
          <ActiveToggle
            value={!!data.is_active}
            onChange={(val) => setData('is_active', val ? 1 : 0)}
            error={errors.is_active?.[0]}
          />
          <InputError message={errors[name]?.[0]} />
        </InputWrapper>
      );

    default:
      return (
        <InputWrapper>
          <Label htmlFor={name}>{label} {required && <span className="text-red-500 font-bold text-xl">*</span>}</Label>
          <Input
            id={name}
            type={type}
            value={data[name]}
            onChange={(e) => setData(name, e.target.value)}
            readOnly={readOnly}
            {...props}
          />
          <InputError message={errors[name]?.[0]} />
        </InputWrapper>
      );
  }
}
