


import * as React from "react"

import { cn } from "@/lib/utils"

function Container({ className, ...props }: React.ComponentProps<"div">) {
  return (
    <div
      className={cn(
        "mx-auto max-w-[1320px] justify-between px-4 py-4",
        className
      )}
      {...props}
    >
      {props.children}
    </div>
  )
}

export { Container }

