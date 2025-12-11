import { InputDiv } from '@/components/form/input-div';
import InputFieldset from '@/components/form/input-fieldset';

export default function OtherInfoSection({ inputDivData }: { inputDivData: any }) {
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
