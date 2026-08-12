<?php

namespace App\Helpers;

class FaqHelper
{
    public static function getQuestions()
    {
        return [
            // Section 1: Umrah & Visa Requirements (1 to 15)
            [
                'id' => 1,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'What is Umrah and how is it different from Hajj?',
                'answer' => 'Umrah is a voluntary Islamic pilgrimage to Makkah that can be performed at any time of the year. Unlike Hajj, which has fixed dates, Umrah offers flexibility for Muslims travelling from the United Kingdom.'
            ],
            [
                'id' => 2,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'Do UK citizens need a visa for Umrah?',
                'answer' => 'Yes, citizens of the United Kingdom require a visa to perform Umrah in Saudi Arabia. Most British passport holders can apply for either an Umrah visa or a Saudi tourist eVisa.'
            ],
            [
                'id' => 3,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'What type of visa is required for Umrah from the UK?',
                'answer' => "UK travellers can perform Umrah using:\n- Umrah visa\n- Tourist eVisa\n- E-Waiver Visa\n\nAll visa options allow travel to Makkah and Madinah (outside Hajj season)."
            ],
            [
                'id' => 4,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'What is the difference between an Umrah visa and a tourist visa?',
                'answer' => "• Umrah visa: Issued specifically for pilgrimage via authorised agents.\n• Tourist eVisa: More flexible, allows tourism and Umrah (except during Hajj season).\n\nMany UK travellers prefer the eVisa due to its faster and simpler process."
            ],
            [
                'id' => 5,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'Can British passport holders apply for a Saudi eVisa?',
                'answer' => 'Yes, British passport holders are eligible for the Saudi tourist eVisa, which is typically issued quickly and allows Umrah travel outside the Hajj season.'
            ],
            [
                'id' => 6,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'Can non-British residents in the UK apply for an Umrah visa?',
                'answer' => 'Yes, non-British residents living in the United Kingdom can apply if they have a valid UK residency and a passport from an eligible country. Approval is subject to Saudi Arabia immigration rules.'
            ],
            [
                'id' => 7,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'Can UK travel document holders apply for an Umrah visa?',
                'answer' => 'Travel document holders (such as refugee or stateless documents) may be eligible, but applications are assessed on a case-by-case basis. It is best to consult a specialist Umrah agency before booking.'
            ],
            [
                'id' => 8,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'What documents are required for an Umrah visa from the UK?',
                'answer' => "Typical requirements include:\n- Valid passport (minimum 6 months validity)\n- UK residence permit (for non-British nationals)\n- Passport-size photographs\n- Confirmed flight and hotel bookings"
            ],
            [
                'id' => 9,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'How long does it take to get an Umrah visa?',
                'answer' => "• Tourist eVisa: issued within 24–72 hours.\n• Umrah visa (via agent): Usually takes a few days.\n\nProcessing times may vary."
            ],
            [
                'id' => 10,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'How long is an Umrah visa valid for?',
                'answer' => "• Tourist eVisa: Valid for up to 1 year (multiple entry, max 90 days stay).\n• Umrah visa: Short-term, fixed travel duration."
            ],
            [
                'id' => 11,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'Can I perform Umrah on a tourist or visit visa?',
                'answer' => 'Yes, Umrah can generally be performed on a valid Saudi tourist visa, provided it is outside the Hajj season and complies with current regulations.'
            ],
            [
                'id' => 12,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'Do children need a visa for Umrah?',
                'answer' => 'Yes, all travellers including children must have a valid visa to enter Saudi Arabia.'
            ],
            [
                'id' => 13,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'Is vaccination required for Umrah from the UK?',
                'answer' => 'Vaccination requirements depend on guidelines set by the Saudi Ministry of Health. Travelers should check the latest updates before departure.'
            ],
            [
                'id' => 14,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'What happens if my Umrah visa is rejected?',
                'answer' => 'If your visa is rejected, you may reapply, explore alternative visa options (such as eVisa), and your travel agent can assist with the process.'
            ],
            [
                'id' => 15,
                'category' => 'Umrah & Visa Requirements',
                'question' => 'Can I extend my Umrah visa while in Saudi Arabia?',
                'answer' => 'Tourist visas may sometimes be extendable, but Umrah visas are usually not extendable.'
            ],

            // Section 2: Umrah Packages from the UK (16 to 25)
            [
                'id' => 16,
                'category' => 'Umrah Packages from the UK',
                'question' => 'Do you offer Umrah packages from the UK?',
                'answer' => 'Yes, we provide Umrah packages from the UK with departures from London Heathrow, Manchester, Birmingham, and Glasgow.'
            ],
            [
                'id' => 17,
                'category' => 'Umrah Packages from the UK',
                'question' => 'What types of Umrah packages do you offer?',
                'answer' => "We offer a range of Umrah packages UK, including:\n- Cheap Umrah packages\n- 3-star, 4-star, and 5-star packages\n- Luxury Umrah packages (Haram view hotels)\n- Family and group packages"
            ],
            [
                'id' => 18,
                'category' => 'Umrah Packages from the UK',
                'question' => 'Do your Umrah packages include flights and transport?',
                'answer' => "Yes, most packages include:\n- Return flights from the UK\n- Airport transfers in Saudi Arabia\n- Transport between Makkah and Madinah"
            ],
            [
                'id' => 19,
                'category' => 'Umrah Packages from the UK',
                'question' => 'Can I customize my Umrah package?',
                'answer' => 'Yes, we offer tailor-made Umrah packages UK, allowing you to choose your travel dates, hotels, flights, and duration.'
            ],
            [
                'id' => 20,
                'category' => 'Umrah Packages from the UK',
                'question' => 'Are your Umrah packages suitable for families and groups?',
                'answer' => "Yes, we provide:\n- Family-friendly Umrah packages\n- Group Umrah packages with guided support\n- Flexible travel during school holidays"
            ],
            [
                'id' => 21,
                'category' => 'Umrah Packages from the UK',
                'question' => 'When is the best time to book Umrah from the UK?',
                'answer' => 'It is recommended to book 2–3 months in advance for best prices, and earlier for peak periods like Ramadan.'
            ],
            [
                'id' => 22,
                'category' => 'Umrah Packages from the UK',
                'question' => 'Do you offer Ramadan Umrah packages?',
                'answer' => 'Yes, we offer Ramadan Umrah packages UK, which are in high demand. Early booking is essential.'
            ],
            [
                'id' => 23,
                'category' => 'Umrah Packages from the UK',
                'question' => 'Are your Umrah packages ATOL protected?',
                'answer' => 'Yes, where applicable, our packages are ATOL protected, providing financial protection for UK travellers.'
            ],
            [
                'id' => 24,
                'category' => 'Umrah Packages from the UK',
                'question' => 'Do you offer flexible payment plans?',
                'answer' => 'Yes, we offer flexible payment options to make Umrah more affordable.'
            ],
            [
                'id' => 25,
                'category' => 'Umrah Packages from the UK',
                'question' => 'Why choose MakkahGateway.co.uk for Umrah packages?',
                'answer' => "• Competitive Umrah deals UK\n• Trusted UK-based service\n• Customized packages\n• Experienced support team\n• 24/7 customer assistance"
            ],
        ];
    }
}
