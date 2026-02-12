import type { FormEventHandler } from "react";
import { useState, useEffect, useCallback } from "react";
import { Button } from "@/components/ui/button";

const normalizeErrors = (errs: Record<string, any>) =>
  Object.fromEntries(
    Object.entries(errs || {}).map(([k, v]) => [
      k,
      Array.isArray(v) ? v : v ? [v] : [],
    ])
  );

interface Step {
  id: number;
  title: string;
  Component: React.FC<any>;
}

interface FormWizardProps {
  title?: string;
  steps: Step[];
  data: any;
  setData: (key: string, value: any) => void;
  errors: Record<string, any>;
  processing: boolean;
  onPartialSave?: (stepIndex: number, stepKey: string, onFinish: (success: boolean) => void) => void;
  onSubmit: FormEventHandler;
  extraProps?: Record<string, any>;
}

export default function FormWizard({
  title = "Multi-Step Form",
  steps,
  data,
  setData,
  errors,
  processing,
  onPartialSave,
  onSubmit,
  extraProps = {},
}: FormWizardProps) {
  const [step, setStep] = useState(0);
  const [completedSteps, setCompletedSteps] = useState<number[]>([]);

  const CurrentStepComponent = steps[step].Component;

  const saveStep = useCallback((idx: number) => {
    const key = steps[idx].title.toLowerCase().replace(/\s+/g, "_");

    if (!onPartialSave) return;
    // ✅ Wait for parent confirmation
    onPartialSave(idx, key, (success) => {
      if (success) {
        setCompletedSteps((prev) => [...new Set([...prev, idx])]);
        if (idx < steps.length - 1) setStep(idx + 1);
      }
    });
  }, [onPartialSave, steps]);

  // ENTER key shortcut to trigger Save & Next
  useEffect(() => {
    const handleEnter = (e: KeyboardEvent) => {
      if (e.key === "Enter" && !e.shiftKey) {
        const active = document.activeElement as HTMLElement;
        const tag = active?.tagName?.toLowerCase();
        if (tag === "textarea" || tag === "select") return;
        e.preventDefault();
        saveStep(step);
      }
    };
    window.addEventListener("keydown", handleEnter);
    return () => window.removeEventListener("keydown", handleEnter);
  }, [step, data, saveStep]);

  return (
    <div>
      {title && (
        <h1 className="mb-6 text-center text-2xl font-bold text-primary">{title}</h1>
      )}

      {/* Step Tabs */}
      <div className="mb-6 flex overflow-hidden rounded-md bg-muted">
        {steps.map((s, idx) => {
          let classes = "flex-1 border-r p-3 text-sm font-medium last:border-r-0 ";
          if (idx === step) classes += "bg-primary text-primary-foreground";
          else if (completedSteps.includes(idx)) classes += "bg-accent text-accent-foreground";
          else classes += "bg-muted text-muted-foreground hover:bg-muted/80";

          return (
            <button
              key={s.id}
              type="button"
              onClick={() => setStep(idx)}
              className={classes}
            >
              {s.title}
            </button>
          );
        })}
      </div>

      <form onSubmit={onSubmit}>
        <CurrentStepComponent
          inputDivData={{ data, setData, errors: normalizeErrors(errors) }}
          data={data}
          setData={setData}
          {...extraProps}
        />

        {/* Navigation */}
        <div className="mt-6 flex justify-between">
          {step > 0 && (
            <Button type="button" onClick={() => setStep(step - 1)}>
              Previous
            </Button>
          )}
          {step < steps.length - 1 ? (
            <Button
              type="button"
              onClick={() => saveStep(step)}
              disabled={processing}
            >
              {processing ? "Saving..." : "Save & Next"}
            </Button>
          ) : (
            <Button type="submit" disabled={processing}>
              {processing ? "Submitting..." : "Submit"}
            </Button>
          )}
        </div>
      </form>
    </div>
  );
}
