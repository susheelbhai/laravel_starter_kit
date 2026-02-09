import { X } from 'lucide-react';
import type { KeyboardEvent } from 'react';
import { useState } from 'react';
import InputError from '@/components/input-error';
import { Label } from '@/components/ui/label';
import type { InputDivProps } from '../container/input-types';
import { InputWrapper } from '../container/input-wrapper';

export default function InputTags(props: InputDivProps) {
    const { label, name = '', placeholder, inputDivData, className } = props;
    const { data, setData, errors } = inputDivData || { data: {}, setData: () => {}, errors: {} };

    // Normalize current value to array of strings
    const raw = data?.[name];
    const tags: string[] = Array.isArray(raw) ? raw : [];
    
    const [inputValue, setInputValue] = useState('');

    const handleKeyDown = (e: KeyboardEvent<HTMLInputElement>) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            const trimmedValue = inputValue.trim();
            if (trimmedValue && !tags.includes(trimmedValue)) {
                setData(name, [...tags, trimmedValue]);
                setInputValue('');
            }
        }
    };

    const removeTag = (indexToRemove: number) => {
        const updated = tags.filter((_, index) => index !== indexToRemove);
        setData(name, updated);
    };

    return (
        <InputWrapper className={className}>
            {label && (
                <Label htmlFor={name}>
                    {label}
                </Label>
            )}

            <div className="space-y-2">
                {/* Tags Display */}
                {tags.length > 0 && (
                    <div className="flex flex-wrap gap-2">
                        {tags.map((tag, index) => (
                            <span
                                key={index}
                                className="inline-flex items-center gap-1 rounded-md bg-primary/10 px-3 py-1 text-sm text-primary"
                            >
                                {tag}
                                <button
                                    type="button"
                                    onClick={() => removeTag(index)}
                                    className="rounded-full hover:bg-primary/20"
                                >
                                    <X className="h-3 w-3" />
                                </button>
                            </span>
                        ))}
                    </div>
                )}

                {/* Input Field */}
                <input
                    type="text"
                    id={name}
                    value={inputValue}
                    onChange={(e) => setInputValue(e.target.value)}
                    onKeyDown={handleKeyDown}
                    placeholder={placeholder || 'Type and press Enter'}
                    className="w-full rounded-md border-2 bg-input-bg border-input-border px-3 py-2 text-sm text-input-text placeholder:text-input-placeholder hover:bg-input-hover-bg focus:outline-none focus:border-secondary/60 focus:bg-input-focused-bg focus:text-input-focused-text"
                />
            </div>

            <InputError message={errors[name]?.[0]} />
        </InputWrapper>
    );
}
