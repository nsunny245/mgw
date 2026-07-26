<?php

namespace App\Helpers;

class SeoContentHelper
{
    /**
     * Get monthly calendar SEO settings and content.
     */
    public static function getForMonth(string $month): ?array
    {
        $month = strtolower($month);
        $data = [
            'january' => [
                'title' => 'January Umrah Packages | Best UK Umrah Deals 2027',
                'description' => 'Discover affordable January Umrah Packages from the UK. Enjoy trusted service, quality hotels and flexible options. Book your Umrah in January today.',
                'h1' => 'January Umrah Packages',
                'intro' => 'Start your new year with a sacred pilgrimage by booking our tailored **January Umrah Packages**. Departing for **Umrah in January** allows pilgrims to experience pleasant winter weather in Makkah and Madinah, making the rituals of Tawaf and Sa\'i comfortable for all ages. We offer a range of **January Umrah Deals**, including **Cheap January Umrah Packages** for budget-conscious travellers, as well as premium **5 Star January Umrah** packages for those seeking luxury. Whether you are searching for **January Umrah Packages UK** or a dedicated **Family Umrah January** package, our agency secures the best flights and accommodation options. Leverage our exclusive **January Umrah Offers** with departures like **January Umrah from London** and tailored **January Umrah Holidays**. As a trusted **UK Umrah Travel Agency**, we ensure your journey is seamless, spiritually fulfilling, and fully supported.',
                'faqs' => [
                    ['q' => 'What is the weather like for Umrah in January?', 'a' => 'January offers pleasant, cool winter weather in Makkah and Madinah, ideal for elderly pilgrims and families.'],
                    ['q' => 'Are there direct flights from London for January Umrah?', 'a' => 'Yes, we arrange packages featuring direct flights from London Heathrow to Jeddah or Madinah.']
                ]
            ],
            'february' => [
                'title' => 'February Umrah Packages 2027 | UK Mid Term Deals',
                'description' => 'Book February Umrah Packages 2027 from the UK. Perfect for February Mid Term holidays with quality hotels, trusted service and flexible departures.',
                'h1' => 'February Umrah Packages',
                'intro' => 'Embark on a spiritually enriching journey with our **February Umrah Packages**. It is the perfect opportunity for a **February Mid Term Umrah**, allowing families and educators to travel during the school breaks. Performing **February Umrah in 2027** offers excellent weather, avoiding the extreme summer heat of Saudi Arabia. We provide comprehensive **February Umrah Packages UK** tailored for school holidays, including the **February Half Term Umrah** and specialized **February School Holiday Umrah** options. Choose from budget-friendly packages to luxurious **5 Star February Umrah** accommodations. Our deals cater to **Family Umrah February** travellers, with easy departures for **Umrah from London** and other major airports. As a premier provider of **UK Umrah Packages**, we deliver **Affordable February Umrah** options to suit every budget.',
                'faqs' => [
                    ['q' => 'Can I book a February Mid Term Umrah package for my family?', 'a' => 'Yes, we specialize in half-term and mid-term school holiday packages with family-friendly hotel rooms.'],
                    ['q' => 'Is transport included in February Umrah packages?', 'a' => 'Yes, ground transport between Makkah, Madinah, and the airport is fully included in our packages.']
                ]
            ],
            'march' => [
                'title' => 'March Umrah Packages | 5 Star Family Umrah Deals',
                'description' => 'Explore March Umrah Packages from the UK with 5-star hotels, family-friendly options and trusted service. Secure the best March Umrah Deals today.',
                'h1' => 'March Umrah Packages',
                'intro' => 'Prepare for your spiritual journey with our custom **March Umrah Packages**. Performing your rituals under mild spring weather makes this month one of the best times of the year. Our curated list features **March Umrah Deals** tailored for diverse pilgrim needs, including **5 Star Family March Umrah** offers and standard **March Umrah Packages UK**. Families can travel comfortably with our dedicated **Family Umrah March** layouts, featuring close-to-Haram hotels and child-friendly arrangements. If you prefer high-end experiences, our **Luxury March Umrah** and **5 Star Umrah Packages** offer premium comfort. With easy departures like **March Umrah from London**, these **Custom March Umrah Packages** deliver an **Affordable March Umrah** experience, fully supported by our recognized **UK Umrah Travel Agency** team.',
                'faqs' => [
                    ['q' => 'What is included in a 5 Star March Umrah package?', 'a' => 'Our 5-star packages feature premium hotels close to the Haram, direct flight departures, and luxury private transfers.'],
                    ['q' => 'Can I customize my March Umrah itinerary?', 'a' => 'Yes, we offer custom packages where you can choose hotels, duration, and cities according to your family needs.']
                ]
            ],
            'april' => [
                'title' => 'April Umrah Packages 2027 | Best UK Umrah Deals',
                'description' => 'Book April Umrah Packages 2027 from the UK with trusted service, quality hotels and flexible itineraries. Discover the best April Umrah Deals today.',
                'h1' => 'April Umrah Packages 2027',
                'intro' => 'Secure your sacred trip with our premier **April Umrah Packages 2027**. This month offers a beautiful atmosphere for worship. Our team provides the most reliable **Umrah Packages April** with exclusive access to top-rated hotels and reliable flights. Browse our **April Umrah Deals** and discover competitive **April Umrah Packages UK** options. Designed for peace of mind, we cater to **Family April Umrah** travellers, offering premium **5 Star April Umrah** and **Affordable April Umrah Packages**. For high-end comfort, explore our **Luxury Umrah Packages UK** with easy departures like **April Umrah 2027** and **Umrah from London**. These **Custom April Umrah Packages** can be tailored to fit your specific duration, family size, and star preference.',
                'faqs' => [
                    ['q' => 'Is Easter school holiday covered in April Umrah packages?', 'a' => 'Yes, we have specialized packages aligning with the UK Easter school holidays for families.'],
                    ['q' => 'What is the benefit of performing Umrah in April?', 'a' => 'April provides mild spring weather, which is cooler compared to the intense summer months.']
                ]
            ],
            'may' => [
                'title' => 'May Umrah Packages 2027 | Trusted UK Umrah Deals',
                'description' => 'Book May Umrah Packages 2027 from the UK with trusted service, quality hotels and flexible options. Secure your Umrah in May at the best value.',
                'h1' => 'May Umrah Packages',
                'intro' => 'Perform your pilgrimage with our custom **May Umrah Packages**. As the season transitions, May offers quieter spaces in the Harams, giving you peace for your prayers. We offer competitive **Umrah Packages May 2027** options for both individuals and groups. By planning your **Umrah in May**, you can take advantage of our handpicked **May Umrah Packages UK** and the best **May Umrah Deals**. Choose from comfortable budget options to prestigious **5 Star May Umrah** packages. We support **Family Umrah May** bookings and **Luxury May Umrah Packages** with departures such as **Umrah from London**. Our **Affordable May Umrah** packages and **Custom Umrah Packages UK** are designed to give you value and spiritual comfort.',
                'faqs' => [
                    ['q' => 'What type of flights are available for May Umrah?', 'a' => 'We offer both direct flights to Jeddah/Madinah and connection flights through top airlines like Emirates or Qatar Airways.'],
                    ['q' => 'Are hotels in May close to the Haram?', 'a' => 'Yes, we offer a range of hotels from 3-star to 5-star located within short walking distance of the Haram.']
                ]
            ],
            'june' => [
                'title' => 'June Umrah Packages UK 2027 | Best Umrah Deals',
                'description' => 'Explore June Umrah Packages UK 2027 with trusted service, quality hotels and flexible departures. Book the best June 2027 Umrah Deals from the UK.',
                'h1' => 'June Umrah Packages UK 2027',
                'intro' => 'Plan your summer pilgrimage with our trusted **June Umrah Packages UK 2027**. Entering the summer season, we secure air-conditioned luxury accommodation and seamless transit so you can focus entirely on worship. Check out the best **June 2027 Umrah Deals from UK** and **UK Umrah Packages June 2027** to secure your seats. We offer various **June Umrah Packages** and flexible **June Umrah Deals** designed to fit holiday schedules. From group travel to specialized **Family Umrah June** plans, we have choices ranging from **Affordable June Umrah** to premium **5 Star June Umrah Packages**. For high-end requirements, choose our **Luxury Umrah Packages UK** with departures like **Umrah from London** and tailored **Custom June Umrah Packages**.',
                'faqs' => [
                    ['q' => 'How hot is it for June Umrah?', 'a' => 'June is hot in Saudi Arabia. We recommend performing Tawaf in the early morning or evening and staying hydrated.'],
                    ['q' => 'Are packages customizable for groups in June?', 'a' => 'Yes, we can customize June group packages with private transport and adjacent hotel rooms.']
                ]
            ],
            'july' => [
                'title' => 'July Umrah Packages UK 2027 | Trusted Umrah Deals',
                'description' => 'Book July Umrah Packages UK 2027 with trusted service, premium hotels and flexible departures. Discover the best July 2027 Umrah Deals from the UK.',
                'h1' => 'July Umrah Packages',
                'intro' => 'Perform your summer pilgrimage with our **July Umrah Packages**. Ideal for school holiday breaks, we provide fully-managed travels for families. Secure your seats for **July 2027 Umrah Deals from UK** and **UK Umrah Packages July 2027** today. We offer specialized **July Umrah Packages** and the most competitive **July Umrah Deals** for the season. Our **Summer Umrah Packages UK** feature family-focused amenities and direct flights. Choose from **Affordable July Umrah** packages to our luxury **5 Star July Umrah Packages**. All packages, including our **Family Umrah July** packages and **Luxury Umrah Packages UK** with departures like **Umrah from London**, include premium hotel options and reliable ground transport.',
                'faqs' => [
                    ['q' => 'Is July a good time for family Umrah?', 'a' => 'Yes, the July summer break is the most popular time for families with school-going children to travel together.'],
                    ['q' => 'Are visa fees included in the July packages?', 'a' => 'Yes, all our package prices include the tourist/Umrah visa processing fees and mandatory health insurance.']
                ]
            ],
            'august' => [
                'title' => 'August Umrah Packages 2026 | Best UK Holiday Deals',
                'description' => 'Book August Umrah Packages 2026 from the UK with premium hotels, trusted service and flexible departures. Explore the best August Holidays Umrah Deals.',
                'h1' => 'August Umrah Packages 2026',
                'intro' => 'Make the most of the summer break with our premium **August Umrah Packages 2026**. This is a highly requested period for families. We offer a comprehensive list of **August Umrah Packages** and the best **August Holidays Umrah Deals** in the industry. Our **August Umrah Packages UK** and **Summer Umrah Packages** feature quality hotels with close proximity to the Haram. Perfect for families, our **Family August Umrah** and **August School Holiday Umrah** deals ensure comfortable, hassle-free travel. Choose from our cost-effective **Affordable August Umrah** options or our luxury **5 Star August Umrah Packages** and **Luxury Umrah Packages UK** with flights like **Umrah from London**.',
                'faqs' => [
                    ['q' => 'When should I book August Umrah packages?', 'a' => 'Due to high demand during summer school holidays, we recommend booking August packages at least 2-3 months in advance.'],
                    ['q' => 'Is guidance provided for first-time pilgrims in August?', 'a' => 'Yes, we provide pre-departure webinars and detailed guides to help you perform your Umrah correctly.']
                ]
            ],
            'september' => [
                'title' => 'September Umrah Packages | Best UK Umrah Deals 2026',
                'description' => 'Book September Umrah Packages from the UK with premium hotels, trusted service and flexible departures. Secure your September 2026 Umrah Package today.',
                'h1' => 'September Umrah Packages',
                'intro' => 'Travel during the pleasant autumn transition with our custom **September Umrah Packages**. As summer fades, crowd sizes reduce, allowing for a peaceful experience. We offer various **Umrah Packages September 2026** and **September 2026 Umrah Packages** to match your preferences. Our **September Umrah Packages UK** feature top-tier flight connections and high-quality hotel stays. Secure the best **September Umrah Deals** for groups or families. We support **Family September Umrah** travels and premium **5 Star September Umrah Packages**. Choose from our **Affordable September Umrah** rates, **Luxury Umrah Packages UK**, or customized **Custom September Umrah Packages** with easy departures like **Umrah from London**.',
                'faqs' => [
                    ['q' => 'What is the advantage of traveling for Umrah in September?', 'a' => 'September benefits from fewer crowds compared to the summer and winter holidays, offering a peaceful environment at the Haram.'],
                    ['q' => 'Are ziaraats (guided tours) included in September packages?', 'a' => 'Yes, our packages include guided historical tours to key Islamic sites in both Makkah and Madinah.']
                ]
            ],
            'october' => [
                'title' => 'October Umrah Packages | Affordable UK Deals 2026',
                'description' => 'Discover October Umrah Packages from the UK with trusted service, quality hotels and flexible departures. Book affordable October Umrah Deals today.',
                'h1' => 'October Umrah Packages',
                'intro' => 'Plan your autumn spiritual journey with our reliable **October Umrah Packages**. October is an excellent month to perform Umrah as temperatures become very comfortable. We offer tailored **Umrah Packages October 2026** and **Cheap October Umrah Packages 2026** options. Take advantage of our **October Umrah Packages UK** and the best **October Umrah Deals** on the market. Families can travel easily during the school half-term with our **Family October Umrah Packages**. Choose from **Affordable October Umrah** options, premium **5 Star October Umrah** packages, or high-end **Luxury Umrah Packages UK** with departures like **Umrah from London** and tailored **Custom October Umrah Packages**.',
                'faqs' => [
                    ['q' => 'Is October weather good for children and the elderly?', 'a' => 'Yes, October offers very pleasant autumn weather, making it highly recommended for children and elderly pilgrims.'],
                    ['q' => 'Do you arrange October Umrah packages from airports other than London?', 'a' => 'Yes, we offer packages departing from Manchester, Birmingham, and other major UK airports.']
                ]
            ],
            'november' => [
                'title' => 'November Umrah Packages | Best UK Deals for 2026',
                'description' => 'Book November Umrah Packages from the UK with trusted service, premium hotels and flexible departures. Secure your November 2026 Umrah Package today.',
                'h1' => 'November Umrah Packages',
                'intro' => 'Experience the cool winter breezes of Makkah and Madinah with our **November Umrah Packages**. November is a highly recommended month for pilgrims seeking pleasant weather. We offer customized **Umrah Packages November 2026** and **Umrah Package 2026 November** options. Compare our **November Umrah Packages UK** and secure the best **November Umrah Deals** available. Our team specializes in **Family November Umrah** packages and premium **5 Star November Umrah Packages**. Choose from **Luxury November Umrah** setups, **Affordable November Umrah Packages**, or **Custom November Umrah Packages** with departures like **Umrah from London**.',
                'faqs' => [
                    ['q' => 'What is the temperature in Madinah during November?', 'a' => 'Madinah gets pleasantly cool in November, with daytime temperatures around 25°C and cooler evenings.'],
                    ['q' => 'Can I book a November package with a group?', 'a' => 'Yes, we run several guided group tours in November which are ideal for solo travellers or families.']
                ]
            ],
            'december' => [
                'title' => 'December Umrah Packages From UK | Makkah Gateway',
                'description' => 'Book December Umrah Packages from the UK with premium hotels, trusted service and flexible departures. Explore affordable December Umrah Deals today.',
                'h1' => 'December Umrah Packages',
                'intro' => 'Perform your pilgrimage during the winter holiday season with our popular **December Umrah Packages**. The December winter break is the ideal time for families to travel. We offer high-demand **Umrah Packages December 2026** and **Cheap December Umrah Packages 2026** options. Compare our **December Umrah Packages UK** and book exclusive **December Umrah Deals**. Leverage the school holidays with our **Christmas Holiday Umrah Packages** and **School Holiday Umrah December** deals. We support **Family December Umrah** groups and luxury **5 Star December Umrah Packages**. Choose from **Affordable December Umrah** packages with departures like **Umrah from London**.',
                'faqs' => [
                    ['q' => 'Is December Umrah crowded?', 'a' => 'Yes, December is a busy month due to global winter holidays. We recommend booking early to secure the best hotels close to the Haram.'],
                    ['q' => 'Are flights more expensive in December?', 'a' => 'Flight prices tend to rise closer to the Christmas holidays. Booking 3-4 months in advance secures the best flight deals.']
                ]
            ],
        ];

        return $data[$month] ?? null;
    }

    /**
     * Get category SEO settings and content.
     */
    public static function getForCategory(string $slug): ?array
    {
        $slug = strtolower($slug);
        $data = [
            'easter-umrah-packages' => [
                'title' => 'Easter Umrah Packages | Best UK Holiday Deals',
                'description' => 'Book Easter Umrah Packages from the UK with premium hotels, trusted service and flexible departures. Secure your Easter Holidays Umrah Package today.',
                'h1' => 'Easter Umrah Packages',
                'intro' => 'Spend your spring holidays in the holy sanctuaries with our specialized **Easter Umrah Packages**. The Easter school break provides the perfect window for families to perform pilgrimage together. We offer dedicated **Easter Holidays Umrah Packages** and flexible plans for **Umrah in Easter Holidays**. Our custom **Easter Umrah Packages UK** feature family-sized hotel suites and direct flights. Perfect for school breaks, our **Easter School Holiday Umrah** and **Family Easter Umrah** deals keep your travel stress-free. Choose from luxury **5 Star Easter Umrah Packages**, premium **Luxury Easter Umrah** suites, or budget-friendly **Affordable Easter Umrah Packages** with departures such as **Umrah from London**. Trust our recognized **UK Umrah Travel Agency** to manage every detail of your journey.',
                'faqs' => [
                    ['q' => 'When do Easter Umrah packages depart?', 'a' => 'Our Easter packages are scheduled to align exactly with the UK school holiday dates in March and April.'],
                    ['q' => 'Are visa applications handled by your agency?', 'a' => 'Yes, we handle the complete visa processing, flight booking, and hotel reservations.']
                ]
            ],
            'ramadan-umrah' => [
                'title' => 'Ramadan Umrah Packages 2027 | Best UK Ramadan Deals',
                'description' => 'Book Ramadan Umrah Packages 2027 from the UK. Choose 1st Ashrah, Last Ashrah or Group Ramadan Umrah with premium hotels and trusted service.',
                'h1' => 'Ramadan Umrah Packages 2027',
                'intro' => 'Earn the immense rewards of performing pilgrimage during the holy month with our premium **Ramadan Umrah Packages 2027**. Performing Umrah in Ramadan is equivalent to Hajj in reward. We offer a wide range of **Ramadan Umrah Packages** structured around your schedule, including **1st Ashrah Ramadan Umrah**, mid-Ramadan, and the highly sought-after **Last Ashrah Ramadan Umrah** which includes Laylatul Qadr. Join our fully guided **Group Ramadan Umrah** or book a custom package. We provide tailored **Ramadan Umrah Packages UK** with top-rated hotels and direct flights. Whether you are booking a **Family Ramadan Umrah**, luxury **5 Star Ramadan Umrah Packages**, or premium **Luxury Ramadan Umrah**, we secure the best arrangements with convenient departures like **Ramadan Umrah from London** and exclusive **Ramadan Umrah Deals 2027**.',
                'faqs' => [
                    ['q' => 'Is Umrah in the last 10 days of Ramadan crowded?', 'a' => 'Yes, the last 10 days of Ramadan (Last Ashrah) are extremely popular. We recommend booking months in advance to secure Haram-view hotels.'],
                    ['q' => 'Is suhoor and iftar provided at the hotels?', 'a' => 'Many of our premium packages include suhoor and iftar buffets directly at the hotel restaurants.']
                ]
            ],
            'group-umrah-packages' => [
                'title' => 'Group Umrah Packages | Affordable UK Group Deals',
                'description' => 'Explore Group Umrah Packages from the UK with trusted guides, quality hotels and affordable prices. Book Family Group Umrah Packages for 2027 today.',
                'h1' => 'Group Umrah Packages',
                'intro' => 'Travel with peace of mind alongside fellow pilgrims with our **Group Umrah Packages**. Travelling in a group is highly recommended for safety, companionship, and sharing spiritual moments. We specialize in **Family Group Umrah Packages** and budget-friendly **Cheap Group Umrah Packages 2027** configurations. Our **Group Umrah Packages UK** are designed to include experienced guides who assist you with all the Umrah rituals. Browse our **Group Umrah Deals** and find competitive options for **Family Umrah Packages**. From luxury **5 Star Group Umrah** plans to **Affordable Group Umrah** setups, we cover all needs. Enjoy fully **Guided Group Umrah Tours** with departures like **Umrah from London**, backed by our leading **UK Umrah Travel Agency** team.',
                'faqs' => [
                    ['q' => 'What are the benefits of a guided group Umrah?', 'a' => 'Guided groups include an experienced religious leader (Imam) who guides you through the rituals, answers questions, and leads daily prayers and tours.'],
                    ['q' => 'Can solo female travellers join group packages?', 'a' => 'Yes, our guided group tours are highly popular and safe for solo female travellers looking for a supportive group community.']
                ]
            ],
            'cheap-umrah' => [
                'title' => 'Cheap Umrah Packages | Affordable Family Deals UK',
                'description' => 'Discover Cheap Umrah Packages from the UK with trusted service, quality hotels and flexible options. Find Family Umrah Packages for your 2026 journey today.',
                'h1' => 'Cheap Umrah Packages',
                'intro' => 'Perform your sacred journey without financial strain using our **Cheap Umrah Packages**. We believe that every Muslim should have the chance to visit the holy Harams. Our customizable **Family Umrah Packages** and special **Umrah Package 2026** deals focus on essential comforts while keeping costs low. Compare our **Cheap Umrah Packages UK** and discover value-packed **Affordable Umrah Packages** and **Budget Umrah Packages**. For those who want to mix economy and luxury, we also provide options that combine **5 Star Umrah Packages** or **Luxury Umrah Packages** with budget-friendly flights. Choose from direct **Umrah Packages from London** departures or customized **Custom Umrah Packages** with our trusted **UK Umrah Travel Agency** support.',
                'faqs' => [
                    ['q' => 'How do you keep package costs cheap?', 'a' => 'We maintain direct partnerships with hotels and airlines, allowing us to pass bulk discounts directly to our pilgrims without compromising quality.'],
                    ['q' => 'Are cheap packages fully licensed and protected?', 'a' => 'Yes, all our cheap packages are fully licensed, protected, and include 24/7 UK customer support during your stay.']
                ]
            ],
            '3-star-umrah' => [
                'title' => '3 Star Umrah Packages | Affordable Family Deals UK',
                'description' => 'Book 3 Star Umrah Packages from the UK with comfortable hotels, trusted service and great value. Explore Family Umrah Packages at affordable prices today.',
                'h1' => '3 Star Umrah Packages',
                'intro' => 'Book a comfortable and value-focused journey with our **3 Star Umrah Packages**. These deals are ideal for pilgrims seeking clean, close, and affordable accommodation. Check out our **Family 3 Star Umrah Deals** and standard **Family Umrah Packages** that keep your group comfortable. Our **Budget Umrah Packages** and **3 Star Umrah Packages UK** feature hotels located within short walking distance or with free shuttle services to the Haram. Choose our **Affordable Umrah Packages** or **Budget Family Umrah** layouts to manage your expenses. We arrange convenient **Umrah Packages from London** departures, including **Cheap 3 Star Umrah** deals and **Custom Umrah Packages** backed by our premier **UK Umrah Travel Agency** team.',
                'faqs' => [
                    ['q' => 'Do 3-star hotels provide shuttle services to the Haram?', 'a' => 'Yes, most of our 3-star hotels that are situated slightly further away provide free 24/7 shuttle buses running directly to the Haram courtyards.'],
                    ['q' => 'Is breakfast included in 3-star packages?', 'a' => 'Yes, many of our 3-star packages include complimentary continental breakfast at the hotel.']
                ]
            ],
            '4-star-umrah' => [
                'title' => '4 Star Umrah Packages | Premium UK Holiday Deals',
                'description' => 'Discover 4 Star Umrah Packages from the UK with quality hotels, trusted service and flexible departures. Explore Silver Umrah Packages and book today.',
                'h1' => '4 Star Umrah Packages',
                'intro' => 'Experience a perfect balance of comfort and value with our premium **4 Star Umrah Packages**. Our packages feature handpicked hotels that offer premium amenities and excellent service. Discover our **Silver Umrah Packages** and flexible **Holidays Umrah Packages** designed for demanding travellers. We offer comprehensive **4 Star Umrah Packages UK** and dedicated **Family 4 Star Umrah Packages**. If you want comfort without paying 5-star prices, our **Luxury Umrah Packages** and **Affordable 4 Star Umrah** options are the perfect match. Enjoy customized **Umrah Holidays from UK** and direct **Umrah Packages from London** departures, featuring **Premium Umrah Deals** fully supported by our **UK Umrah Travel Agency**.',
                'faqs' => [
                    ['q' => 'What makes a 4 Star Umrah package a "Silver" choice?', 'a' => 'Our Silver 4-star packages feature modern hotels with great room service, closer Haram locations (usually 150-300 meters), and upgraded private transfers.'],
                    ['q' => 'Are family rooms available in 4-star hotels?', 'a' => 'Yes, we offer quad, triple, and double room options suited for families traveling together.']
                ]
            ],
            '5-star-umrah' => [
                'title' => '5 Star Umrah Packages | Luxury UK Umrah Deals',
                'description' => 'Experience 5 Star Umrah Packages from the UK with luxury hotels, premium service and flexible departures. Discover Gold Umrah Packages and book today.',
                'h1' => '5 Star Umrah Packages',
                'intro' => 'Embark on a premium pilgrimage of absolute comfort with our luxury **5 Star Umrah Packages**. We understand that some pilgrims require top-tier comfort, exceptional hotels right on the Haram courtyards, and first-class services. Explore our **Premium Umrah Packages** and exclusive **Gold Umrah Packages** for an unmatched experience. We offer the ultimate **Luxury Umrah Package** and **5 Star Umrah Packages UK** configurations, including elite **Luxury Umrah Packages** and fully-managed **VIP Umrah Packages**. Perfect for families, our **Family 5 Star Umrah** setups feature close hotel rooms, executive club lounges, and direct views of the Kaaba. Enjoy easy departures with our **Umrah Packages from London** and tailored **Premium Umrah Deals** backed by our recognized **UK Umrah Travel Agency**.',
                'faqs' => [
                    ['q' => 'Which hotels are used in the 5 Star Gold packages?', 'a' => 'We partner with world-class hotels like the Pullman ZamZam, Swissôtel Makkah, Fairmont Makkah Clock Royal Tower, and Hilton Suites.'],
                    ['q' => 'Do the 5-star hotels have direct Haram views?', 'a' => 'Yes, we can book specific Haram-view or Kaaba-view rooms upon request in our Gold and VIP packages.']
                ]
            ],
        ];

        return $data[$slug] ?? null;
    }

    /**
     * Get city SEO settings and content.
     */
    public static function getForCity(string $slug): ?array
    {
        $slug = strtolower($slug);
        $data = [
            'london' => [
                'title' => 'London Umrah Packages | Trusted UK Umrah Deals',
                'description' => 'Book London Umrah Packages with trusted service, premium hotels and flexible departures. Explore Umrah Packages From London and travel with confidence.',
                'h1' => 'London Umrah Packages',
                'intro' => 'Start your spiritual journey directly from the capital with our customized **London Umrah Packages**. We offer the most competitive and reliable **Umrah Packages From London**, featuring direct flights from London Heathrow (LHR) to Jeddah or Madinah. Compare our premium **Umrah From UK** options and secure exclusive **London Umrah Deals**. We provide comprehensive **UK Umrah Packages** designed for families, including **Family Umrah Packages London** and premium **5 Star Umrah Packages London**. If you are travelling on a budget, browse our **Cheap Umrah Packages London** rates. Backed by our recognized **UK Umrah Travel Agency**, we guarantee luxury comfort via **Luxury Umrah Packages UK** and **Direct Umrah Flights from London**.',
                'faqs' => [
                    ['q' => 'Which airlines operate direct Umrah flights from London?', 'a' => 'Saudia and British Airways operate direct flights from London Heathrow (LHR) to Jeddah (JED) and Madinah (MED).'],
                    ['q' => 'Is transport between the airport and hotels included?', 'a' => 'Yes, all our London packages include private air-conditioned transport from the airport straight to your hotels.']
                ]
            ],
            'manchester' => [
                'title' => 'Manchester Umrah Packages | Makkah Gateway UK',
                'description' => 'Book Manchester Umrah Packages with trusted service, premium hotels and flexible departures. Explore Umrah Packages From Manchester and travel with confidence.',
                'h1' => 'Manchester Umrah Packages',
                'intro' => 'Embark on your sacred pilgrimage from the North of England with our tailored **Manchester Umrah Packages**. We make travel simple by arranging direct and connection flights from Manchester Airport (MAN). Discover the best **Umrah Packages From Manchester** and compare premium **Umrah From United Kingdom** options. We offer exclusive **Manchester Umrah Deals** and **Manchester Umrah Packages UK** that cater to all group sizes. Choose from our **Family Umrah Packages Manchester** and **5 Star Umrah Packages Manchester** for premium hotel stays. For budget travellers, we secure **Cheap Umrah Packages Manchester** deals. Supported by our leading **UK Umrah Travel Agency**, our packages feature premium **Luxury Umrah Packages UK** and convenient **Direct Umrah Flights from Manchester** departures.',
                'faqs' => [
                    ['q' => 'Are there direct flights from Manchester to Saudi Arabia?', 'a' => 'Yes, Saudia operates direct flights from Manchester (MAN) to Jeddah (JED) during the Umrah season.'],
                    ['q' => 'Can we customize our travel dates from Manchester?', 'a' => 'Yes, we offer flexible departure dates so you can choose when to fly according to your family schedule.']
                ]
            ],
            'birmingham' => [
                'title' => 'Birmingham Umrah Packages | Trusted UK Umrah Deals',
                'description' => 'Book trusted Birmingham Umrah Packages with premium hotels, family-friendly options and expert UK support. Secure your ideal Umrah journey today.',
                'h1' => 'Birmingham Umrah Packages',
                'intro' => 'Begin your spiritual pilgrimage from the Midlands with our customized **Birmingham Umrah Packages**. We offer premium flight options departing from Birmingham Airport (BHX) to Jeddah and Madinah. Our **Umrah Packages From Birmingham** provide comfortable journeys, including robust **Family Umrah Packages** and tailored **Birmingham to Umrah** schedules. Check out our **UK Umrah Packages** and find the best **Cheap Umrah Packages Birmingham** deals. We offer luxury configurations, including **5 Star Umrah Packages** and **Luxury Umrah Packages** featuring close-to-Haram hotels. All of our bookings are **ATOL Protected Umrah Packages**, ensuring your investment is safe. Book your **Umrah Holidays from Birmingham** and take advantage of our exclusive **Birmingham Family Umrah Deals**.',
                'faqs' => [
                    ['q' => 'What airlines fly from Birmingham for Umrah?', 'a' => 'Airlines like Emirates, Qatar Airways, Saudia, and Turkish Airlines offer convenient flight options from Birmingham Airport (BHX) with short connection stops.'],
                    ['q' => 'Are your Birmingham packages ATOL protected?', 'a' => 'Yes, all packages including flights are fully ATOL protected (ATOL #12435) for your complete financial security.']
                ]
            ],
            'bradford' => [
                'title' => 'Bradford Umrah Packages | Trusted UK Umrah Deals',
                'description' => 'Explore trusted Bradford Umrah Packages with family-friendly options, quality hotels and expert UK support. Reserve your perfect Umrah package today.',
                'h1' => 'Bradford Umrah Packages',
                'intro' => 'Embark on your holy journey with our reliable **Bradford Umrah Packages**. We support pilgrims in Bradford and West Yorkshire with premium services, custom flights, and handpicked hotels. Compare our **Umrah Packages From Bradford** and secure the best **Bradford Umrah Deals** for the season. Our packages are designed around **Family Umrah Packages Bradford** requirements, offering great values on **UK Umrah Packages**. We offer both **Cheap Umrah Packages Bradford** and luxury **5 Star Umrah Packages** or **Luxury Umrah Packages**. As an industry-leading agency, we supply fully **ATOL Protected Umrah Packages** and customized **Umrah Holidays From Bradford** options, backed by our **Custom Umrah Packages UK** services.',
                'faqs' => [
                    ['q' => 'Do you provide local support for pilgrims from Bradford?', 'a' => 'Yes, our team provides full pre-departure guides, local consultation, and 24/7 remote assistance during your entire stay in Saudi Arabia.'],
                    ['q' => 'Which airport do Bradford pilgrims usually depart from?', 'a' => 'Pilgrims from Bradford typically depart from Leeds Bradford Airport (LBA) or Manchester Airport (MAN) for more flight options.']
                ]
            ],
        ];

        return $data[$slug] ?? null;
    }
}
