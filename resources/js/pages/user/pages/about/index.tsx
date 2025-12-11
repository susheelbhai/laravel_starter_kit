import { usePage } from "@inertiajs/react";
import { Target, Flag, Eye, Quote } from "lucide-react";

import AppLayout from "@/layouts/user/app-layout";

export default function Create() {
  const data = usePage().props.data as any;

  return (
    <AppLayout title="About Us">
      <div className="min-h-screen bg-background font-['Urbanist'] text-foreground">
        {/* Banner */}
        <section className="relative h-64 w-full overflow-hidden md:h-80">
          <div
            className="absolute inset-0 bg-cover bg-center"
            style={{ backgroundImage: `url('${data.banner}')` }}
          />
          {/* Neutral dark overlay */}
          <div className="absolute inset-0 bg-gradient-to-b from-black/70 via-black/60 to-black/80" />
          <div className="relative z-10 flex h-full items-center justify-center px-4">
            <div className="text-center">
              <span className="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-white/80">
                Know our story
              </span>
              <h1 className="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl">
                About Us
              </h1>
              <p className="mx-auto mt-3 max-w-2xl text-sm text-white/80 md:text-base">
                Learn more about who we are, what drives us, and the vision that
                shapes everything we do.
              </p>
            </div>
          </div>
        </section>

        {/* Main Content */}
        <section className="mx-auto max-w-6xl px-4 py-10 md:py-14">
          {/* Intro card */}
          <div className="rounded-3xl bg-card/90 p-6 shadow-[0_24px_60px_rgba(0,0,0,0.08)] ring-1 ring-border md:p-8 lg:p-10">
            {/* Intro paragraphs */}
            <div className="space-y-6 text-sm leading-relaxed text-muted-foreground md:text-base">
              <div dangerouslySetInnerHTML={{ __html: data.para1 }} />
              <div dangerouslySetInnerHTML={{ __html: data.para2 }} />
            </div>

            {/* Objective / Mission / Vision */}
            <div className="mt-10 border-t border-border pt-8">
              <h2 className="mb-6 text-lg font-semibold md:text-xl">
                What we stand for
              </h2>
              <div className="grid gap-6 md:grid-cols-3">
                {/* Objective */}
                <div className="group rounded-2xl bg-muted p-5 shadow-sm ring-1 ring-border transition hover:-translate-y-1 hover:shadow-md">
                  <div className="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-card shadow-sm">
                    <Target className="h-5 w-5 text-primary" />
                  </div>
                  <h3 className="mb-2 text-base font-semibold">
                    Our Objective
                  </h3>
                  <div className="prose prose-sm max-w-none text-muted-foreground prose-p:mb-2 prose-ul:mb-2">
                    <div
                      dangerouslySetInnerHTML={{ __html: data.objective }}
                    />
                  </div>
                </div>

                {/* Mission */}
                <div className="group rounded-2xl bg-muted p-5 shadow-sm ring-1 ring-border transition hover:-translate-y-1 hover:shadow-md">
                  <div className="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-card shadow-sm">
                    <Flag className="h-5 w-5 text-primary" />
                  </div>
                  <h3 className="mb-2 text-base font-semibold">
                    Our Mission
                  </h3>
                  <div className="prose prose-sm max-w-none text-muted-foreground prose-p:mb-2 prose-ul:mb-2">
                    <div dangerouslySetInnerHTML={{ __html: data.mission }} />
                  </div>
                </div>

                {/* Vision */}
                <div className="group rounded-2xl bg-muted p-5 shadow-sm ring-1 ring-border transition hover:-translate-y-1 hover:shadow-md">
                  <div className="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-card shadow-sm">
                    <Eye className="h-5 w-5 text-primary" />
                  </div>
                  <h3 className="mb-2 text-base font-semibold">
                    Our Vision
                  </h3>
                  <div className="prose prose-sm max-w-none text-muted-foreground prose-p:mb-2 prose-ul:mb-2">
                    <div dangerouslySetInnerHTML={{ __html: data.vision }} />
                  </div>
                </div>
              </div>
            </div>

            {/* Founder Section */}
            <div className="mt-12 rounded-3xl bg-muted p-6 ring-1 ring-border md:flex md:items-center md:gap-8 md:p-7 lg:p-8">
              <div className="mx-auto mb-6 flex flex-col items-center md:mb-0 md:items-start">
                <div className="relative">
                  {/* Brand-ish glow using accent/primary tones */}
                  <div className="absolute -inset-1 rounded-full bg-gradient-to-tr from-primary/40 via-accent/40 to-primary/40 blur" />
                  <div className="relative rounded-full bg-card p-1">
                    <img
                      src={`${data.founder_image}`}
                      alt="Founder"
                      className="h-40 w-40 rounded-full object-cover shadow-md md:h-44 md:w-44"
                    />
                  </div>
                </div>
              </div>

              <div className="relative flex-1">
                <div className="mb-3 inline-flex items-center gap-2 rounded-full bg-primary/5 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-muted-foreground">
                  <Quote className="h-3.5 w-3.5 text-primary" />
                  A message from our Founder
                </div>
                <h3 className="mb-3 text-xl font-bold md:text-2xl">
                  A Message from Our Founder
                </h3>
                <div className="prose prose-sm max-w-none text-muted-foreground md:prose-base">
                  <div
                    dangerouslySetInnerHTML={{ __html: data.founder_message }}
                  />
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </AppLayout>
  );
}
