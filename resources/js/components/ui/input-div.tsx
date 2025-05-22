import InputError from '@/components/input-error';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import CkEditor4Component from '../CkEditor4Component';
import ActiveToggle from './input-switch';
import ImageUploader from './input-image';

type InputDivProps = {
    type: string;
    label: string;
    inputDivData: {
        data: Record<string, any>;
        setData: (key: string, value: any) => void;
        errors: Record<string, string[]>;
    };
    name: string;
};

export function InputDiv({ type='text', label, inputDivData, name }: InputDivProps) {
    const { data, setData, errors } = inputDivData;

    switch (type) {
      case 'text':
      case 'email':
      case 'password':
      case 'tel':
        return (
          <div>
              <Label>{label}</Label>
              <Input
                  type={type}
                  value={data[name]}
                  onChange={(e) => setData(name, e.target.value)}
              />
              <InputError message={errors[name]?.[0]} />
          </div>
      );
        break;
      case 'editor':
        return (
          <div>
              <Label>{label}</Label>
              <CkEditor4Component value={data?.[name]} onChange={(newData) => setData(name, newData)} id={name} />
              <InputError message={errors[name]?.[0]} />
          </div>
      );
    
        break;
      case 'textarea':
        return (
          <div>
              <Label>{label}</Label>
              <textarea
                        value={data?.[name]}
                        onChange={(e) => setData(name, e.target.value)}
                        className="w-full rounded-md border p-2"
                        rows={5}
                    />
              <InputError message={errors[name]?.[0]} />
          </div>
      );
    
    
        break;
      case 'image':
        return (
          <div>
              <Label>{label}</Label>
              <ImageUploader name={name} value1={data?.[name]} setData={setData} />
              <InputError message={errors[name]?.[0]} />
          </div>
      );
    
        break;
      case 'switch':
        return (
          <div>
              <Label>{label}</Label>
              <ActiveToggle
                value={!!data.is_active}
                onChange={(val) => setData("is_active", val ? 1 : 0)}
                error={errors.is_active?.[0]}
              />
              <InputError message={errors[name]?.[0]} />
          </div>
      );
    
      default:
        return (
          <div>
              <Label>{label}</Label>
              <Input
                  type={type}
                  value={data[name]}
                  onChange={(e) => setData(name, e.target.value)}
              />
              <InputError message={errors[name]?.[0]} />
          </div>
      );
        break;
    }
    
}