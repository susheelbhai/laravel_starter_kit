import { Plus, Minus } from 'lucide-react';
import { useState } from 'react';

interface ExpandableSectionProps {
  title: string;
  children: React.ReactNode;
}

const ExpandableSection = ({ title, children }: ExpandableSectionProps) => {
  const [expanded, setExpanded] = useState(false);

  return (
    <div className="w-full my-3 rounded-lg border border-gray-300 bg-white shadow-sm transition">
      <button
        className="flex w-full cursor-pointer items-center justify-between rounded-lg px-4 py-3 text-left text-lg font-semibold text-gray-800 hover:bg-gray-100"
        onClick={() => setExpanded(!expanded)}
      >
        <span className=''>{title}</span>
        {expanded ? <Minus className="h-5 w-5" /> : <Plus className="h-5 w-5" />}
      </button>
      {expanded && (
        <div className="px-4 pb-4 text-gray-600">
          {children}
        </div>
      )}
    </div>
  );
};

export default ExpandableSection;
