// FlashMessage.tsx
import React, { useEffect, useState } from 'react';

interface FlashMessageProps {
  type: 'success' | 'warning' | 'error';
  message: string;
}

const colorClasses = {
  success: 'bg-green-100 text-green-800',
  warning: 'bg-yellow-100 text-yellow-800',
  error: 'bg-red-100 text-red-800',
};

const FlashMessage: React.FC<FlashMessageProps> = ({ type, message }) => {
  const [visible, setVisible] = useState(true);

  useEffect(() => {
    setVisible(true);
    const timer = setTimeout(() => setVisible(false), 4000);
    return () => clearTimeout(timer);
  }, [type, message]); // Reset visibility on new message

  if (!visible) return null;

  return (
    <div className={`mb-4 rounded p-4 text-center ${colorClasses[type]}`} role="alert">
      {message}
    </div>
  );
};

export default FlashMessage;
