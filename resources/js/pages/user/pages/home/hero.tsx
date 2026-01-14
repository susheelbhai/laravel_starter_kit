import { FaWhatsapp } from "react-icons/fa";

export default function HeroSection(props: any) {
    const appName = props.data?.appData?.name;
    const whatsapp = props.data?.appData?.whatsapp;
    const bannerImage = props.data?.data?.banner_image;
    
    return (
        <section
            id="home"
            className="relative overflow-hidden py-20 text-left md:py-32"
            style={{
                backgroundImage: bannerImage ? `url("${bannerImage}")` : 'none',
                backgroundRepeat: "no-repeat",
                backgroundSize: "cover",
                backgroundPosition: "center",
                backgroundColor: bannerImage ? 'transparent' : '#F5F6FA',
            }}
        >
            <div className="mx-auto grid max-w-[1320px] items-center gap-8 px-4 md:grid-cols-2 md:px-6">
                
                {/* LEFT: CONTENT */}
                <div>
                    <p className="mb-4 font-semibold text-primary">
                        Welcome to {appName}
                    </p>

                    <h1 className="text-4xl leading-tight font-bold md:text-6xl">
                        <div dangerouslySetInnerHTML={{ __html: props.data?.data?.banner_heading }} />
                    </h1>

                    <div className="mt-6 max-w-md text-[#6B7280]">
                        <div dangerouslySetInnerHTML={{ __html: props.data?.data?.banner_description }} />
                    </div>

                    <div className="mt-8 flex space-x-4">
                        <a href={route('product.index')}>
                            <button className="cursor-pointer rounded-md bg-primary px-6 py-3 font-semibold text-white hover:bg-primary/80">
                                See Products
                            </button>
                        </a>
                        <a
                            href={'https://wa.me/' + whatsapp}
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <button className="cursor-pointer rounded-md border border-primary px-6 py-3 font-semibold text-primary hover:bg-primary hover:text-white">
                                <FaWhatsapp className="inline-block mr-2" />
                                Contact Us
                            </button>
                        </a>
                    </div>
                </div>

                {/* RIGHT: EMPTY SPACER */}
                <div className="h-[260px] md:h-[360px]"></div>
            </div>
        </section>
    );
}
