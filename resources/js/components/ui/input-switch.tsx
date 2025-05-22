import { Label } from "@/components/ui/label";
import InputError from "@/components/input-error";

export default function ActiveToggle({
  value,
  onChange,
  error,
}: {
  value: boolean;
  onChange: (value: boolean) => void;
  error?: string;
}) {
  return (
    <div className=" space-y-2">
      <button
        type="button"
        role="switch"
        aria-checked={value}
        onClick={() => onChange(!value)}
        className={`relative inline-flex h-8 w-24 items-center rounded-full transition-colors focus:outline-none cursor-pointer ${
          value ? "bg-green-500" : "bg-gray-300"
        }`}
      >
        <span
          className={`inline-block h-8 w-8 transform rounded-full bg-white transition-transform ${
            value ? "translate-x-16" : "translate-x-0"
          }`}
        />
      </button>
      <InputError message={error} />
    </div>
  );
}
