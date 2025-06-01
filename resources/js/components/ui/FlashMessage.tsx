import React from 'react';

interface FlashMessageProps {
  message?: string;
  status_class?: string;
}

const FlashMessage: React.FC<FlashMessageProps> = ({ message, status_class }) => {
  if (!message) return null;

  let bgColor = 'bg-green-100';
  let borderColor = 'border-green-400';
  let textColor = 'text-green-700';

  if (status_class === 'error') {
    bgColor = 'bg-red-100';
    borderColor = 'border-red-400';
    textColor = 'text-red-700';
  } else if (status_class === 'info') {
    bgColor = 'bg-blue-100';
    borderColor = 'border-blue-400';
    textColor = 'text-blue-700';
  }

  return (
    <div
      className={`${bgColor} ${borderColor} ${textColor} border px-4 py-3 rounded relative mb-4`}
      role="alert"
    >
      <span className="block sm:inline">{message}</span>
    </div>
  );
};

export default FlashMessage;
