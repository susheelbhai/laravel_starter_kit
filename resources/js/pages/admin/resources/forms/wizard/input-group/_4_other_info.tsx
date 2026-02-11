import { InputDiv } from '@/components/form/container/input-div';
import InputFieldset from '@/components/form/container/input-fieldset';
import type { WizardComponentProps } from '../types';

export default function OtherInfoSection({ inputDivData }: WizardComponentProps) {
    return (
        <InputFieldset
            legend="Other Information"
            description="Provide any additional notes or information for The Film Sub team."
        >

            <InputDiv
                type="textarea"
                label="short description"
                name="short_description"
                inputDivData={inputDivData}
            />
            <InputDiv
                type="editor"
                label="Biodata"
                name="biodata"
                inputDivData={inputDivData}
            />
        </InputFieldset>
    );
}
