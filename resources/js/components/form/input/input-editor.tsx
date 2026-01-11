import InputError from '@/components/input-error';
import { Label } from '@/components/ui/label';
import CkEditor4Component from '../package/CkEditor4Component';
import TinyMceComponent from '../package/TinyMceComponent';
import HelpTooltip from './input-help-tool';
import { InputDivProps } from '../container/input-types';
import { InputWrapper } from '../container/input-wrapper';

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
    editorType
}: InputDivProps) {
    const { data, setData, errors } = inputDivData;
    editorType = editorType || 'tinymce';
    return (
        <InputWrapper className={className}>
            <Label htmlFor={name}>
                {label}
                {required && (
                    <span className="text-xl font-bold text-red-500">*</span>
                )}
            </Label>
            {help && <HelpTooltip help={help} />}


            {editorType === 'tinymce' && (
                <TinyMceComponent
                    value={data?.[name]}
                    onChange={(newData) => setData(name, newData)}
                    id={name}
                    height={editorHeight}
                    uiColor={editorUiColor}
                    customEditorCss={editorCustomCss}
                />
            )}
            {editorType === 'ckeditor' && (
                <CkEditor4Component
                    value={data?.[name]}
                    onChange={(newData) => setData(name, newData)}
                    id={name}
                    height={editorHeight}
                    uiColor={editorUiColor}
                    customEditorCss={editorCustomCss}
                />
            )}
            <InputError message={errors[name]?.[0]} />
        </InputWrapper>
    );
}
