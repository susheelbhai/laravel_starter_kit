import '../../../../css/picker.css';
import React, { useState } from 'react';
import type { InputDivProps } from '../container/input-types';
import { InputWrapper } from '../container/input-wrapper';

interface InputClockTimePickerProps extends InputDivProps {
    label?: string;
    help?: string;
    readOnly?: boolean;
    className?: string;
    placeholder?: string;
}

function pad(num: number) {
    return num.toString().padStart(2, '0');
}

export default function InputClockTimePicker({
    label,
    name,
    help,
    inputDivData,
    readOnly,
    className,
    placeholder = 'Select time',
}: InputClockTimePickerProps) {
    const { data, setData, errors } = inputDivData;
    const value = data[name] || '';
    const [isOpen, setIsOpen] = useState(false);
    const [hour, setHour] = useState<number | null>(null);
    const [minute, setMinute] = useState<number | null>(null);
    const [ampm, setAMPM] = useState<'AM' | 'PM'>('AM');

    // Parse value if present
    React.useEffect(() => {
        if (value) {
            const [h, m] = value.split(':');
            let hourNum = parseInt(h, 10);
            let ampmVal: 'AM' | 'PM' = 'AM';
            if (hourNum >= 12) {
                ampmVal = 'PM';
                if (hourNum > 12) hourNum -= 12;
            }
            setHour(hourNum);
            setMinute(parseInt(m, 10));
            setAMPM(ampmVal);
        }
    }, [value]);

    function handleSelect(
        h: number,
        m: number,
        ampmVal: 'AM' | 'PM',
        close = false,
    ) {
        setHour(h);
        setMinute(m);
        setAMPM(ampmVal);
        const hour24 =
            ampmVal === 'PM' ? (h === 12 ? 12 : h + 12) : h === 12 ? 0 : h;
        setData(name, `${pad(hour24)}:${pad(m)}`);
        if (close) setIsOpen(false);
    }

    // Generate clock face positions and angles
    function getPosition(index: number, total: number, radius: number) {
        const angle = (index / total) * 2 * Math.PI - Math.PI / 2;
        return {
            left: `${50 + radius * Math.cos(angle)}%`,
            top: `${50 + radius * Math.sin(angle)}%`,
            angle,
        };
    }

    return (
        <InputWrapper>
            {label && (
                <div className="mb-1 flex items-center gap-2">
                    <span>{label}</span>
                    {help && (
                        <span className="text-xs text-muted-foreground">
                            {help}
                        </span>
                    )}
                </div>
            )}
            <div className="relative">
                <div className="relative w-full">
                    <input
                        type="text"
                        className={`w-full rounded-lg border-2 bg-[var(--input-bg)] border-[var(--input-border)] px-3 py-2 text-left text-[var(--input-text)] placeholder:text-[var(--input-placeholder)] hover:bg-[var(--input-hover-bg)] focus:outline-none focus:border-secondary/60 focus:bg-[var(--input-focused-bg)] focus:text-[var(--input-focused-text)] ${className || ''}`}
                        value={value}
                        placeholder={placeholder}
                        readOnly={readOnly}
                        onFocus={() => {
                            if (!readOnly) {
                                setHour(null); // Always start with hour selection
                                setIsOpen(true);
                            }
                        }}
                        onClick={() => {
                            if (!readOnly) {
                                setHour(null);
                                setIsOpen(true);
                            }
                        }}
                        onBlur={(e) => {
                            // Only close if focus is not moving to the clock popover
                            setTimeout(() => {
                                const active = document.activeElement;
                                if (
                                    active &&
                                    !active.closest('.clock-popover')
                                ) {
                                    setIsOpen(false);
                                }
                            }, 100);
                        }}
                        onChange={(e) => {
                            const val = e.target.value;
                            // Accept HH:MM or H:MM, 24h or 12h with AM/PM
                            const match = val.match(
                                /^(\d{1,2}):(\d{2})(?:\s*(AM|PM))?$/i,
                            );
                            if (match) {
                                let h = parseInt(match[1], 10);
                                const m = parseInt(match[2], 10);
                                let ampmVal: 'AM' | 'PM' = ampm;
                                if (match[3])
                                    ampmVal = match[3].toUpperCase() as
                                        | 'AM'
                                        | 'PM';
                                if (h >= 0 && h <= 23 && m >= 0 && m <= 59) {
                                    // If 12h format with AM/PM
                                    if (match[3]) {
                                        if (ampmVal === 'PM' && h < 12) h += 12;
                                        if (ampmVal === 'AM' && h === 12) h = 0;
                                    }
                                    setData(name, `${pad(h)}:${pad(m)}`);
                                    setHour(
                                        match[3]
                                            ? h % 12 === 0
                                                ? 12
                                                : h % 12
                                            : h,
                                    );
                                    setMinute(m);
                                    setAMPM(ampmVal);
                                }
                            } else {
                                setData(name, val);
                            }
                        }}
                    />
                    <div
                        className="absolute inset-y-0 right-0 flex cursor-pointer items-center pr-3"
                        onMouseDown={(e) => e.preventDefault()}
                        onClick={() => {
                            if (!readOnly) {
                                setHour(null);
                                setIsOpen((v) => !v);
                            }
                        }}
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            className="h-4 w-4 text-[var(--input-placeholder)]"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth={2}
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                    </div>
                </div>
                {isOpen && (
                    <div
                        className="clock-popover absolute left-0 z-10 mt-2 rounded-lg border bg-background p-4 shadow-lg"
                    >
                        <div
                            className="clock-face"
                        >
                            {/* Outer circle just outside the clock */}
                            <svg
                                className="clock-outer-circle pointer-events-none"
                                width={220}
                                height={220}
                            >
                                <circle
                                    cx={110}
                                    cy={110}
                                    r={107}
                                    fill="none"
                                    stroke="var(--muted-foreground, #64748b)"
                                    strokeWidth={3}
                                />
                            </svg>
                            {/* Clock Needle (niddle) */}
                            {hour === null
                                ? // Show needle for hour selection if value exists
                                  (() => {
                                      if (value) {
                                          const [vh] = value.split(':');
                                          const h = parseInt(vh, 10);
                                          // 12 or 0 is index 0, 1 is 1, ..., 11 is 11
                                          const posIndex =
                                              h === 0 || h === 12 ? 0 : h;
                                          const { angle } = getPosition(
                                              posIndex,
                                              12,
                                              48,
                                          );
                                          const center = 105; // Center for needle
                                          const length = 48;
                                          const x2 =
                                              center + length * Math.cos(angle);
                                          const y2 =
                                              center + length * Math.sin(angle);
                                          return (
                                              <svg
                                                  className="clock-needle pointer-events-none"
                                                  width={210}
                                                  height={210}
                                              >
                                                  <line
                                                      x1={center}
                                                      y1={center}
                                                      x2={x2}
                                                      y2={y2}
                                                      stroke="var(--primary, #0212AC)"
                                                      strokeWidth={3}
                                                  />
                                              </svg>
                                          );
                                      }
                                      return null;
                                  })()
                                : // Show needle for minute selection
                                  minute !== null &&
                                  (() => {
                                      const { angle } = getPosition(
                                          minute,
                                          60,
                                          40,
                                      );
                                      const center = 105; // Center for minute needle
                                      const length = 40;
                                      const x2 =
                                          center + length * Math.cos(angle);
                                      const y2 =
                                          center + length * Math.sin(angle);
                                      return (
                                          <svg
                                              className="clock-needle pointer-events-none"
                                              width={200}
                                              height={200}
                                          >
                                              <line
                                                  x1={center}
                                                  y1={center}
                                                  x2={x2}
                                                  y2={y2}
                                                  stroke="var(--primary, #0212AC)"
                                                  strokeWidth={3}
                                              />
                                          </svg>
                                      );
                                  })()}
                            {/* Hours or Minutes Clock Face */}
                            {hour === null ? (
                                // Show hours
                                <>
                                    {[...Array(12)].map((_, i) => {
                                        // Start from 12 at index 0, then 1, 2, ..., 11
                                        const h = i === 0 ? 12 : i;
                                        const pos = getPosition(i, 12, 40); // Reduced radius for numbers
                                        return (
                                            <button
                                                key={h}
                                                type="button"
                                                className="clock-hour-btn"
                                                style={{
                                                    left: pos.left,
                                                    top: pos.top,
                                                    transform: 'translate(-50%, -50%)',
                                                }}
                                                onClick={() => setHour(h)}
                                            >
                                                {h}
                                            </button>
                                        );
                                    })}
                                    {/* Center dot */}
                                    <div className="clock-center-dot">
                                        <div className="clock-center-dot-inner" />
                                    </div>
                                </>
                            ) : (
                                // Show only multiples of 5 as visible, but allow click anywhere for any minute
                                <>
                                    {[...Array(60)].map((_, i) => {
                                        const pos = getPosition(i, 60, 40); // Reduced radius for numbers
                                        return (
                                            <button
                                                key={i}
                                                type="button"
                                                aria-label={pad(i)}
                                                className={`clock-minute-btn${i % 5 === 0 ? ' visible' : ''}${minute === i ? ' selected' : ''}`}
                                                style={{
                                                    left: pos.left,
                                                    top: pos.top,
                                                    transform: 'translate(-50%, -50%)',
                                                }}
                                                onClick={() =>
                                                    hour !== null &&
                                                    handleSelect(
                                                        hour,
                                                        i,
                                                        ampm,
                                                        false,
                                                    )
                                                }
                                                onMouseEnter={(e) => {
                                                    if (
                                                        e.buttons === 1 &&
                                                        hour !== null
                                                    )
                                                        handleSelect(
                                                            hour,
                                                            i,
                                                            ampm,
                                                            false,
                                                        );
                                                }}
                                            >
                                                {i % 5 === 0 ? pad(i) : ''}
                                            </button>
                                        );
                                    })}
                                    {/* Center dot */}
                                    <div className="clock-center-dot">
                                        <div className="clock-center-dot-inner" />
                                    </div>
                                </>
                            )}
                        </div>
                        {/* AM/PM and Done button in one line, smaller */}
                        <div className="mt-4 flex items-center justify-center gap-2">
                            {['AM', 'PM'].map((ap) => (
                                <button
                                    key={ap}
                                    type="button"
                                    className={`am-pm-btn${ampm === ap ? ' selected' : ''}`}
                                    onClick={() => setAMPM(ap as 'AM' | 'PM')}
                                >
                                    {ap}
                                </button>
                            ))}
                            <button
                                type="button"
                                className="done-btn"
                                disabled={hour === null || minute === null}
                                onClick={() =>
                                    hour !== null &&
                                    minute !== null &&
                                    handleSelect(hour, minute, ampm, true)
                                }
                            >
                                Done
                            </button>
                        </div>
                        {/* Show time below the button, no title */}
                        {value && (
                            <div className="selected-time">
                                {value}
                            </div>
                        )}
                    </div>
                )}
            </div>
        </InputWrapper>
    );
}
