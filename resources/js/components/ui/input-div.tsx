import InputError from '@/components/input-error';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import CkEditor4Component from '../CkEditor4Component';
import ActiveToggle from './input-switch';
import ImageUploader from './input-image';
import FileUploader from './input-file';

type InputDivProps = {
  type: string;
  label: string;
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
};

export function InputDiv({
  children,
  type = 'text',
  label,
  inputDivData,
  name,
  options,
  widthMultiplier,
  heightMultiplier,
  readOnly,
  ...props
}: InputDivProps) {
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
            readOnly={readOnly}
              {...props}
          />
          <InputError message={errors[name]?.[0]} />
        </div>
      );

    case 'hidden':
      return (
        <Input
          type={type}
          value={data[name]}
          onChange={(e) => setData(name, e.target.value)}
        />
      );

    case 'editor':
      return (
        <div>
          <Label>{label}</Label>
          <CkEditor4Component
            value={data?.[name]}
            onChange={(newData) => setData(name, newData)}
            id={name}
          />
          <InputError message={errors[name]?.[0]} />
        </div>
      );

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

    case 'select':
      return (
        <div>
          <Label>{label}</Label>
          <select
            value={data?.[name]}
            onChange={(e) => setData(name, e.target.value)}
            className="w-full rounded-md border p-2"
          >
            <option className="text-black" value="">
              Select an option
            </option>
            {options &&
              options.map((item: any) => (
                <option className="text-black" key={item.id} value={item.id}>
                  {item.title}
                </option>
              ))}
            {children}
          </select>
          <InputError message={errors[name]?.[0]} />
        </div>
      );

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
    <div>
      <Label>{label}</Label>
      <div className="space-y-2">
        {options?.map((item: any) => {
          const itemValue = item.title ?? item.name; // Support both title or name keys
          const checked = Array.isArray(data[name]) && data[name].includes(itemValue);

          return (
            <label key={item.id} className="flex items-center space-x-2">
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
    </div>
  );


    case 'image':
      return (
        <div>
          <Label>{label}</Label>
          <ImageUploader
            name={name}
            value1={data?.[name]}
            setData={setData}
            widthMultiplier={widthMultiplier}
            heightMultiplier={heightMultiplier}
          />
          <InputError message={errors[name]?.[0]} />
        </div>
      );

    case 'file':
      return (
        <div>
          <Label>{label}</Label>
          <FileUploader name={name} value1={data?.[name]} setData={setData} />
          <InputError message={errors[name]?.[0]} />
        </div>
      );

    case 'switch':
      return (
        <div>
          <Label>{label}</Label>
          <ActiveToggle
            value={!!data.is_active}
            onChange={(val) => setData('is_active', val ? 1 : 0)}
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
  }
}
