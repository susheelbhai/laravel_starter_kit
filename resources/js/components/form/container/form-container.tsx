import { usePage } from '@inertiajs/react';
import { LoaderCircle } from 'lucide-react';
import React from 'react';
import { Button } from '@/components/ui/button';

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

interface AppData {
  debug: boolean;
}

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
  const appData = (usePage().props as { appData: AppData }).appData;
  if (appData.debug) {
    processing = false;
  }
  return (
    <form onSubmit={onSubmit} className={className}>
      {children}

      {showButton && (
        <Button
          type={buttonType}
          className={`${buttonClassName} mt-4 w-full`}
          tabIndex={4}
          disabled={processing}
        >
          {processing && (
            <LoaderCircle className="h-4 w-4 animate-spin" />
          )}
          {buttonLabel}
        </Button>
      )}


    </form>
  );
}
