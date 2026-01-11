import { InputDivProps } from './input-types';

import InputCheckbox from '../input/input-checkbox';
import InputDate from '../input/input-date';
import InputDefault from '../input/input-default';
import InputEditor from '../input/input-editor';
import InputFile from '../input/input-file';
import InputHidden from '../input/input-hidden';
import InputImage from '../input/input-image';
import InputMultiCheckbox from '../input/input-multi-checkbox';
import InputMultiSelect from '../input/input-multi-select';
import InputRadio from '../input/input-radio';
import InputSelect from '../input/input-select';
import InputSwitch from '../input/input-switch';
import InputText from '../input/input-text';
import InputTextarea from '../input/input-textarea';
import InputMultiImage from '../input/input-image-multiple';
import InputMultiFile from '../input/input-file-multiple';
import InputTags from '../input/input-tags';
import InputDatePicker from '../input/input-date-picker';
import InputTimePicker from '../input/input-time-picker';
import InputDateTimePicker from '../input/input-datetime-picker';
import InputDateRangePicker from '../input/input-date-range-picker';

import InputDateRangePickerExpended from '../input/input-date-range-picker-expended';
import InputClockTimePicker from '../input/input-clock-time-picker';

export function InputDiv(props: InputDivProps) {
    const { type } = props;

    switch (type) {
        case 'text':
        case 'email':
        case 'password':
        case 'tel':
        case 'number':
            return <InputText {...props} />;

        case 'hidden':
            return <InputHidden {...props} />;

        case 'editor':
            return <InputEditor {...props} />;

        case 'textarea':
            return <InputTextarea {...props} />;

        case 'date':
        case 'datetime-local':
            return <InputDate {...props} />;
            
        case 'date-picker':
            return <InputDatePicker {...props} />;
            
        case 'date-range-picker':
            return <InputDateRangePicker {...props} />;
            
        case 'date-range-picker-expended':
            return <InputDateRangePickerExpended {...props} />;
            
        case 'time-picker':
            return <InputTimePicker {...props} />;

        case 'clock-time-picker':
            return <InputClockTimePicker {...props} />;

        case 'date-time-picker':
            return <InputDateTimePicker {...props} />;
            
        case 'radio':
            return <InputRadio {...props} />;

        case 'select':
            return <InputSelect {...props} />;

        case 'multiselect':
            return <InputMultiSelect {...props} />;

        case 'checkbox':
            return <InputCheckbox {...props} />;

        case 'multicheckbox':
            return <InputMultiCheckbox {...props} />;

        case 'image':
            return <InputImage {...props} />;

        case 'images':
            return <InputMultiImage {...props} />;

        case 'file':
            return <InputFile {...props} />;

        case 'files':
            return <InputMultiFile {...props} />;

        case 'switch':
            return <InputSwitch {...props} />;

        case 'tags':
            return <InputTags {...props} />;

        default:
            return <InputDefault {...props} />;
    }
}

export default InputDiv;
