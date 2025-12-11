import React from "react";

export const InputWrapper = ({
  children,
  className = "",
}: {
  children: React.ReactNode;
  className?: string;
}) => {
  return <div className={`mb-4 space-y-1 ${className}`}>{children}</div>;
};
