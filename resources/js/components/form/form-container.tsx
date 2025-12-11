import { Button } from '@/components/ui/button';
import React from 'react';

type FormContainerProps = {
  onSubmit: (e: React.FormEvent<HTMLFormElement>) => void;
  processing?: boolean;
  children: React.ReactNode;
  className?: string;
  buttonLabel?: string;        // default: "Submit"
  showButton?: boolean;        // default: true
  buttonType?: 'submit' | 'button';
  buttonClassName?: string;
};

export function FormContainer({
  onSubmit,
  processing = false,
  children,
  className = 'space-y-6 p-6',
  buttonLabel = 'Submit',
  showButton = true,
  buttonType = 'submit',
  buttonClassName,
}: FormContainerProps) {
  return (
    <form onSubmit={onSubmit} className={className}>
      {children}

      {showButton && (
        <Button
          type={buttonType}
          disabled={processing}
          className={buttonClassName}
        >
          {processing ? 'Submitting...' : buttonLabel}
        </Button>
      )}
    </form>
  );
}
