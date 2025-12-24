import InputError from '@/components/input-error';
import { Label } from '@/components/ui/label';
import CkEditor4Component from './CkEditor4Component';
import HelpTooltip from './input-help-tool';
import { InputDivProps } from './input-types';
import { InputWrapper } from './input-wrapper';

export default function InputEditor({
    label,
    name,
    required,
    help,
    inputDivData,
    className,
    editorHeight,
    editorUiColor,
    editorCustomCss,
}: InputDivProps) {
    const { data, setData, errors } = inputDivData;

    return (
        <InputWrapper className={className}>
            <Label htmlFor={name}>
                {label}
                {required && (
                    <span className="text-xl font-bold text-red-500">*</span>
                )}
            </Label>
            {help && <HelpTooltip help={help} />}

            <CkEditor4Component
                value={data?.[name]}
                onChange={(newData) => setData(name, newData)}
                id={name}
                height={editorHeight}
                uiColor={editorUiColor}
                customEditorCss={editorCustomCss}
            />
            <InputError message={errors[name]?.[0]} />
        </InputWrapper>
    );
}
