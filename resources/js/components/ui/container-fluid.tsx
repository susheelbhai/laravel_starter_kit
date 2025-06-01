


import * as React from "react"

import { cn } from "@/lib/utils"

function ContainerFluid({ className, ...props }: React.ComponentProps<"div">) {
  return (
    <div
          className={cn(
            "mx-auto w-full items-center justify-between px-4 py-4",
            className
          )}
          {...props}
        >
          {props.children}
        </div>
  )
}

export { ContainerFluid }

