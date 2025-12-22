export default function AboutSection({data}: any) { 
            return  <section id="about" className="bg-white py-20 md:py-28">
                <div className="mx-auto grid max-w-[1320px] items-center gap-12 px-4 md:grid-cols-2 md:px-6">
                    <div className="relative">
                        <img src={data?.about_image} alt="About" className="w-full rounded-md" />
                    </div>
                    <div>
                        <span className="text-sm font-semibold tracking-wider text-primary uppercase">About Us</span>
                        <h2 className="mt-4 mb-6 text-3xl leading-tight font-bold md:text-5xl">
                           {data?.about_heading}
                        </h2>
                        <div className="prose max-w-none text-gray-600" dangerouslySetInnerHTML={{ __html: data?.about_description }}/>
                    </div>
                </div>
            </section>
}