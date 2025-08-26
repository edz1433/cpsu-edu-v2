@extends('web.layouts.mainlayout')
@section('content')
<style>


    .history-container {
    background: #fdfaf3;
    font-family: 'Georgia', serif;
    padding: 50px 40px;
    color: #3b2f2f;
    max-width: 900px;
    margin: auto;
    margin-bottom: 80px; /* ⬅ extra space before footer */
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border: 1px solid #e0d9c5;
    position: relative;
    background-image: radial-gradient(circle at center, #fdfaf3, #f8f5e4);
    overflow: hidden;
}

    .history-logos {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px; /* space between logos */
    margin: 20px 0;
    flex-wrap: wrap; /* allows wrapping on small screens */
}

.history-logos img {
    max-height: 80px;
    width: auto;
    transition: transform 0.3s ease;
}

.history-logos img:hover {
    transform: scale(1.1);
}

    .history-text img.left {
    float: left;
    margin: 5px 20px 10px 0;
    max-width: 30%;
    }
.history-text img.right {
    float: right;
    margin: 5px 0 10px 20px;
    max-width: 30%;
   
}


    /* Decorative corners */
    .history-container::before,
    .history-container::after {
        content: '';
        position: absolute;
        width: 40px;
        height: 40px;
        border: 2px solid #a08a5c;
        z-index: 2;
    }
    .history-container::before {
        top: 15px;
        left: 15px;
        border-right: none;
        border-bottom: none;
    }
    .history-container::after {
        bottom: 15px;
        right: 15px;
        border-left: none;
        border-top: none;
    }

    /* Watermark */
    .watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-20deg);
        font-size: 6rem;
        color: rgba(160, 138, 92, 0.07);
        white-space: nowrap;
        pointer-events: none;
        user-select: none;
        z-index: 0;
        font-family: 'Times New Roman', serif;
    }

    /* Title */
    .history-title {
        font-size: 2.5rem;
        font-weight: bold;
        text-align: center;
        color: #6b4f2a;
        margin-bottom: 10px;
        font-family: 'Times New Roman', serif;
        text-transform: uppercase;
        letter-spacing: 2px;
        position: relative;
        z-index: 2;
    }

    .history-subtitle {
        font-size: 1.1rem;
        text-align: center;
        color: #a08a5c;
        margin-bottom: 40px;
        font-style: italic;
        position: relative;
        z-index: 2;
    }

    /* Body text */
    .history-text {
        font-size: 1.05rem;
        line-height: 1.9;
        text-align: justify;
        margin-bottom: 25px;
        position: relative;
        z-index: 2;
    }

    /* Drop cap */
    .history-text:first-letter {
    float: left;
    font-size: 4rem;
    font-weight: bold;
    margin-right: 5px;
    margin-top: 5px; /* moves it higher */
    line-height: 0.8; /* makes it align better vertically */
    color: #6b4f2a;
    font-family: 'Times New Roman', serif;
}

    /* Page breaks */
    .page-break {
        page-break-after: always;
        margin: 50px 0;
        border-top: 1px dashed #b7a67f;
        position: relative;
        z-index: 2;
    }

    @media screen and (max-width: 768px) {
        .history-container {
            padding: 30px 20px;
        }
        .watermark {
            font-size: 3rem;
        }
    }
</style>

<div class="history-container">
    <div class="watermark">CPSU HERITAGE</div>

    <h1 class="history-title">History of Central Philippines State University (CPSU)</h1>
    <div class="history-logos">
    <img src="{{ asset('images/nonnas.png') }}" alt="Logo 1">
    <img src="{{ asset('images/noac.png') }}" alt="Logo 2">
    <img src="{{ asset('images/nsca.png') }}" alt="Logo 3">
    <img src="{{ asset('images/cpsu-logo.png') }}" alt="Logo 4">
</div>
  

    <div class="history-text">
        <img src="{{ asset('images/hilado.png') }}" class="right" alt="Old photo of CPSU">
        Sprawling in a 4,653.7-hectare land reservation, 19 kilometers from Kabankalan City, Negros Occidental and 17-kilometers from the town of Mabinay, Negros Oriental, the Central Philippines State University (CPSU) is dubbed as the first Agricultural Institution in the country established by a Filipino Superintendent in the name of Professor Jose F. Crisanto immediately after World War II. CPSU is located 97 kilometers to Dumaguete City, Negros Oriental in the southeast.
        <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The colorful history of CPSU started when House Bill No. 396 was introduced by Hon. Congressman Carlos Hilado, and co-authored by Congressman Limsiaco, Medina, Formilleza, Nietes and Arnaldo for the purpose of establishing one agricultural school in Negros Occidental of the Central Luzon Agricultural School type.  

    </div>

    <div class="history-text">
        <img src="{{ asset('images/abada.png') }}" class="left" alt="Old photo of CPSU">
        While in the Senate, it was Senator Esteban Raymundo J. Abada who sponsored a Senate Bill that repined into a law that created the establishment of two (2) Agricultural Schools, one of which is in Negros Occidental and the other one in Central Luzon. One of the immediate missions of the school was to hasten economic development of the country which was in the process of reconstruction by training the youth in scientific agriculture. House Bill No. 396 had ripened into Republic Act No. 43 that officially created the NEGROS OCCIDENTAL NATIONAL AGRICULTURAL SCHOOL (NONAS) on October 2, 1946. It became operational on August 1   of the following year.
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Had an Act No. 74 of the US Phil. Commission of 1901 been implemented as planned and approved, NONAS should have been the first agricultural school established in the country.  Act No. 74 authorized the opening of the first three schools in the Philippines during the American regime namely: Philippine Normal School and the school of Arts and Trades in Luzon and an agricultural School in Negros Island. The second two schools transformed into the Philippine Normal University and the Technological University of the Philippines respectively, while the agricultural school supposed to have been established in the island of Negros was not realized due to unknown reasons.

    </div>

    <div class="page-break"></div>

    <div class="history-text">
        <img src="{{ asset('images/limao.png') }}" class="right" alt="Old photo of CPSU">
        The school was converted to NEGROS OCCIDENTAL AGRICULTURAL COLLEGE (NOAC) by virtue of Presidential Authority on September 6, 1977.  NONAS has served the pioneering students of 31 years from 1946 to 1977 while NOAC steadfastly, turned out both college and high school graduates for 24 years prior to its conversion to NSCA.
NOAC then was converted into a state college known as the NEGROS STATE COLLEGE OF AGRICULTURE (NSCA) by virtue of R.A. 9141 dated July 3, 2001. Hon. Congressman Genaro  “Lim-ao” Alvarez, Jr.  of  the  6th  District  of  Negros  Occidental sponsored House Bill. 9873 which was co-authored by Hon. Congressman Carlos Roberto Santiago O. Cojuangco, Montemayor, Montilla, Teodoro and Villar and the Congresswoman Marcos and Villanueva in the House of Representatives. In the Senate Hon. Senator Juan Ponce Enrile was the first to file Senate Bill No. 1920 which was followed by Hon. Senator Loren Legarda who also filed Senate Bill No. 1927 all taking into consideration House Bill No. 9873.
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Finally, Hon. Senators Tessie Aquino-Oreta and John H. Osmeña filed Senate Bill No. 2263 in substitution of the Senate Bills earlier introduced by Senator Juan Ponce Enrile and Senator Loren Legarda.  The co-sponsors of Senate Bill No. 2263 were Honorable Senators Rodolfo Biason, Juan Flavier, Robert Jaworski, Ramon Magsaysay, Jr., Blas Ople, Aquilino Pimentel, Jr., Ramon Revilla, Raul Roco, Vicente Sotto III, and Francisco Tatad.

    </div>

    <div class="history-text">
        <img src="{{ asset('images/mercedes.png') }}" class="left" alt="Old photo of CPSU">
       Its conversion mandated to maintain, strengthen and expand the originally lifted expertise of NOAC by creating extension campuses.
Not so long after its conversion into a state college, through the insistent and excellent leadership of Hon. Atty. Mercedes ‘Cheding’ K. Alvarez, Congresswoman of the 6th District, Negros Occidental, NSCA was then converted into a State University known as CENTRAL PHILIPPINES STATE UNIVERSITY (CPSU). Hon. Alvarez sponsored House Bill No. 1814 together co-sponsors, Hon. Ignacio T. Arroyo, Congressman, 5th District, Negros Occidental and Hon. Alfredo B. Benitez, Congressman, 3rd District, Negros Occidental.
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In the Senate, Senator Ramon ‘Bong’ Revilla, Jr. sponsored Senate Bill No. 2874 that finally ripened into a law, R.A. 10228 dated October 19, 2012 paving the way to the conversion of NSCA into CPSU.
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CPSU’s expansion is evident all throughout the island as its campuses are strategically located in the City of Sipalay, Municipalities of Hinoba-an, Cauayan, Ilog and Candoni in the South, Municipalities of Hinigaran and Moises Padilla in the Central Negros, and in the City of Victorias and City of San Carlos in the North.

    </div>

    <div class="history-text">
        
        
        Today, CPSU main campus is traversed by an all-weather national highway and accessible to regular buses and jeepneys plying Bacolod via Kabankalan City in the Occidental side and Dumaguete City via the Municipality of Mabinay in the Oriental side. It can also be reached from various points in Negros either by air through Silay City and Dumaguete City airports or by sea through regular fast crafts and ships at any point in the Visayas.  CPSU has been attracting students not only from the different towns in Negros but also from the neighboring island provinces in the Western Visayas Region. Its agricultural programs and projects, competent faculty and staff, pleasant and conducive environment to learning, have constantly drawn clients who wish to acquire appropriate technology and skills for productive, decent and gainful living.
        CPSU upholds its academic culture which states that: 
    </div>

    <div style="text-align:center;">
        
        <span > “TODAY IS BETTER THAN YESTERDAY AND TOMORROW WILL BE BETTER THAN TODAY” </span>
    </div>
</div>
@endsection
