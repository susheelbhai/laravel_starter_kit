
import { ReactNode } from 'react';

interface InputFieldsetProps  {
    legend: string;
    description?: string;
    children: ReactNode;
    className?: string;
}

export function InputFieldset({className, legend, description, children, ...props }: InputFieldsetProps) {
    return (
        <div className={`rounded-lg overflow-hidden bg-white shadow-sm my-4 ${className}`} {...props}>
            {/* <legend className="mb-4 text-xl font-bold bg-gradient-to-r from-blue-500 to-purple-500 border-b p-3 overflow-hidden">{legend}</legend> */}
            <div className="px-8 pt-8">
                <h1 className="text-xl font-bold">{legend}</h1>
                {description && <p className="text-sm text-gray-500">{description}</p>}
            </div>
            <div className="p-8">
              {children}
            </div>
        </div>
    );
}
export default InputFieldset;